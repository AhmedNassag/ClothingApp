<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $chats = Chat::with(['sender.media', 'receiver.media'])
        ->when($request->sender_id != null,function ($q) use($request){
            return $q->where('sender_id', $request->sender_id);
        })
        ->when($request->receiver_id != null,function ($q) use($request){
            return $q->where('receiver_id', $request->receiver_id);
        })
        ->paginate(config('myconfig.pagination_count'));
        return $this->apiResponse($chats,'The Data Returned',200);
    }



    public function show($id)
    {
        $chat = Chat::with(['sender.media', 'receiver.media'])->find($id);
        if($chat)
        {
            return $this->apiResponse($chat,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }



    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'message'     => 'required',
            'receiver_id' => 'required|integer|exists:users,id',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $chat = Chat::create([
            'message'     => $request->message,
            'receiver_id' => $request->receiver_id,
            'sender_id'   => Auth::user()->id,
        ]);
        if($chat)
        {
            return $this->apiResponse($chat,'The Data Stored',201);
        }
        return $this->apiResponse(null,'The Data Not Stores',400);
    }



    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'message' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $chat = Post::find($id);
        if(!$chat)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $chat->update([
            'message' => $request->message,
        ]);
        if($chat)
        {
            return $this->apiResponse($chat,'The Data Updated',201);
        }
    }



    public function delete($id)
    {
        $chat = Chat::find($id);
        if(!$chat)
        {
            return $this->apiResponse(null,'The Data Not Found',404);
        }
        $chat->delete();
        if($chat)
        {
            return $this->apiResponse(null,'The Data Deleted',200);
        }
    }



    public function showChatBySenderId($senderId)
    {
        $chats = Chat::with(['sender.media', 'receiver.media'])->where('sender_id',$senderId)->get();
        if($chats)
        {
            return $this->apiResponse($chats,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }



    public function showChatByReceiverId($receiverId)
    {
        $chats = Chat::with(['sender.media', 'receiver.media'])->where('receiver_id', $receiverId)->get();
        if($chats)
        {
            return $this->apiResponse($chats,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }



    public function showChatBetweenTwoUsers($firstUserId, $secondUserId)
    {
        $chats = Chat::with(['sender.media', 'receiver.media'])
        ->where(function ($query) use ($firstUserId, $secondUserId) {
            $query->where('sender_id', $firstUserId)
                  ->where('receiver_id', $secondUserId);
        })->orWhere(function ($query) use ($firstUserId, $secondUserId) {
            $query->where('sender_id', $secondUserId)
                  ->where('receiver_id', $firstUserId);
        })->orderBy('created_at', 'asc')->get();
        if($chats)
        {
            return $this->apiResponse($chats,'The Data Showed',200);
        }
        return $this->apiResponse(null,'The Data Not Found',404);
    }
}
