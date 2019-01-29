@extends('themes.default.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Dashboard</h1></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3>
                            <a href="{{ config('app.url_admin').'/post' }}">Posts</a>
                        </h3>
                        <h3>
                            <a href="{{ config('app.url_admin').'/postcomment' }}">PostComments</a>
                        </h3>
                        <h3>
                            <a href="{{ config('app.url_admin').'/category' }}">Categories</a>
                        </h3>
                        <h3>
                            <a href="{{ config('app.url_admin').'/tag' }}">Tags</a>
                        </h3>
                        <h3>
                            <a href="{{ config('app.url_admin').'/page' }}">Pages</a>
                        </h3>
                        <h3>
                            <a href="{{ config('app.url_admin').'/pagecomment' }}">PageComments</a>
                        </h3>
                        <h3>
                            <a href="{{ config('app.url_admin').'/user' }}">Users</a>
                        </h3>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
