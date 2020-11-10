@extends('themes.localsdirectory.layout.base')
@section ('page_name')Create a Business
@endsection
@section ('content')
    <main class="container main-pad">
        {{--                todo - Replace front-page with actual route that stores/processes the data submitted in the form --}}
        <h1>Add applicable services</h1>
        <p>Add applicable services for {{ $business->name }} by completing the form below.</p>
        <form action="{{ route('console.user.businesses.business.update.service.store', ['user' => \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
              method="POST">
            @csrf
            <div class="form-group row">
                <label for="service_provider" class="col-md-4 col-form-label text-md-right"><b>Service Provider</b></label>
                <div class="col-md-6">
                    <select class="custom-select mb-3" name="service_provider">
                        <option selected>Select</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id}}">{{ $service->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-12 text-center">
                <button type="submit">Submit</button>
            </div>
        </form>
        <!-- Logout Begin -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <!-- Logout End -->
    </main>
@endsection
