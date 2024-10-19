<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'password',
        'birth_date',
        'role_id',
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

    public function postInteractions()
    {
        return $this->hasMany(PostInteraction::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
}
