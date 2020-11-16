@extends('themes.localsdirectory.layout.base')
@section ('page_name')Home
@endsection
@section ('content')
    @include ('themes.localsdirectory.layout.section.hero.hero')
    @include ('themes.localsdirectory.layout.section.trending')
{{--    @include ('themes.localsdirectory.layout.section.categories')--}}
    <!-- Testimonial Section Begin -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="testimonial-item owl-carousel">
                        @foreach($feedBacks as $feedback)
                            <div class="single-testimonial-item">
                                @if(!empty($feedback->user->avatar))
                                    <img src="/storage/{{ str_replace("public/", "", Auth::user()->avatar->file_path) }}"
                                         alt="{!! Auth::user()->avatar->alt_text !!}"/>
                                @endif
                                <p>{{ $feedback->text }}</p>
                                <h4>{{ $feedback->user->first_name }} {{ $feedback->user->last_name }}</h4>
                                @if(!empty($feedback->review_id))
                                    <a href="{{ route('business.home', ['business' => $feedback->review->business->id]) }}" class="btn btn-primary btn-lg">See Review full context</a>
                                @elseif(!empty($feedback->question_id))
                                    <a href="{{ route('business.home', ['business' => $feedback->question->business->id]) }}" class="btn btn-primary btn-lg">See Question full context</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="bg-img">
                <img src="{{ parse_url(asset('img/testimonial-bg.png'), PHP_URL_PATH) }}" alt="">
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->
{{--    @include ('themes.localsdirectory.layout.section.events')--}}
{{--    @include ('themes.localsdirectory.layout.section.download-app')--}}
@endsection
