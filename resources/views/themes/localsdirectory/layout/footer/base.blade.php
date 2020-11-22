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
                        <li><a href="/">Home</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="{{ route('business.show-all') }}">Businesses</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Useful Links</h4>
                    <ul>
{{--                        <li>About us</li>--}}
{{--                        <li>Testimonials</li>--}}
                        <li><a href="{{ route('events.home') }}">Events</a></li>
{{--                        <li>Create an account</li>--}}
{{--                        <li>Our Services</li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Newest on the Platform</h4>
                    @foreach(\App\Business::limit(2)->orderBy('created_at', 'desc')->get() as $business)
                        <div class="single-blog">
                            <a href="{{ route('business.home', ['business' => $business->id]) }}">
                                <div class="blog-pic">
                                    @if(!empty($business->mainPhoto))
                                        <img src="/storage/{{ str_replace("public/", "", $business->mainPhoto->file_path) }}" alt="{{ $business->mainPhoto->alt_text }}">
                                    @else
                                        <img src="{{ parse_url(asset('img/f-blog-1.jpg'), PHP_URL_PATH) }}" alt="">
                                    @endif
                                </div>
                                <div class="blog-text">
                                    <h6>{{ $business->name }}</h6>
                                    <span>{{ $business->created_at->format('F d, Y') }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
                    <a href="{{ route('business.show-all') }}">Businesses</a>
                    <a href="{{ route('events.home') }}">Events</a>
                    <a href="{{ route('register') }}">Register</a>
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
</footer>