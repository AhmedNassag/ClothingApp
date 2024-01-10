<?php

namespace App\Http\Controllers\Api;

use App\Models\PostLike;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostLikeController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $postLikes = PostLike::with(['post.media', 'user.media'])->get();
        return $this->apiResponse($postLikes,'The Data Returned',200);
    }



    public function show($id)
    {
        $postLike = PostLike::with(['post.media', 'user.media'])->find($id);
        if($postLike)
        {
            return $this->apiResponse($postLike,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }



    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'is_like' => 'required',
            'post_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $postLike = PostLike::create([
            'is_like' => $request->is_like,
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
        ]);
        if($postLike)
        {
            return $this->apiResponse($postLike,'The Data Stored',201);
        }
        return $this->apiResponse(null,'The Data Not Stores',400);
    }



    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'post_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $postLike = PostLike::find($id);
        if(!$postLike)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $postLike->update([
            'is_like' => $postLike->is_like == 0 ? 1 : 0,
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
        ]);
        if($postLike)
        {
            return $this->apiResponse($postLike,'The Data Updated',201);
        }
    }



    public function delete($id)
    {
        $postLike = PostLike::find($id);
        if(!$postLike)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $postLike->delete($id);
        if($postLike)
        {
            return $this->apiResponse(null,'The Data Deleted',200);
        }
    }
}
