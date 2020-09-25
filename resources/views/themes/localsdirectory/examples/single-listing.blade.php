@extends('themes.localsdirectory.layout.base')
@section ('page_name')Single Listing
@endsection
@section ('content')
    <!-- Hero Section Begin -->
    <div class="hero-listing set-bg" data-setbg="{{ asset('img/hero_listing.jpg') }}">
    </div>
    <!-- Hero Section End -->

    <!-- About Secton Begin -->
    <section class="about-section">
        <div class="intro-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about-intro">
                            <div class="rating">4.9</div>
                            <div class="intro-text">
                                <h2>Trocadero Restaurant</h2>
                                <p>Explore some of the best places in the world</p>
                                <div class="open">Opens Tomorow at 10am</div>
                                <div class="closed">Closed now</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1">
                        <div class="intro-share">
                            <div class="share-btn">
                                <a href="#" class="share">Share</a>
                                <a href="#">Submit a Review</a>
                            </div>
                            <div class="share-icon">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <a href="#"><i class="fa fa-book"></i></a>
                                <a href="#"><i class="fa fa-hand-o-right"></i></a>
                                <a href="#"><i class="fa fa-user-o"></i></a>
                                <a href="#"><i class="fa fa-star-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="about-left">
                            <!-- About Begin -->
                            <div class="about-desc">
                                <h4>About the Restaurant</h4>
                                <p>Donec eget efficitur ex. Donec eget dolor vitae eros feugiat tristique id vitae massa. Proin vulputate congue rutrum. Fusce lobortis a enim eget tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus.</p>
                                <p>Fusce urna quam, euismod sit amet mollis quis, vestibulum quis velit. Vestibulum malesuada aliquet libero viverra cursus. Aliquam erat volutpat. Morbi id dictum quam, ut commodo lorem. In at nisi nec arcu porttitor aliquet vitae at dui. Sed sollicitudin nulla non leo viverra scelerisque. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero auctor, ornare ante. Morbi quis ex eleifend, sodales nulla vitae, scelerisque ante. Nunc id vulputate dui. Suspendisse consectetur rutrum metus nec scelerisque.</p>
                                <p>Donec bibendum, enim ut luctus dictum, nisl turpis scelerisque sem, in dapibus neque odio eu sapien. Morbi ac aliquet erat. Sed dapibus, augue et malesuada maximus, neque ligula vehicula mauris, eget eleifend tortor magna luctus</p>
                            </div>
                            <div class="about-video">
                                <img src="{{ asset('img/video-bg.jpg') }}" alt="">
                                <a href="https://www.youtube.com/watch?v=fySJrtzyMy4" class="pop-up"><i class="fa fa-play"></i></a>
                            </div>
                            <!-- About End -->
                            <!-- Reviews Begin -->
                            <div class="client-reviews">
                                <h3>Reviews</h3>
                                <div class="reviews-item">
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <h5>“A Great Place”</h5>
                                    <p>Donec eget efficitur ex. Donec eget dolor vitae eros feugiat tristique id vitae massa. Proin vulputate congue rutrum. Fusce lobortis a enim eget tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                                    <div class="client-text">
                                        <h5>Michael Smith</h5>
                                        <span>March 03, 2019</span>
                                    </div>
                                </div>
                                <div class="reviews-item">
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <h5>“The best food in town”</h5>
                                    <p>Donec eget efficitur ex. Donec eget dolor vitae eros feugiat tristique id vitae massa. Proin vulputate congue rutrum. Fusce lobortis a enim eget tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                                    <div class="client-text">
                                        <h5>Michael Smith</h5>
                                        <span>March 03, 2019</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Reviews End -->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-right">
                            <!-- Contact Begin -->
                            <div class="contact-info">
                                <div class="map">
                                    <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26440.72384129847!2d-118.24906619231132!3d34.06719475913053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c659f50c318d%3A0xe2ffb80a9d3820ae!2sChinatown%2C%20Los%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1570213740685!5m2!1sen!2sbd"
                                            height="385" style="border:0;" allowfullscreen="">
                                    </iframe>
                                    <img src="{{ asset('img/pin.png' ) }}" alt="">
                                </div>
                                <div class="contact-text">
                                    <h4>Contact Info</h4>
                                    <span>Main Road , No 25/11</span>
                                    <ul>
                                        <li>+34 556788 3221</li>
                                        <li>contact@pizzaplace.com</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Contact End -->
                            <!-- Hours Begin -->
                            <div class="working-hours">
                                <h4>Working Hours</h4>
                                <ul>
                                    <li>Monday<span>08:00 - 22:00</span></li>
                                    <li>Tuesday<span>08:00 - 22:00</span></li>
                                    <li>Wednesday<span>08:00 - 22:00</span></li>
                                    <li>Thursday<span>08:00 - 22:00</span></li>
                                    <li>Friday <span>08:00 - 22:00</span></li>
                                    <li>Saturday<span>08:00 - 22:00</span></li>
                                    <li>Sunday<span>Closed</span></li>
                                </ul>
                            </div>
                            <!-- Hours End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Secton End -->
@endsection