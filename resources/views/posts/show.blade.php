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
                @auth
                    <div class="post-footer-middle">
                        <form method="get" action="{{ url('admin/dashboard/posts/'.$post->id.'/edit') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary"> Edit </button>
                        </form>
                        <form method="post" action="{{ url('/admin/dashboard/posts/'.$post->id) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"> Delete </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

@endsection






