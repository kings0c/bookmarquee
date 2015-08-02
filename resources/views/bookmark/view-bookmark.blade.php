@extends('layouts/master')

@section('app_name', 'Bookmarquee')
@section('title', 'Bookmarks')

@section('html-head')
    @parent
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/vendor/jquery.tagsinput.min.css') }}">
    <style>
        .tagsinput input {
            display: none;
        }   
        .tagsinput .tag a {
            display: none;
        } 
    </style>
@stop

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
            <h4>Your bookmarks</h4>
            <p>Here you can do lots of stuff.</p>
        </div>
    </div>
    <?php $i = 0; ?>
    @foreach ($bookmarks as $bookmark)
    @if($i == 0 || $i % 2 == 0)
        <div class="row">
    @endif
        <div class="panel column small-6 bookmark-item" style="background: #{{ $bookmark->colour }}">
            <h4><a href="{{ $bookmark->url }}">{{ $bookmark->title }}</a></h4>
            <p>{{ $bookmark->url }}</p>
            <a class="edit-bookmark" href="{{ URL::to('bookmark/edit') . "/" . $bookmark->bookmark_id }}"><i class="material-icons">mode_edit</i></a>
            <div class="small-12 columns">
                <label>Tags
                    <input name="tags" class="bookmark-tags" value="{{ $bookmark->tags }}">
                </label>
            </div>
        </div>
            <?php $i++; ?>
    @if( ($i != 0 && $i % 2 == 0) || $i == sizeof($bookmarks) )
    </div>
    @endif
    
    @endforeach
    
@stop

@section('body-scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript">
        $('.bookmark-tags').tagsInput({
            'height':'100px',
            'width':'100%',
        });
    </script>
@stop