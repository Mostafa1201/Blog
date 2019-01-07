<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $table = "categories";

    /**
     * The posts that belong to this category.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * get only the first 3 categories to put it in navbar and the rest are on another page
     *
     * @return \Illuminate\Http\Response
     */
    public function getNavbarCategories()
    {
        return Category::limit(3)->get();
    }

}
