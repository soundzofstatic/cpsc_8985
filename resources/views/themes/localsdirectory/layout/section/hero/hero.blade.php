<!-- Hero Section Begin -->
<section class="hero-section set-bg" data-setbg="{{ parse_url(asset('img/hero-bg.jpg'), PHP_URL_PATH) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-text">
                    <img src="{{ parse_url(asset('img/placeholder.png'), PHP_URL_PATH) }}" alt="">
                    <h1>Better Reviews</h1>
                    <form action="{{ route('search.query') }}" method="POST" class="filter-search">
                        @csrf
                        <div class="search-query-field">
                            <h5>Search Businesses</h5>
                            <input type="text" name="query" value="" placeholder="Search for Businesses" />
                        </div>
                        <button type="submit">Search Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->