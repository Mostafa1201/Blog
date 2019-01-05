<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = "posts";

    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
