<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostLikeController;
use App\Http\Controllers\Api\PostCommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//Auth routes
Route::group(['middleware' => 'api','prefix' => 'auth'], function($router)
{
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::get('user-posts', [AuthController::class, 'userPosts']);
    Route::get('all-users', [AuthController::class, 'allusers']);
    Route::post('delete-user/{id}',[AuthController::class,'delete']);
});





//User must be have token to be able to visit those routes
Route::group(['middleware' => 'JwtMiddleware'],function()
{
    //post
    Route::get('all-posts',[PostController::class,'index']);
    Route::get('show-post/{id}',[PostController::class,'show']);
    Route::post('store-post',[PostController::class,'store']);
    Route::post('update-post/{id}',[PostController::class,'update']);
    Route::post('delete-post/{id}',[PostController::class,'delete']);



    //postLike
    Route::get('all-postLikes',[PostLikeController::class,'index']);
    Route::get('show-postLike/{id}',[PostLikeController::class,'show']);
    Route::post('store-postLike',[PostLikeController::class,'store']);
    Route::post('update-postLike/{id}',[PostLikeController::class,'update']);
    Route::post('delete-postLike/{id}',[PostLikeController::class,'delete']);



    //postComment
    Route::get('all-postComments',[PostCommentController::class,'index']);
    Route::get('show-postComment/{id}',[PostCommentController::class,'show']);
    Route::post('store-postComment',[PostCommentController::class,'store']);
    Route::post('update-postComment/{id}',[PostCommentController::class,'update']);
    Route::post('delete-postComment/{id}',[PostCommentController::class,'delete']);



    //chat
    Route::get('all-chats',[ChatController::class,'index']);
    Route::get('show-chat/{id}',[ChatController::class,'show']);
    Route::post('store-chat',[ChatController::class,'store']);
    Route::post('update-chat/{id}',[ChatController::class,'update']);
    Route::post('delete-chat/{id}',[ChatController::class,'delete']);
    Route::get('show-chat-by-senderId/{senderId}',[ChatController::class,'showChatBySenderId']);
    Route::get('show-chat-by-receiverId/{receiverId}',[ChatController::class,'showChatByReceiverId']);
    Route::get('show-chat-between-two-users/{firstUserId}/{secondUserId}',[ChatController::class,'showChatBetweenTwoUsers']);
});
