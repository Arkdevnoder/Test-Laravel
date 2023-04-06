<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\General\ModelHelper;

class PostObserver
{

    use ModelHelper;

    /**
    * @return void
    */
    public function saving(Post $post)
    {   
        $post->slug = $this->createSlug($post, $post->name);
        return $post;
        //$post->save();
    }

}