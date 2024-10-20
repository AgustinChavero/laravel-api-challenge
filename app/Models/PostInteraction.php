<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostInteraction extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'post_interactions';

    protected $fillable = [
        'user_id',
        'post_id',
        'liked',
        'favorited',
        'saved',
        'shared',
    ];

    protected $casts = [
        'liked' => 'boolean',
        'favorited' => 'boolean',
        'saved' => 'boolean',
        'shared' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
