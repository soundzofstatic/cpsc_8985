<!-- Hero Section Begin -->
<section class="hero-section set-bg" data-setbg="{{ parse_url(asset('img/hero-bg.jpg'), PHP_URL_PATH) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-text">
                    <img src="{{ parse_url(asset('img/placeholder.png'), PHP_URL_PATH) }}" alt="">
                    <h1>New York</h1>
                    <form action="#" class="filter-search">
                        <div class="category-search">
                            <h5>Search Category</h5>
                            <select class="ca-search">
                                <option>Restaurants</option>
                                <option>Hotels</option>
                                <option>Food & Drinks</option>
                                <option>Home Delievery</option>
                                <option>Commercial Shops</option>
                            </select>
                        </div>
                        <div class="location-search">
                            <h5>Your Location</h5>
                            <select class="lo-search">
                                <option>New York</option>
                            </select>
                        </div>
                        <button type="submit">Search Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->