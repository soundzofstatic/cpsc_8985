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
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items" href="{{ route('business.home', ['business'=>$business->id]) }}">
                                <div class="arrange-pic">
                                    <img src="{{ parse_url(asset('img/arrange/arrange-1.jpg'), PHP_URL_PATH) }}" alt="">
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
<!-- Result Section End -->