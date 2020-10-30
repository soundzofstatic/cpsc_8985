@extends('themes.localsdirectory.layout.base')
@section ('page_name')Search Results
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Search Results</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Search results of businesses</h2>
            </div>
            <div class="col-md-12">
                @foreach($businesses as $business)
                    <div class="row mb-2" style="border: thin solid red">
                        <div class="col-md-12">
                            <p>{{ $business->name}}</p>
                            {{--              <a href="{{ route('console.user.admin.update.listAllBusinesses', ['user'=> $userid]) }}"--}}
                            {{--                 class="btn btn-sm btn-success">Enable User</a>--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

