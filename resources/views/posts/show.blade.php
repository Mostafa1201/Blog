@extends('master')

@section('content')
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

@endsection






