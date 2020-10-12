@extends('themes.localsdirectory.layout.base')
@section ('page_name')Home
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Search Results</h1>
                <p>{{ $businessess->count() }} search results found.</p>
                <ul>
                @foreach($businessess as $business)
                    <li>{{ $business->name }}: <br/>
                        {{ $business->address }}
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </main>
@endsection
