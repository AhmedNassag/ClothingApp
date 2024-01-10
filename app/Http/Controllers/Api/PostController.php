<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\PostPhoto;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ImageTrait;
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $posts = Post::with(['media', 'postComments.user.media', 'postLikes.user.media', 'user.media'])
        ->when($request->search != null,function ($q) use($request){
            return $q->where('content','like','%'.$request->search.'%');
        })
        ->paginate(config('myconfig.pagination_count'));
        return $this->apiResponse($posts,'The Data Returned',200);
    }



    public function show($id)
    {
        $post = Post::with(['media', 'postComments.user.media', 'postLikes.user.media', 'user.media'])->find($id);
        if($post)
        {
            return $this->apiResponse($post,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }



    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'content'  => 'required',
            'files'   => 'nullable|array',
            'files.*' => 'nullable|file|mimes:png,jpg,jpeg,webp,mp4',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $post = Post::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);
        //upload files
        $i = 0;
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $file_name = time() . $i . '.' . $file->getClientOriginalName();
                $file->storeAs('post', $file_name, 'attachments');
                $post->media()->create([
                    'file_path' => asset('public/attachments/post/' . $file_name),
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_sort' => $i
                ]);
                $i++;
            }
        }
        if($post)
        {
            return $this->apiResponse($post,'The Data Stored',201);
        }
        return $this->apiResponse(null,'The Data Not Stores',400);
    }



    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'content' => 'required',
            'files'   => 'nullable|array',
            'files.*' => 'nullable' . ($request->hasFile('files') ? '|file|mimes:jpeg,jpg,png,webp,mp4' : ''),
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $post = Post::find($id);
        if(!$post)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $post->update([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);
        if ($request->hasFile('files')) {
            //remove old files
            if($post->media) {
                foreach($post->media as $media) {
                    Storage::disk('attachments')->delete('post/' . $media->file_name);
                    $media->delete();
                }
            }
            $i = 0;
            foreach ($request->file('files') as $index => $file) {
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $file_name = time() . $i . '.' . $file->getClientOriginalName();
                $file->storeAs('post', $file_name, 'attachments');
                $post->media()->create([
                    'file_path' => asset('public/attachments/post/' . $file_name),
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_sort' => $i
                ]);
                $i++;
            }
        }
        if($post)
        {
            return $this->apiResponse($post,'The Data Updated',201);
        }
    }



    public function delete($id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        //remove old files
        if($post->media) {
            foreach($post->media as $media) {
                Storage::disk('attachments')->delete('post/' . $media->file_name);
                $media->delete();
            }
        }
        $post->delete();
        if($post)
        {
            return $this->apiResponse(null,'The Data Deleted',200);
        }
    }
}
