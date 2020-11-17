@extends('themes.localsdirectory.layout.base')
@section ('page_name')Events Info
@endsection
@section ('content')
    <section class="work-section set-bg" data-setbg="">
        <div class="intro-item">
            <div class="about-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-left">
                                <!-- About Begin -->
                                <div class="about-desc">
                                    <h2>Events Details</h2>
                                    <p></p>
                                    <div class="row mb-2" style="border: thin solid red">
                                        <div class="col-md-12 p-3 shadow ">
                                            <p>Name: {{ $event->name }}</p>
                                            <p>Description: {{ $event->description }}</p>
                                            <p>ID: {{ $event->business_id }}</p>
                                            <p>Date & Time: {{ $event->start_date }}</p>
                                            <div class="d-flex align-items-center justify-content-between my-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{--                                <form action="{{route('console.user.businesses.business.update.events.show', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id])}}"--}}
{{--                                      method="POST">--}}
{{--                                </form>--}}

{{--                                <div class="open">Opens Tomorow at 10am</div>--}}
{{--                                <div class="closed">Closed now</div>--}}