@extends('themes.localsdirectory.layout.base')
@section ('page_name')Single Listing
@endsection
@section ('content')
    <!-- Hero Section Begin -->
    <div class="hero-listing set-bg" data-setbg="{{ asset('img/how-it-works-bg.jpg') }}">
    </div>
    <!-- Hero Section End -->

    <!-- How It Works Begin -->
    <section class="howitworks-section spad">
        <div class="container">
            <div class="row mb-110">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="howit-item">
                        <h2>Choose a package</h2>
                        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero auctor, ornare ante. Morbi quis ex eleifend,sodales nulla vitae, scelerisque ante. </p>
                    </div>
                    <a href="#" class="primary-btn">See Pricing</a>
                </div>
                <div class="col-lg-5 offset-lg-1 order-1 order-lg-2">
                    <div class="howit-img">
                        <img src="{{ asset('img/how-it-works-1.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row mb-110">
                <div class="col-lg-5">
                    <div class="howit-img insige-bg">
                        <img src="{{ asset('img/how-it-works-2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="howit-item">
                        <h2>Submit a Listing</h2>
                        <p>Donec eget efficitur ex. Donec eget dolor vitae eros feugiat tristique id vitae massa. Proin vulputate congue rutrum. Fusce lobortis a enim eget tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero.</p>
                    </div>
                    <a href="#" class="primary-btn">Add Listing</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="howit-item">
                        <h2>Weight for Approval</h2>
                        <p>Fusce lobortis a enim eget tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl a, auctor euismod purus. Morbi pretium interdum vestibulum. Fusce nec eleifend ipsum. Sed non blandit tellus. Phasellus facilisis lobortis metus, sit amet viverra lectus finibus ac. Aenean non felis dapibus, placerat libero auctor, ornare ante. Morbi quis ex eleifend, sodales nulla vitae, scelerisque ante.</p>
                    </div>
                    <a href="#" class="primary-btn">Create Account</a>
                </div>
                <div class="col-lg-4 offset-lg-1 order-1 order-lg-2">
                    <div class="howit-img last-img">
                        <img src="{{ asset('img/how-it-works-3.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="howit-bg">
                <img src="{{ asset('img/howit-bg.png') }}" alt="">
            </div>
        </div>
    </section>
    <!-- How It Works End -->
@endsection
