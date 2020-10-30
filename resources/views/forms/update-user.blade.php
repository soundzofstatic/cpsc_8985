@extends('themes.localsdirectory.layout.base')
@section ('page_name')Update User
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row text-center">
            <div class="col-md-12">
                <h2>Username</h2>
                <p>Your username is: <strong>{{ Auth::user()->username . '#' . Auth::user()->id  }}</strong>.</p>
            </div>
            <div class="col-md-12">
                @include('components.username-update')
            </div>
        </div>
    </main>
@endsection


