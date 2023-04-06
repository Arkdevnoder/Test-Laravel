<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'text', 'slug', 'picture'];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'tag_post', 'tag_id', 'post_id');
    }
}
