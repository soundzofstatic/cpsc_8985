@extends('themes.localsdirectory.layout.base')
@section ('page_name')Home
@endsection
@section ('content')
    @include ('themes.localsdirectory.layout.section.hero.hero')
    @include ('themes.localsdirectory.layout.section.trending')
    @include ('themes.localsdirectory.layout.section.categories')
    @include ('themes.localsdirectory.layout.section.testimonials')
{{--    @include ('themes.localsdirectory.layout.section.events')--}}
    @include ('themes.localsdirectory.layout.section.download-app')
@endsection
