<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'post_categories';

    protected $fillable = [
        'name',
        'color',
    ];

    protected $casts = [
        'color' => 'string',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
