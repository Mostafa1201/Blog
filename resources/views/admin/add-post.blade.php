<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Post</title>
    @include('header')
</head>
<body>
@include('navbar')
<div class="post-wrapper">
    <div class="post post-new">
        <div class="card card-body bg-light">
            <div class="container">
                <h2>Add new post</h2>
                <form method="post" action="{{ url('/admin/dashboard/posts') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter post title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter post description" name="description">
                    </div>
                    <div class="form-group">
                        <label>Assign a category for this post: </label>
                    </div>
                    @if(!$categories->isEmpty())
                        <div class="category-group">
                        @for($i=0 ;$i<count($categories);$i++)
                            @if($i==0)
                                <input type="radio" id="{{ $categories[$i]->id }}" value="{{ $categories[$i]->id }}" name="category_id" maxlength="10" checked>
                            @else
                                <input type="radio" id="{{ $categories[$i]->id }}" value="{{ $categories[$i]->id }}" name="category_id" maxlength="10">
                            @endif
                                <label for="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</label>
                        @endfor
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @else
                        <h2>There are no categories in the blog please add any category before creating a post</h2>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@include('footer')
</body>
</html>
