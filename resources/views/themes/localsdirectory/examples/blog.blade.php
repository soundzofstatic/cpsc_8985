@extends('themes.localsdirectory.layout.base')
@section ('page_name')Single Listing
@endsection
@section ('content')
    <!-- Hero Section Begin -->
    <div class="hero-listing set-bg" data-setbg="{{ asset('img/blog-bg.jpg') }}">
    </div>
    <!-- Hero Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Blog Item Being -->
                    <div class="blog-item">
                        <div class="blog-pic set-bg" data-setbg="{{ asset('img/blog/blog-1.jpg') }}">
                            <div class="blog-absolute">
                                <h2>23</h2>
                                <span>March</span>
                                <span>2019</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h2>Top 10 New York restaurants</h2>
                            <ul>
                                <li>By Admin</li>
                                <li>3 Comments</li>
                            </ul>
                            <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero auctor, ornare ante. Morbi quis ex eleifend, sodales nulla vitae, scelerisque ante.</p>
                            <a href="#" class="primary-btn">Read More</a>
                        </div>
                    </div>
                    <!-- Blog Item End -->
                    <!-- Blog Item Being -->
                    <div class="blog-item">
                        <div class="blog-pic set-bg" data-setbg="{{ asset('img/blog/blog-2.jpg') }}">
                            <div class="blog-absolute">
                                <h2>23</h2>
                                <span>March</span>
                                <span>2019</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h2>Top USA Destinations</h2>
                            <ul>
                                <li>By Admin</li>
                                <li>3 Comments</li>
                            </ul>
                            <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero auctor, ornare ante. Morbi quis ex eleifend, sodales nulla vitae, scelerisque ante.</p>
                            <a href="#" class="primary-btn">Read More</a>
                        </div>
                    </div>
                    <!-- Blog Item End -->
                    <!-- Blog Item Being -->
                    <div class="blog-item">
                        <div class="blog-pic set-bg" data-setbg="{{ asset('img/blog/blog-3.jpg') }}">
                            <div class="blog-absolute">
                                <h2>23</h2>
                                <span>March</span>
                                <span>2019</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h2>Top USA Destinations</h2>
                            <ul>
                                <li>By Admin</li>
                                <li>3 Comments</li>
                            </ul>
                            <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero auctor, ornare ante. Morbi quis ex eleifend, sodales nulla vitae, scelerisque ante.</p>
                            <a href="#" class="primary-btn">Read More</a>
                        </div>
                    </div>
                    <!-- Blog Item End -->
                    <!-- Pagination Being -->
                    <div class="blog-pagination">
                        <a href="#" class="active">01</a>
                        <a href="#">02</a>
                        <a href="#">03</a>
                    </div>
                    <!-- Pagination Being -->
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
