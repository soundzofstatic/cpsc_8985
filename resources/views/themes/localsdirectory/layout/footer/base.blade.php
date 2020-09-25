<footer class="footer-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="#" class="newslatter-form">
                    <input type="text" placeholder="Your email address">
                    <button type="submit">Subscribe to our Newsletter</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Usefull Links</h4>
                    <ul>
                        <li>About us</li>
                        <li>Testimonials</li>
                        <li>How it works</li>
                        <li>Create an account</li>
                        <li>Our Services</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Categories</h4>
                    <ul>
                        <li>Hotels</li>
                        <li>Restaurant</li>
                        <li>Spa & resorts</li>
                        <li>Concert & Events</li>
                        <li>Bars & Pubs</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Usefull Links</h4>
                    <ul>
                        <li>About us</li>
                        <li>Testimonials</li>
                        <li>How it works</li>
                        <li>Create an account</li>
                        <li>Our Services</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>From the Blog</h4>
                    <div class="single-blog">
                        <div class="blog-pic">
                            <img src="{{ asset('img/f-blog-1.jpg') }}" alt="">
                        </div>
                        <div class="blog-text">
                            <h6>10 Best clubs in town</h6>
                            <span>March 27, 2019</span>
                        </div>
                    </div>
                    <div class="single-blog">
                        <div class="blog-pic">
                            <img src="{{ asset('img/f-blog-2.jpg') }}" alt="">
                        </div>
                        <div class="blog-text">
                            <h6>10 Best clubs in town</h6>
                            <span>March 27, 2019</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer-bottom">
            <div class="col-lg-5 order-2 order-lg-1">
                <div class="copyright"><p class="text-white">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p></div>
            </div>
            <div class="col-lg-7 text-center text-lg-right order-1 order-lg-2">
                <div class="footer-menu">
                    <a href="/">Home</a>
                    <a href="{{ route('theme.how-it-works') }}">Explore</a>
                    <a href="{{ route('theme.listings') }}">More Cities</a>
                    <a href="{{ route('theme.blog') }}">News</a>
                    <a href="{{ route('theme.contact') }}">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>