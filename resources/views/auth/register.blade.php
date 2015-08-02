@extends('layouts/master')

@section('app_name', 'Bookmarquee')
@section('title', 'Register')

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
            <h4>Register</h4>
            <p>Registration only takes a minute. After you register you can start using Bookmarquee immediately.</p>
            <form name="register-form" action="{{ URL::to('/') }}/auth/register" method="post" data-parsley-validate>
                <div class="small-12 columns">
                    <label>First Name
                        <input type="text" name="first_name" placeholder="John" required data-parsley-errors-messages-disabled data-parsley-trigger="change">
                    </label>
                    <small class="error">First name is required.</small>
                </div>
                <div class="small-12 columns">
                    <label>Last Name
                        <input type="text" name="last_name" placeholder="Doe" required data-parsley-errors-messages-disabled data-parsley-trigger="change">
                    </label>
                    <small class="error">Last name is required.</small>
                </div>
                <div class="small-12 columns">
                    <label>Email Address
                        <input type="email" name="email" placeholder="john@doe.com" data-parsley-trigger="change" required data-parsley-errors-messages-disabled data-parsley-trigger="focusin focusout">
                    </label>
                    <small class="error">Not a valid email address.</small>
                </div>
                <div class="small-12 columns">
                    <label>Password
                        <input id="register-password" type="password" name="password" placeholder="" required data-parsley-errors-messages-disabled data-parsley-trigger="change" minlength="6">
                    </label>
                    <small class="error">Password must be at least 6 characters long.</small>
                </div>
                <div class="small-12 columns">
                    <label>Confirm Password
                        <input type="password" name="password_confirmation" placeholder="" required data-parsley-errors-messages-disabled data-parsley-equalto="#register-password" data-parsley-trigger="change">
                    </label>
                    <small class="error">Passwords do not match.</small>
                </div>
                <div class="small-12 columns">
                    <button type="submit">Register</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@stop
