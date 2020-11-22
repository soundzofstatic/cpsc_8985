@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Console
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Businesses</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach($businesses as $business)
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items"
                               href="{{ route('business.home', ['business'=>$business->id]) }}">
                                <div class="arrange-pic">
                                    @if(!empty($business->mainPhoto))
                                        <img src="/storage/{{ str_replace("public/", "", $business->mainPhoto->file_path) }}" alt="{{ $business->mainPhoto->alt_text }}">
                                    @else
                                        <img src="{{ parse_url(asset('img/arrange/arrange-1.jpg'), PHP_URL_PATH) }}" alt="">
                                    @endif
                                    <div class="rating">{{ $business->rating() }}</div>
                                    <div class="tic-text">Restaurants</div>
                                </div>
                                <div class="arrange-text">
                                    <h5>{{ $business->name  }}</h5>
                                    <span>{{ $business->address }}</span>
                                    <div class="open tomorrow">Visits - {{ $business->businessVisit->count() }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-lg-12 text-right">
                        <div class="pagination-num">
                            @for($i=1;$i<=(int)$totalPages;$i++)
                                <a href="{{ route('business.show-all', ['page' => $i]) }}" class="{{ ($page == $i OR ($page == 0 AND $i == 1))? 'active': '' }}">{{ $i }}</a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
@endsection
