<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of Posts in the Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        foreach($posts as $post){
            $post->created_at = Carbon::parse($post->created_at);
        }
        return view('general.home')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.add-post')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()){
            return ['errors'=> [
                'message'=>"Parameter Failed Validation Error",
                'Status Code'=>422,
            ]
            ];
        }
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->category_id = $request->input('category_id');
        $post->views = 0;
        $post->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postid = null)
    {
        $post = Post::find($postid);
        if($postid == null || $post == null){
            return redirect('404');
        }
        $post->created_at = Carbon::parse($post->created_at);
        $post->increment('views');
        return view('general.postdetails')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($postid = null)
    {
        $post = Post::find($postid);
        if($postid == null || $post == null){
            return redirect('404');
        }
        $categories = Category::all();
        return view('admin.edit-post')->with('post',$post)
                                           ->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request,$postid=null)
    {
        if($postid == null){
            return ['errors'=> [
                'message'=>"Post id parameter Not Found",
                'Status Code'=>404,
            ]
            ];
        }
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()){
            return ['errors'=> [
                'message'=>"Parameter Failed Validation Error",
                'Status Code'=>422,
            ]
            ];
        }
        $post = Post::find($postid);
        if($post == null){
            return ['errors'=> [
                'message'=>"Post Not Found",
                'Status Code'=>404,
            ]
            ];
        }
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->category_id = $request->input('category_id');
        $post->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($postid = null)
    {
        $post = Post::find($postid);
        if($postid == null || $post == null){
            return redirect('404');
        }
        $post->delete();
        return redirect()->back();
    }

}
