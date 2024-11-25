<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'role_id',
        'language_id',
        'name',
        'lastname',
        'phone',
        'email',
        'password',
        'birth_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'user_followers',
            'follower_id',
            'followed_id'
        );
    }

    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'user_followers',
            'followed_id',
            'follower_id'
        );
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function sharedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_interactions', 'user_id', 'post_id')
                    ->wherePivot('shared', true);
    }

    public function favoritedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_interactions', 'user_id', 'post_id')
                    ->wherePivot('favorited', true);
    }

    public function postInteractions()
    {
        return $this->hasMany(PostInteraction::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
