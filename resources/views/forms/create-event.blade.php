@extends('themes.localsdirectory.layout.base')
@section ('page_name')Create an Event
@endsection
@section ('content')
    <main class="container main-pad">
        <h1>Submit an Event</h1>
        <p>Submit an event by filling the details below.</p>
        <form action="{{ }}"
              method="POST">
            @csrf
            <div class="form-group row">
                <label for="event_title" class="col-md-4 col-form-label text-md-right">Event Name</label>
                <input id="event_title" maxlength="128" name="name" type="text" value="">
            </div>
            <div>
                <label for="starts_month_day_year">When</label>
                <div class="form-group row">
                    <input type="date">
                    <div class="form-group row">
                        <input type="time">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="Business name" class="col-md-4 col-form-label text-md-right"><b>Business Name</b></label>
            </div>
            <div class="form-group row">
                <label for="event description" class="col-md-4 col-form-label text-md-right"><b>Event
                        Description</b></label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="web_url" class="col-md-4 col-form-label text-md-right"><b>Web URL</b></label>
            </div>
            <div class="form-group row">
                <label for="Price" class="col-md-4 col-form-label text-md-right"><b>Price</b></label>
            </div>
            <div class="col-lg-12 text-center">
                <button type="submit">Submit</button>
            </div>
        </form>
    </main>