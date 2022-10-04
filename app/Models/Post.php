<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'slug',
        'content',
        'meta_keyword',
        'meta_description',
        'status',
        'created_by'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function tag() {
        return $this->belongsToMany(Tag::class, 'post_tag', 'id_post', 'id_tag');
    }

}
