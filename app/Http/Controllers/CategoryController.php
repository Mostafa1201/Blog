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
        return view('general.categories')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'category-name' => 'required'
        ]);
        if ($validator->fails()){
            return ['errors'=> [
                            'message'=>"Parameter Failed Validation Error",
                            'Status Code'=>422,
                    ]
            ];
        }
//        if(Auth::check()){      // A second double check as anyone can add categories from postman if he have the request inputs.
            $category = new Category;
            $name = $request->input('category-name');
            $category->name = $name;
            $category->save();
            return redirect()->back();
//        }else{
//            return redirect()->route('login');
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
            'category-name' => 'required'
        ]);
        if ($validator->fails()){
            return ['errors'=> [
                'message'=>"Parameter Failed Validation Error",
                'Status Code'=>422,
            ]
            ];
        }
//        if(Auth::check()){      // A second double check as anyone can add categories from postman if he have the request inputs.
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
//        }else{
//            return redirect()->route('login');
//        }
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
        return view('general.category-posts')->with('category',$category)
                                                  ->with('posts',$posts);
    }
}
