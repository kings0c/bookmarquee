@extends('layouts/master')

@section('app_name', 'Bookmarquee')
@section('title', 'Login')

@section('content')
    @include('partials/logged-out-nav')
    <div id="welcome-wrapper" class="row">
        <div class="column small-10 small-offset-1">
            <h1>@yield('app_name') - @yield('title')</h1>
            <h3 class="subheader">Bookmarks, only better.</h3>
        </div>
    </div>

    <div class="row">
        <div class="panel column small-10 small-offset-1">
            <h4>Login</h4>
            <p>Please login to start using Bookmarquee.</p>
            <form name="login-form" action="{{ URL::to('/') }}/auth/login" method="post" data-parsley-validate>
                <div class="small-12 columns">
                    <label>Email Address
                        <input type="email" name="email" placeholder="john@doe.com" data-parsley-trigger="change" required data-parsley-errors-messages-disabled data-parsley-trigger="focusin focusout">
                    </label>
                    <small class="error">Not a valid email address.</small>
                </div>
                <div class="small-12 columns">
                    <label>Password
                        <input type="password" name="password" placeholder="" required data-parsley-errors-messages-disabled data-parsley-trigger="change" minlength="6">
                    </label>
                    <small class="error">Password must be at least 6 characters long.</small>
                </div>
                <div class="small-12 columns">
                    <label>Remember Me<br>
                        <input type="checkbox" name="remember">
                    </label>
                </div>
                <div class="small-12 columns">
                    <button type="submit">Log In</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@stop
