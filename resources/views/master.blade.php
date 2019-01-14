<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.header')
    <title>Blog</title>
</head>
<body>
@include('layouts.navbar')

@yield('content')

@include('layouts.footer')
</body>
</html>
