<header class="header-section">
    <div class="container-fluid">
        <div class="logo">
            <a href="/"><img src="{{ parse_url(asset('img/logo.png'), PHP_URL_PATH) }}" alt=""></a>
        </div>
        <nav class="main-menu mobile-menu">
            <ul>
                <li class="{{ Route::currentRouteName() == 'front-page' ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="{{ Route::currentRouteName() == 'events.home' ? 'active' : '' }}"><a href="{{ route('events.home') }}">Events</a></li>
{{--                <li><a href="{{ route('theme.listings') }}">More Cities</a></li>--}}
{{--                <li><a href="{{ route('theme.blog') }}">News</a></li>--}}
                <li><a href="{{ route('theme.contact') }}">Contact</a></li>
            </ul>
        </nav>
        <div class="header-right">
            <div class="user-access">
                @if(!Auth::check())
                    <a href="{{ route('register') }}">Register/</a>
                    <a href="{{ route('login') }}">Login</a>
                @else
                    <a href="{{ route('console.home') }}">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                    <div class="avatar image">
                        @if(empty(Auth::user()->avatar))
                            <div class="monogram">
                                <span>{{ substr(Auth::user()->first_name, 0, 1) }}{{  substr(Auth::user()->last_name, 0, 1)  }}</span>
                            </div>
                        @else
                            <div class="image">
                            <img src="/storage/{{ str_replace("public/", "", Auth::user()->avatar->file_path) }}"
                                    alt="{!! Auth::user()->avatar->alt_text !!}"/>
                            </div>
                        @endif
                    </div>
                    <div class="alert">
                        <a href="{{ route('console.home') . '#notifications' }}">
                            <span class="fa fa-envelope-open icon" aria-hidden="true">
                                <span class="count-wrap">
                                    <span class="count">{{ \App\Helpers\Alert::unread()->count() }}</span>
                                </span>
                            </span>
                        </a>
                    </div>
                @endif
            </div>
            <a href="{{ route('business-create') }}" class="primary-btn">Add Business</a>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>