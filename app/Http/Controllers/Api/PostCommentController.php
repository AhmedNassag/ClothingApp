<?php

namespace App\Http\Controllers\Api;

use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $postComments = PostComment::with(['post.media', 'user.media'])->paginate(config('myconfig.pagination_count'));
        return $this->apiResponse($postComments,'The Data Returned',200);
    }



    public function show($id)
    {
        $postComment = PostComment::with(['post.media', 'user.media'])->find($id);
        if($postComment)
        {
            return $this->apiResponse($postComment,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }



    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'content' => 'required',
            'post_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $postComment = PostComment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
        ]);
        if($postComment)
        {
            return $this->apiResponse($postComment,'The Data Stored',201);
        }
        return $this->apiResponse(null,'The Data Not Stores',400);
    }



    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'content' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $postComment = PostComment::find($id);
        if(!$postComment)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $postComment->update([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
        ]);
        if($postComment)
        {
            return $this->apiResponse($postComment,'The Data Updated',201);
        }
    }



    public function delete($id)
    {
        $postComment = PostComment::find($id);
        if(!$postComment)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $postComment->delete($id);
        if($postComment)
        {
            return $this->apiResponse(null,'The Data Deleted',200);
        }
    }
}
