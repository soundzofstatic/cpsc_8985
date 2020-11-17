@extends('themes.localsdirectory.layout.base')
@section ('page_name')Home
@endsection
@section ('styles')
    <style>
        .about-intro {

        }
        .intro-pic, .intro-text {
            display: block;
            float: left;
        }
        .intro-pic {
            position: relative;
        }
        .intro-pic img {
            height: 185px;
            width: 185px;
            border-radius: 50%;
        }
    </style>
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="intro-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-intro">
                            @if(!empty($user->avatar))
                                <div class="intro-pic user">
                                    <img src="/storage/{{ str_replace("public/", "", $user->avatar->file_path) }}"
                                         alt="{!! $user->avatar->alt_text !!}"/>
                                </div>
                            @endif
                            <div class="intro-text">
                                <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
                                <p>{{ $user->username }}#{{ $user->id }}</p>
                                <div class="open">Reviews - {{ $user->reviews->count() }}</div>
                                <div class="closed">Check-ins - {{ $user->businessCheckIns->count() }}</div>
                                <div class="open">Bookmarks - {{ $user->publicBookmarks->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Business Reviews --}}
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Business Reviews</h2>
                    </div>
                    <p>{{ $user->first_name }} has submitted {{ $user->businessCheckIns->count() }} reviews. The last 10 are below.</p>
                </div>
                <div class="col-md-12">
                    <div class="row mb-2">
                        @foreach($user->reviews->slice(0,10) as $review)
                            <div class="col col-md-12 mb-3 review-item">
                                <div class="rating">
                                    @for($i=0;$i<$review->rating;$i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i=0;$i< (5 - $review->rating);$i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                                <h3>Review Title - ({{ $review->business->name }})</h3>
                                <p>{{ $review->originalFeedback->text }}</p>
                                <div class="client-text">
                                    <h5><a href="{{ route('user.home', ['user' => $review->user_id]) }}" class="author-link">{{ $review->user->first_name }} {{ $review->user->last_name }}</a></h5>
                                    <span>{{ $review->created_at->format('F j, Y, g:i a') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    {{--                    todo - create route for this action button --}}
                    <a href="#" class="btn btn-primary">See all Rewiews by {{ $user->first_name }}</a>
                </div>
            </div>
        </div>
        {{-- Business Check-ins --}}
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Business Check-ins</h2>
                    </div>
                    <p>{{ $user->first_name }} has checked into {{ $user->businessCheckIns->count() }} businesses. See the last 5 businesses {{ $user->first_name }} has visted.</p>
                </div>
                <div class="col-md-12">
                    <div class="row mb-2">
                        <ul>
                            @foreach($user->businessCheckIns->slice(0,5) as $checkIn)
                                    <li><a href="{{ route('business.home', ['business' => $checkIn->business_id]) }}" class="author-link">{{ $checkIn->business->name }}</a> on {{ $checkIn->created_at->format('F j, Y, g:i a') }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    {{--                    todo - create route for this action button --}}
                    <a href="#" class="btn btn-primary">See all Check-ins by {{ $user->first_name }}</a>
                </div>
            </div>
        </div>
        {{-- Bookmarks --}}
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Bookmarks</h2>
                    </div>
{{--                    <p>{{ $user->first_name }} has checked into {{ $user->businessCheckIns->count() }} businesses. See--}}
{{--                        which businesses {{ $user->first_name }} has visted.</p>--}}
                </div>
                <div class="col-md-12">
                    <div class="row mb-2">
                        <ul>
                            @foreach($user->publicBookmarks as $bookmark)
                                <li><a href="{{ route('business.home', ['business' => $bookmark->business_id]) }}" class="author-link">{{ $bookmark->business->name }}</a> on {{ $bookmark->created_at->format('F j, Y, g:i a') }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
