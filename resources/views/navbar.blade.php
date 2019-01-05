@include('links')
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand mb-1 h1" href="{{ url('/') }}">My Blog</a>
    <div class="nav-button navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="top"></span>
        <span class="middle"></span>
        <span class="bottom"></span>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav w-100">
            @if(!$navCategories->isEmpty())
                @foreach($navCategories as $category)
                    <li class="nav-item">
                        <a href="{{ url('/categories/'.$category->id.'/posts') }}" class="nav-link" href="#">{{ $category->name }}</a>
                    </li>
                @endforeach
            @endif
            <li class="nav-item dropdown ml-auto">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Others
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/') }}">Posts</a>
                    <a class="dropdown-item" href="{{ url('/categories') }}">Categories</a>
                    @auth
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/admin/dashboard/logout') }}">Logout</a>
                    @endauth
                </div>
            </li>
        </ul>
    </div>
</nav>
