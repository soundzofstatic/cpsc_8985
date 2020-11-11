@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Listing
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Business Listing</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Businesses</h2>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                    @foreach($businesses as $business)
                        <div class="col-lg-4 col-sm-6 p-2" style="border: thin solid red">
                            <a class="arrange-items"
                               href="{{ route('business.home', ['business'=>$business->id]) }}">
                                <div class="arrange-text">
                                    <h5>{{ $business->name  }}</h5>
                                    <span>{{ $business->address }}</span>
                                    <br/>
                                    <span>{{ $business->created_at->format('m/d/Y g:i:s a') }}</span>
                                    <br/>
                                    <div class="open tomorrow">Visits - {{ $business->businessVisit->count() }}</div>
                                </div>
                                @if($business->is_active)
                                    <a href="{{ route('console.user.admin.update.business.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                       class="btn btn-sm btn-danger">Suspend Business</a>
                                @else
                                    <a href="{{ route('console.user.admin.update.business.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                       class="btn btn-sm btn-success">Enable Business</a>
                                @endif
                                <a href="{{ route('console.user.businesses.business.update.promoted_business.create', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                   class="btn btn-sm btn-warning">Create Promotion</a>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Logout Begin -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <!-- Logout End -->
    </main>
@endsection
