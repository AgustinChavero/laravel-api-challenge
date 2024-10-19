<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostStat extends Model
{
    use SoftDeletes;

    protected $table = 'post_stats';

    protected $fillable = [
        'post_id',
        'likes_count',
        'favs_count',
        'saves_count',
        'shares_count',
    ];

    protected $casts = [
        'likes_count' => 'integer',
        'favs_count' => 'integer',
        'saves_count' => 'integer',
        'shares_count' => 'integer',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
