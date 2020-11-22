@extends('themes.localsdirectory.layout.base')
@section ('page_name')Results
@endsection
@section ('content')
    @include ('themes.localsdirectory.layout.section.hero.map')
    @include ('themes.localsdirectory.layout.section.search.search')
    @include ('themes.localsdirectory.layout.section.search.results')
@endsection
@section ('content')
@if(!empty($promotedBusiness3))
    <section class="promo-section promo-3 set-bg p-5" data-setbg="{{ parse_url(asset('img/hero-bg.jpg'), PHP_URL_PATH) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="promo-text">
                        <h2>{{ $promotedBusiness3->business->name }}</h2>
                        <p>Some teaser text or business info line</p>
                        <a href="{{ route('business.home', ['business' => $promotedBusiness3->business->id]) }}" class="btn btn-lg btn-info">See business</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-label">
            <span>Promotion</span>
        </div>
    </section>
@endif
@endsection
