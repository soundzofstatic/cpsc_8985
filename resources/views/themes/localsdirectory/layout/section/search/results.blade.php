<!-- Result Section Begin -->
<section class="filter-section spad">
    <div class="container">
        <div class="row">
            @include ('themes.localsdirectory.layout.section.search.filters')
            <div class="col-lg-9">
                <div class="row">
{{--                    <div class="col-lg-12">--}}
{{--                        <form action="#" class="arrange-select">--}}
{{--                            <span>Arrange by</span>--}}
{{--                            <select>--}}
{{--                                <option>Newest</option>--}}
{{--                                <option>Oldest</option>--}}
{{--                            </select>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                    @foreach($businesses as $business)
                        <div class="col-lg-4 col-sm-6 business listing" data-rating="{{ $business->rating() }}" data-dollarRating="{{ $business->dollar_rating }}" data-services="{{ $business->servicesAsStringId() }}">
                            <a class="arrange-items" href="{{ route('business.home', ['business'=>$business->id]) }}">
                                <div class="arrange-pic">
                                    @if(!empty($business->mainPhoto))
                                        <img src="/storage/{{ str_replace("public/", "", $business->mainPhoto->file_path) }}" alt="{{ $business->mainPhoto->alt_text }}">
                                    @else
                                        <img src="{{ parse_url(asset('img/arrange/arrange-1.jpg'), PHP_URL_PATH) }}" alt="">
                                    @endif
                                    <div class="rating">{{ $business->rating() }}</div>
{{--                                    <div class="tic-text">Restaurants</div>--}}
                                </div>
                                <div class="arrange-text">
                                    <h5>{{ $business->name }}</h5>
                                    <span>{{ $business->address }}</span>
{{--                                    <p>Fusce urna quam, euismod sit</p>--}}
{{--                                    <div class="open tomorrow">Opens Tomorow at 10am</div>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
{{--                    <div class="col-lg-12 text-right">--}}
{{--                        <div class="pagination-num">--}}
{{--                            <a href="#">01</a>--}}
{{--                            <a href="#">02</a>--}}
{{--                            <a href="#">03</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>
@if(!empty($promotedBusiness3))
    @if(!empty($promotedBusiness3->business->mainPhoto))
        <section class="promo-section promo-3 set-bg p-5" data-setbg="/storage/{{ str_replace("public/", "", $promotedBusiness3->business->mainPhoto->file_path) }}">
    @else
        <section class="promo-section promo-3 set-bg p-5" data-setbg="{{ parse_url(asset('img/hero-bg.jpg'), PHP_URL_PATH) }}">
    @endif
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
<!-- Result Section End -->