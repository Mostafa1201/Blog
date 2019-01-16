<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.header')
    @yield('specific_page_Styles')
</head>
<body>
@include('layouts.navbar')

@yield('content')

@include('layouts.footer')
@yield('specific_page_scripts')
</body>
</html>
