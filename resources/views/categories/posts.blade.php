@extends('master')

@section('content')

<div class="posts">
    @if(!$posts->isEmpty())
        <div class="container">
            <h1 id="posts">{{ $category->name }} Posts</h1>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-sm-6 my-5">
                        <div class="card card-body bg-light">
                            <h2 class="post-title">
                                <span>{{ $post->title }}</span>
                                <span class="category-span">{{ $post->category->name }}</span>
                            </h2>
                            <small class="date"> {{ $post->created_at->diffForHumans() }} </small>
                            <p> {{ $post->description }} </p>
                            <form method="get" action="{{ url('/posts/'.$post->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-5">
                                    Post Details ->
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h1>There is no posts at the moment</h1>
    @endif

</div>

@endsection
