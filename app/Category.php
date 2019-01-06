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

    /**
     * get the id of the category by category name since it is unique
     *
     * @return int
     */
    public function getCategoryIDByName($categoryName)
    {
        return DB::table('categories')
            ->select('id')
            ->where('name', '=',$categoryName)
            ->value('id');
    }

}
