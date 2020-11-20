<!-- Trending Restaurant Section Begin -->
<section class="trending-restaurant spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Top trending Businesses</h2>
                    <p>Explore some of the best places in the world</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($checkIns as $checkIn)
                <div class="col-lg-6">
                    <div class="trend-item">
                        <div class="trend-pic">
                            @if(!empty($checkIn->business->mainPhoto))
                                <img src="/storage/{{ str_replace("public/", "", $checkIn->business->mainPhoto->file_path) }}" alt="{{ $checkIn->business->mainPhoto->alt_text }}">
                            @else
                                <img src="{{ parse_url(asset('img/trending/trending-1.jpg'), PHP_URL_PATH) }}" alt="">
                            @endif
                            <div class="rating">{{ $checkIn->business->rating() }}</div>
                        </div>
                        <div class="trend-text" style="width: 60%">
                            <a href="{{ route('business.home', ['business' => $checkIn->business->id]) }}"><h4>{{ $checkIn->business->name }}</h4></a>
                            <span class="word-wrap: break-word">{{ $checkIn->business->address }}</span>
                            <p>Fusce urna quam, euismod sit amet mollis quis.</p>
{{--                            <div class="closed">Closed Now</div>--}}
{{--                            <div class="open">Opens Tomorow at 10am</div>--}}
                        </div>
{{--                        <div class="tic-text">Restaurants</div>--}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Trending Restaurant Section End -->