<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admins = Admin::all()->count();
        $categories = Category::all()->count();
        $posts = Post::all()->count();
        $postViews = Post::all()->sum('views');
        return view('admin.dashboard')->with('admins',$admins)
                                           ->with('categories',$categories)
                                           ->with('posts',$posts)
                                           ->with('postViews',$postViews);
    }
}
