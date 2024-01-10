<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table   = 'posts';
    protected $guarded = [];


    //start relations
    public function media()
    {
        return $this->morphMany(Media::class,'mediable');
    }


    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }


    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
