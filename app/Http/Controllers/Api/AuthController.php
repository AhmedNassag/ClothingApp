<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Post;
use App\Traits\ImageTrait;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ImageTrait;
    use ApiResponseTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
            
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated()))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'username' => 'required|string|between:2,100|unique:users,username',
            'email'    => 'required|string|email|max:100|unique:users,email',
            'phone'    => 'required|numeric|unique:users,phone',
            'password' => 'required|string|min:6',
            'bio'      => 'nullable|string',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(
            array_merge($validator->validated(),['password' => bcrypt($request->password)])
        );
        //upload default file
        if (!$request->hasFile('file')) {
            $user->media()->create([
                'file_path' => asset('public/attachments/user/user_avatar.jpg'),
                'file_name' => 'user_avatar.jpg',
                'file_size' => 1670,
                'file_type' => 'image/jpg',
                'file_sort' => 1
            ]);
        }
        return response()->json
        ([
            'message' => 'User successfully registered',
            'user'    => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json
        ([
            'access_token' => $token,
            'token_type'   => 'bearer',
            /* 'expires_in'   => auth()->factory()->getTTL() * 60 * 60 * 7, */
            'user'         => auth()->user()
        ]);
    }



    public function changePassword(Request $request)
    {
        $user      = auth()->user();
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:8',
            'password'     => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            return $this->apiResponse($user, 'the data updated successfully', 200);
        } else {
            return $this->apiResponse(null, 'sorry the old password is not correct', 404);
        }
    }



    public function updateProfile(Request $request)
    {
        $user      = auth()->user();
        $validator = Validator::make($request->all(),
        [
            'username' => 'required|string|between:2,100|unique:users,username,'.$user->id,
            'email'    => 'required|string|email|max:100|unique:users,email,'.$user->id,
            'phone'    => 'required|numeric|unique:users,phone,'.$user->id,
            'bio'      => 'nullable|string',
            'file'     => 'nullable'. ($request->hasFile('file') ? '|mimes:jpeg,jpg,png,webp|max:5048' : ''),
        ]);
        if($validator->fails())
        {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        //upload file
        if ($request->hasFile('file')) {
            //remove old file
            if($user->media) {
                Storage::disk('attachments')->delete('user/' . $user->media->file_name);
                $user->media->delete();
            }
            $file_size = $request->file->getSize();
            $file_type = $request->file->getMimeType();
            $file_name = time() . '.' . $request->file->getClientOriginalName();
            $request->file->storeAs('user', $file_name, 'attachments');
            $user->media()->create([
                'file_path' => asset('public/attachments/user/' . $file_name),
                'file_name' => $file_name,
                'file_size' => $file_size,
                'file_type' => $file_type,
                'file_sort' => 1
            ]);
        }
        //update data
        $user->update([
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'bio'      => $request->bio ? $request->bio : '',
            
        ]);
        if ($user) {
            return $this->apiResponse($user, 'the data updated successfully', 200);
        }
        return $this->apiResponse(null, 'something error happened try again please', 404);
    }



    public function userProfile()
    {
        $user = User::where('id', auth()->user()->id)->with(['media', 'posts.media', 'postLikes', 'postComments'])->first();
        if ($user) {
            return $this->apiResponse($user, 'the data updated successfully', 200);
        }
        return $this->apiResponse(null, 'something error happened try again please', 404);
    }



    public function userPosts()
    {
        $userPosts = Post::where('user_id', auth()->user()->id)->with(['media', 'postComments', 'postLikes', 'user.media'])->paginate(config('myconfig.pagination_count'));
        if($userPosts)
        {
            return $this->apiResponse($userPosts,'The Data Returned',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }
    
    
    
    public function allusers()
    {
        $users = User::with(['media','posts.media','postLikes','postComments'])->get();
        if($users){
             return $this->apiResponse($users, 'the data updated successfully', 200);
        }
        return $this->apiResponse(null, 'something error happened try again please', 404);
    }
    
    
    
    public function delete($id)
    {
        $user = User::find($id);
        if(!$user)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $user->delete();
        if($user)
        {
            return $this->apiResponse(null,'The Data Deleted',200);
        }
    }
}
