@extends('themes.localsdirectory.layout.base')
@section ('page_name')Create an Event
@endsection
@section ('content')
    <main class="container main-pad">
        <h1>Submit an Event</h1>
        <p>Submit an event by filling the details below.</p>
        <form action="{{route('console.user.businesses.business.update.events.store', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id])}}"
              method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Event Name" name="name" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right"><b>Description</b></label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-right"><b>Start Date</b></label>
                <div class="col-md-6">
                    <input type="datetime-local" placeholder="Enter Start Date" name="start_date" required
                           class="form-control">
                </div>
            </div>
                  <div class="col-lg-12 text-center">
            <button type="submit">Submit</button>
        </div>
        </form>
    </main>