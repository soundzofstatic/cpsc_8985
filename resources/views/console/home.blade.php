@extends('themes.localsdirectory.layout.base')
@section ('page_name')Console Home
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Console Home</h1>
            </div>
        </div>
        @if(empty(Auth::user()->username))
            <!-- Username Begin -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Update Username</h2>
                        <p>Set your username before you can start to use {{ env('APP_NAME') }}</p>
                    </div>
                    <div class="col-md-12">
                        @include('components.username-update')
                    </div>
                </div>
            <!-- Username End -->
        @else
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('console.user.settings', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="primary-btn">User Settings</a>
                </div>
            </div>
{{--                <div class="row">--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="trend-item">--}}
{{--                            <div class="trend-pic">--}}
{{--                                <img src="{{ asset('img/trending/trending-1.jpg') }}" alt="">--}}
{{--                                <div class="rating">4.9</div>--}}
{{--                            </div>--}}
{{--                            <div class="trend-text">--}}
{{--                                <h4>New Place Restaurant</h4>--}}
{{--                                <span>Main Road , No 25/11</span>--}}
{{--                                <p>Fusce urna quam, euismod sit amet mollis quis.</p>--}}
{{--                                <div class="closed">Closed Now</div>--}}
{{--                                <div class="open">Opens Tomorow at 10am</div>--}}
{{--                            </div>--}}
{{--                            <div class="tic-text">Restaurants</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="trend-item nightlife">--}}
{{--                            <div class="trend-pic">--}}
{{--                                <img src="{{ asset('img/trending/trending-2.jpg') }}" alt="">--}}
{{--                                <div class="rating">4.9</div>--}}
{{--                            </div>--}}
{{--                            <div class="trend-text">--}}
{{--                                <h4>Palace Club</h4>--}}
{{--                                <span>Parker Street, No 234/40</span>--}}
{{--                                <p>Fusce urna quam, euismod sit amet mollis quis.</p>--}}
{{--                                <div class="open">Open Until 3am</div>--}}
{{--                            </div>--}}
{{--                            <div class="tic-text">Nightlife</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="trend-item hotels">--}}
{{--                            <div class="trend-pic">--}}
{{--                                <img src="{{ asset('img/trending/trending-3.jpg') }}" alt="">--}}
{{--                                <div class="rating">4.6</div>--}}
{{--                            </div>--}}
{{--                            <div class="trend-text">--}}
{{--                                <h4>Grand Hotel</h4>--}}
{{--                                <span>Main Road , No 25/11</span>--}}
{{--                                <p>Morbi id dictum quam, ut commodo lorem.</p>--}}
{{--                                <div class="closed">Closed Now</div>--}}
{{--                                <div class="open">Opens Tomorow at 10am</div>--}}
{{--                            </div>--}}
{{--                            <div class="tic-text">Hotels</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
        @endif
         <!-- Logout Begin -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <!-- Logout End -->
    </main>
@endsection
