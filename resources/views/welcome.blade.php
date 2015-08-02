@extends('layouts/master')

@section('app_name', 'Bookmarquee')
@section('title', 'Welcome')

@section('content')
    @include('partials/logged-out-nav')
    <div id="welcome-wrapper" class="row">
        <div class="column small-10 small-offset-1">
            <h1>@yield('app_name')</h1>
            <h3 class="subheader">Bookmarks, only better.</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="panel column small-10 small-offset-1">
            <h4>Search the content of your bookmarks</h4>
            <p>Each new bookmark is stored and indexed so you can easily find it later.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="panel column small-10 small-offset-1">
            <h4>Tagging support</h4>
            <p>Organise your bookmarks with tags, Bookmarquee will suggest tags for you on saving.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="panel column small-10 small-offset-1">
            <h4>Graphs</h4>
            <p>I just really like graphs.</p>
        </div>
    </div>
@stop