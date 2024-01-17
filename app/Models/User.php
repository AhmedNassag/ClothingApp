<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];



    //start relations
    public function media()
    {
        return $this->morphOne(Media::class,'mediable');
    }


    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    
    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }

    
    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }


    public function sendingMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }


    public function receivingMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
