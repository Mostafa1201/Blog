<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index')->with('categories',$categories);
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
            'category-name' => 'required|max:15'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }
        else {
            $category = new Category;
            $name = $request->input('category-name');
            $category->name = $name;
            $category->save();
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, $categoryid=null)
    {
        if($categoryid == null){
            return ['errors'=> [
                'message'=>"Category id parameter Not Found",
                'Status Code'=>404,
            ]
            ];
        }
        $validator = Validator::make($request->all(),[
            'category-name' => 'required|max:15'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }
        $category = Category::find($categoryid);
        if($category == null){
            return ['errors'=> [
                'message'=>"Category Not Found",
                'Status Code'=>404,
            ]
            ];
        }
        $name = $request->input('category-name');
        $category->name = $name;
        $category->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryid=null)
    {
        $category = Category::find($categoryid);

        $category->delete();
        return redirect()->back();
    }

    /**
     * Display a listing of posts that belong to that category.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryPosts($categoryid){
        $category = Category::find($categoryid);
        $posts = $category->posts;
        foreach($posts as $post){
            $post->created_at = Carbon::parse($post->created_at);
        }
        return view('categories.posts')->with('category',$category)
                                                  ->with('posts',$posts);
    }
}
