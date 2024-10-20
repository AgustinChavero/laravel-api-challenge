<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'category_id',
        'enabled',
        'photo',
        'content',
        'publication_date',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'publication_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function stats()
    {
        return $this->hasOne(PostStat::class, 'post_id');
    }

    public function interactions()
    {
        return $this->hasMany(PostInteraction::class, 'post_id');
    }
}
