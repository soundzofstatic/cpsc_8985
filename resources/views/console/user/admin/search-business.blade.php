@extends('themes.localsdirectory.layout.base')
@section ('page_name')Results
@endsection
@section ('content')
<main class="container main-pad">
    <div class="row">
        <div class="col">
            <h1>Search Results</h1>
            <p>Search results of businesses</p>
        </div>
    </div>
    <section class="filter-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($businesses as $business)
                            <div class="col-lg-4 col-sm-6">
                                <a class="arrange-items"
                                   href="{{ route('console.user.businesses.business.business-console', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business'=>$business->id]) }}">
                                    <div class="arrange-pic">
                                        <img src="{{ parse_url(asset('img/arrange/arrange-1.jpg'), PHP_URL_PATH) }}" alt="">
                                        <div class="rating">{{ $business->rating() }}</div>
                                    </div>
                                    <div class="arrange-text">
                                        <h5>{{ $business->name }}</h5>
                                        <span>{{ $business->address }}</span>
                                    </div>
                                </a>
                                <div class="disable-enable">
                                    @if($business->is_active)
                                        <a href="{{ route('console.user.admin.update.business.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                           class="btn btn-sm btn-danger">Suspend Business</a>
                                    @else
                                        <a href="{{ route('console.user.admin.update.business.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                           class="btn btn-sm btn-success">Enable Business</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

