<?php

namespace App\Observers;

use App\Models\Tag;
use App\Traits\General\ModelHelper;

class TagObserver
{

    use ModelHelper;

    /**
    * @return void
    */
    public function saving(Tag $tag)
    {   
        $tag->slug = $this->createSlug($tag, $tag->name);
        return $tag;
        //$tag->save();
    }

}