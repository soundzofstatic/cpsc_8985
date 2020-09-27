@extends('themes.localsdirectory.layout.base')
@section ('page_name')Home
@endsection
@section ('content')
    <main class="container main-pad">
        <h1>Home Account</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </main>
@endsection
