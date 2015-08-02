@extends('layouts/master')

@section('app_name', 'Bookmarquee')
@section('title', 'Dashboard')

@section('content')
    @include('partials/logged-in-nav')
    <div id="welcome-wrapper" class="row">
        <div class="column small-10 small-offset-1">
            <h1>@yield('app_name')</h1>
            <h3 class="subheader">Bookmarks, only better.</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="panel column small-10 small-offset-1">
            <h4>Dashboard</h4>
            <p>Here you can do lots of stuff.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="panel column small-10 small-offset-1">
            <h4>New bookmark</h4>
            <p>Here you can do lots of stuff.</p>
            <form name="bookmark-form" action="{{ URL::to('/') }}/bookmark/create" method="post" data-parsley-validate>
                <div class="small-12 columns">
                    <label>URL
                        <input type="text" name="url" placeholder="John" required data-parsley-errors-messages-disabled data-parsley-trigger="change">
                    </label>
                    <small class="error">URL is required.</small>
                </div>
                <div class="small-12 columns">
                    <button type="submit">Add Bookmark</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@stop