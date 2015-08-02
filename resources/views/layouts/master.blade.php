<!doctype html>
<html class="no-js" lang="en">

<head>
    @section('html-head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('app_name') - @yield('title')</title>
    <link href="//fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet" type="text/css">
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    @show
</head>

<body>

    @section('logged_in_nav')
    <nav class="top-bar" data-topbar role="navigation">
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="left">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li><a href="{{ URL::to('/') }}/dashboard">Dashboard</a></li>
                <li><a href="{{ URL::to('/bookmark') }}">Bookmarks</a></li>
            </ul>
            <ul class="right">
                <li><a href="{{ URL::to('/') }}/auth/logout">Logout</a></li>
            </ul>
        </section>
    </nav>
    @stop 
    
    @section('logged_out_nav')
    <nav class="top-bar" data-topbar role="navigation">
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="left">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
            </ul>
            <ul class="right">
                <li><a href="{{ URL::to('/') }}/auth/register">Register</a></li>
                <li><a href="{{ URL::to('/') }}/auth/login">Sign In</a></li>
            </ul>
        </section>
    </nav>
    @stop
    
    @yield('content')

    @section('body-scripts')
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src="{{ URL::asset("js/vendor/jquery.js") }}">\x3C/script>');

    </script>
    <script src="{{ URL::asset('js/foundation.min.js') }}"></script>
    <script src="{{ URL::asset('js/vendor/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    @show
</body>

</html>
