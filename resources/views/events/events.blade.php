@extends('themes.localsdirectory.layout.base')
@section ('page_name')Events
@endsection
@section ('content')
{{--    I modified the markup to display a little nicer. Still needs work. --}}
<section class="work-section set-bg" data-setbg="">
    <div class="intro-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="about-intro">
                        <div class="intro-text">
                            <h2>Events</h2>
                            <p>See events from all of our businesses.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($events as $event) {{-- Loop over the collection of $events --}}
        <div class="col-lg-4 col-sm-6">
            <a class="arrange-items" href="{{ route('events.event.home', ['event'=>$event->id]) }}"> {{-- Set the link to the Show method of BusinessEvent Controller. - SHow method is responsible for showing a specific busines event. --}}
                <div class="arrange-pic">
                    <img src="{{ parse_url(asset('img/arrange/arrange-1.jpg'), PHP_URL_PATH) }}" alt="">
{{--                    <div class="rating">{{ $business->rating() }}</div>--}}
                    {{--                                    <div class="tic-text">Restaurants</div>--}}
                </div>
                <div class="arrange-text">
                    <h5>{{ $event->name }}</h5>
                    <span>{{ $event->description }}</span>
                    {{--                                    <p>Fusce urna quam, euismod sit</p>--}}
                    {{--                                    <div class="open tomorrow">Opens Tomorow at 10am</div>--}}
                </div>
            </a>
        </div>
    @endforeach
</section>
@endsection