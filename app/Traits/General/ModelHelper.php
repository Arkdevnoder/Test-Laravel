<?php

namespace App\Traits\General;

trait ModelHelper {

    /** 
     *
     * @return response()
     */
    private function createSlug($instance, $name)
    {
        if ($instance::whereSlug($slug = \Str::slug($name))->exists()) {

            $max = $instance::whereName($name)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}_2";
        }
        return $slug;
    }

}