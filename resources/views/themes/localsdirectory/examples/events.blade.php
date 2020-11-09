@extends('themes.localsdirectory.layout.base')
@section ('page_name')Events
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Events</h1>
            </div>
        </div>
    <section class="Events">
    <div class="row">
        <div class="col-md-10">
            <p>The events industry now includes events of all sizes from the Olympics down to business breakfast meetings. Many industries, celebrities, charitable organizations, and interest groups hold events in order to market their label, build business relationships, raise money, or celebrate achievement.</p>

{{--            <div class="col-md-12">--}}
{{--                @foreach($businessevents->$businessevents as $businessevents)--}}
{{--                    <div class="row mb-2" style="border: thin solid red">--}}
{{--                        <div class="col-md-12 p-3 shadow ">--}}
{{--                            <p>{{ $businessevents->business->name }}</p>--}}
{{--                            <p>{{ $businessevents->description->text }}</p>--}}
{{--                            <p>{{ $businessevents->created_at->format('m/d/Y g:i:s a') }}</p>--}}
{{--                            <div class="d-flex align-items-center justify-content-between my-3">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
</div>
    </div>
    </section>
    </main>
@endsection
