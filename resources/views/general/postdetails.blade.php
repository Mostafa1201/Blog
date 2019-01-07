<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Details</title>
    @include('header')
</head>
<body>
@include('navbar')
@include('footer')
<div class="post-wrapper">
    <div class="post">
        <div class="container">
            <div class="card card-body bg-light">
                <h2 class="post-title">
                    <span>{{ $post->title }}</span>
                    <span class="category-span">{{ $post->category->name }}</span>
                </h2>
                <small class="date"> {{ $post->created_at->diffForHumans() }} </small>
                <p class="post-desc"> {{ $post->description }} </p>
            </div>
        </div>
    </div>
</div>



</body>
</html>






