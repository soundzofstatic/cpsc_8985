@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Listing
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Promoted Business Listing</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Promoted Businesses</h2>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                    @foreach($promotedBusinesses as $promotedBusiness)
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items"
                               href="{{ route('business.home', ['business'=>$promotedBusiness->business->id]) }}">
                                <div class="arrange-text p-3" style="border: thin solid red">
                                    <h5>{{ $promotedBusiness->business->name }} </h5>
                                    {{--                                    <span>{{ $user->email }}</span>--}}
                                    {{--                                    <br/>--}}
                                    <h6>Promotion period</h6>
                                    <span>{{ $promotedBusiness->start_date->format('m/d/Y g:i:s a') }} - {{ $promotedBusiness->end_date->format('m/d/Y g:i:s a') }}</span>
                                    <br/>
                                    <span>{{ $promotedBusiness->promo_location }}</span>
                                    <br/>
                                    @if($promotedBusiness->is_active)
                                        <a href="{{ route('console.user.admin.update.promoted_business.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'promoted_business' => $promotedBusiness->id]) }}"
                                           class="btn btn-sm btn-danger">Suspend Promotion</a>
                                    @else
                                        <a href="{{ route('console.user.admin.update.promoted_business.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'promoted_business' => $promotedBusiness->id]) }}"
                                           class="btn btn-sm btn-success">Activate Promotion</a>
                                    @endif
                                    <a href="{{ route('console.user.admin.update.promoted_business.destroy', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'promoted_business' => $promotedBusiness->id]) }}" title="Delete Promotion"><i class="fa fa-trash-o"></i></a>
                                </div>
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
