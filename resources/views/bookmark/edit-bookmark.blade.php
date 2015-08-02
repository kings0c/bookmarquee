@extends('layouts/master')

@section('app_name', 'Bookmarquee')
@section('title', 'Bookmarks')

@section('html-head')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('css/vendor/jquery.tagsinput.min.css') }}">
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
            <h4>Editing {{ $bookmark->title }}</h4>
            <p>{{ $bookmark->url }}</p>
            <form name="edit-bookmark-form" action="{{ URL::to('/') }}/bookmark/edit/{{ $bookmark->bookmark_id }}" method="post" data-parsley-validate>
                <div class="small-12 columns">
                    <label>Title
                        <input type="text" name="page_title" value="{{ $bookmark->title }}" required data-parsley-errors-messages-disabled data-parsley-trigger="change">
                    </label>
                    <small class="error">Title is required.</small>
                </div>
                <div class="small-12 columns">
                    <label>Tags
                        <input name="tags" id="tags" value="{{ $tags }}">
                    </label>
                    <small class="error">Tags is required.</small>
                </div>
                <div class="small-12 columns">
                    <label>Colour (click to select)
                        <input type="text" name="colour" class="color" value="{{ $bookmark->colour }}" required data-parsley-errors-messages-disabled data-parsley-trigger="change">
                    </label>
                    <small class="error">Colour is required.</small>
                </div>
                <div class="small-12 columns">
                    <button type="submit">Save</button>
                </div>
                <input type="hidden" name="userID" value="{{ $userID }}">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@stop

@section('body-scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/colour-picker/jscolor.js') }}"></script>
    <script type="text/javascript">
        $('#tags').tagsInput({
            'height':'100px',
            'width':'100%',
        });
    </script>
@stop