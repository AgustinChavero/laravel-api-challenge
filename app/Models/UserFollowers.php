<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFollower extends Model
{
    use HasFactory;

    protected $table = 'user_followers';

    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
