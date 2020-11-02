<!-- Search Filter Section Begin -->
<section class="search-filter spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
</section>
<!-- Search Filter Section End -->