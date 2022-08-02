<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
     @include('includes.head')
     @stack('style')
    </head>
    <body class="antialiased">
        @yield('content')
        @stack('script')
    </body>
</html>
