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
                            <div class="rating">{{ $business->rating() }}</div>
                            <div class="intro-text">
                                <h2>{{ $business->name }}</h2>
                                <p>Explore some of the best places in the world</p>
{{--                                <div class="open">Opens Tomorow at 10am</div>--}}
{{--                                <div class="closed">Closed now</div>--}}
                                <div class="open">Visits - {{ $business->businessVisit->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1">
                        <div class="intro-share">
                            <div class="share-btn">
                                <a href="{{ route('console.user.businesses.business.update.social-media.create', ['user' => \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}" class="share">Add Social Media Link</a>
                                {{--                                <a href="#">Submit a Review</a>--}}
                                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                    @if($business->is_active)
                                        <a href="{{ route('console.user.admin.update.business.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                           class="btn btn-sm btn-danger">Suspend Business</a>
                                    @else
                                        <a href="{{ route('console.user.admin.update.business.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                           class="btn btn-sm btn-success">Enable Business</a>
                                    @endif
                                @endif
                                <div class="share-btn">
                                    <a href="{{route('console.user.businesses.business.update.events.create', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id])}}"
                                       class="btn btn-danger">Create an Event</a>
                                </div>
                                <div class="share-btn">
                                    <a href="{{route('console.user.businesses.business.edit', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id])}}"
                                       class="btn btn-danger">Edit Business</a>
                                </div>
                            </div>
                            <div class="share-icon">
{{--                                <a href="#"><i class="fa fa-map-marker"></i></a>--}}
{{--                                <a href="#"><i class="fa fa-book"></i></a>--}}
{{--                                <a href="#"><i class="fa fa-hand-o-right"></i></a>--}}
{{--                                <a href="#"><i class="fa fa-user-o"></i></a>--}}
{{--                                <a href="#"><i class="fa fa-star-o"></i></a>--}}
                                @foreach($business->businessSocialMedia as $socialMedia)
                                    @if(\App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS[0] == $socialMedia->social_media_provider)
                                        <a href="{{ $socialMedia->social_media_link }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    @endif
                                    @if(\App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS[1] == $socialMedia->social_media_provider)
                                        <a href="{{ $socialMedia->social_media_link }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                    @endif
                                    @if(\App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS[2] == $socialMedia->social_media_provider)
                                        <a href="{{ $socialMedia->social_media_link }}" target="_blank"><i class="fa fa-instagram"></i></a>
                                    @endif
                                    @if(\App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS[3] == $socialMedia->social_media_provider)
                                        <a href="{{ $socialMedia->social_media_link }}" target="_blank"><i class="fa fa-youtube"></i></a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="share-icon">
                                @for($i=0;$i<$business->dollar_rating;$i++)
                                    <i class="fa fa-usd"></i>
                                @endfor
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
                                <p>{{ $business->description }}</p>
                            </div>
                            <!-- About End -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                         <div class="about-services">
                                                <h4>Services Provided</h4>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Reviews Begin -->
                            <div class="client-reviews">
                        <h3>Reviews</h3>
                        @foreach($business->reviews as $review)
                                    <div class="reviews-item">
                                    <div class="rating">
                                        @for($i=0;$i<$review->rating;$i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i=0;$i< (5 - $review->rating);$i++)
                                            <i class="fa fa-star-o"></i>
                                        @endfor
                                    </div>
                                    <h5>Review Title</h5>
                                    <p>{{ $review->originalFeedback->text }}</p>
                                    <div class="client-text">
                                        <h5><a href="{{ route('user.home', ['user' => $review->user_id]) }}" class="author-link">{{ $review->user->first_name }} {{ $review->user->last_name }}</a></h5>
                                        <span>{{ $review->created_at->format('F j, Y, g:i a') }}</span>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="row">
                                        @foreach($review->relatedFeedbacks as $relatedFeedback)
                                            <div class="col-md-11 offset-md-1 mb-5 related-feedback" style="border-left: solid thin red;">
                                                <p>{{ $relatedFeedback->text }} </p>

                                                <div class="Additional Feedback">

                                                        <button type="button" class="btn btn-outline-secondary px-3 btn-sm">Useful</button>
                                                        <button type="button" class="btn btn-outline-secondary px-2 btn-sm">Funny</button>
                                                        <button type="button" class="btn btn-outline-secondary px-2 btn-sm">Cool</button>
                                                    <button type="button" class="btn text-danger ml-5 btn-sm" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Reply</button>
                                                    <button type="button" class="btn  text-danger btn-sm">Comment</button>
                                                    <div class="collapse" id="collapseExample">
                                                        <textarea class="card card-body">
                                                        </textarea>
                                                    </div>

                                                </div>

                                                <div class="client-text">
                                                    <h5><a href="{{ route('user.home', ['user' => $relatedFeedback->user_id]) }}" class="author-link">{{ $relatedFeedback->user->first_name }} {{ $relatedFeedback->user->last_name }}</a></h5>
                                                    <span>{{ $relatedFeedback->created_at->format('F j, Y, g:i a') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    </div>
                                </div>
                                @endforeach
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
{{--                                    <img src="{{ asset('img/pin.png' ) }}" alt="">--}}
                                </div>
                                <div class="contact-text">
                                    <h4>Contact Info</h4>
                                    <span>{{ $business->address }}</span>
                                    <ul>
                                        <li><a href="tel:{{ $business->contact_phone }}">{{ $business->contact_phone }}</a></li>
                                        <li><a href="{{ $business->web_url }}">Website</a></li>
                                        <li><a href="{{ $business->menu_url }}">Menu</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Contact End -->
                            <!-- Hours Begin -->
                            <div class="working-hours">
                                <h4>Working Hours</h4>
                                <ul>
                                    <li>All week:<span>{{ $business->hours }}</span></li>
                                </ul>
                            </div>
                            <!-- Hours End -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Check-ins</h2>
                                <p>The last 5 check-ins:</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-2">
                                <ul>
                                    @foreach($business->businessCheckIn->slice(0, 5) as $checkIn)
                                        <li><a href="{{ route('user.home', ['user' => $checkIn->user_id]) }}" class="author-link">{{ $checkIn->user->first_name }} {{ $checkIn->user->last_name }}</a> on {{ $checkIn->created_at->format('F j, Y, g:i a') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- About Section End -->
@endsection
