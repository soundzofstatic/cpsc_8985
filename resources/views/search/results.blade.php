@extends('themes.localsdirectory.layout.base')
@section ('page_name')Results
@endsection
@section ('content')
    @include ('themes.localsdirectory.layout.section.hero.map')
    @include ('themes.localsdirectory.layout.section.search.search')
    @include ('themes.localsdirectory.layout.section.search.results')
@endsection