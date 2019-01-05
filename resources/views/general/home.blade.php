<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts</title>
</head>
<body>
@include('navbar')

<div class="posts">
    @if(!$posts->isEmpty())
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h1 id="posts">Blog Posts</h1>
                </div>
                @auth
                    <div class="col-sm-3 add-post-button">
                        <form method="get" action="{{ url('admin/dashboard/posts/create') }}">
                            @csrf
                            <button type="submit" class="btn btn-5">
                                Add Post +
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
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
                            <div class="row">
                                <div class="col-6 post-footer-left">
                                    <form method="get" action="{{ url('/posts/'.$post->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-5">
                                            Post Details ->
                                        </button>
                                    </form>
                                </div>
                                @auth
                                <div class="col-6 post-footer-right">
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
                @endforeach
            </div>
        </div>
    @else
        <h1>There is no posts at the moment</h1>
    @endif
</div>

</body>
</html>
