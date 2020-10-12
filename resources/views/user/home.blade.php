@extends('themes.localsdirectory.layout.base')
@section ('page_name')Home
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>User: {{ $user->first_name }}</h1>
                <p>How many check-ins? {{ $countOfCheckIns }}</p>
                <p>How many check-ins? {{ $user->businessCheckIns->count() }}</p>
            </div>
        </div>
    </main>
@endsection
