@extends('themes.localsdirectory.layout.base')
@section ('page_name')Create a Business
@endsection
@section ('content')
    <main class="container main-pad">
        {{--                todo - Replace front-page with actual route that stores/processes the data submitted in the form --}}
        <h1>Add Social Media Link</h1>
        <p>Add a social Media Link for {{ $business->name }} by comnpleting the form below.</p>
        <form action="{{ route('console.user.businesses.business.update.social-media.store', ['user' => \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
              method="POST">
            @csrf
            <div class="form-group row">
                <label for="social_media_provider" class="col-md-4 col-form-label text-md-right"><b>Social Media Provider</b></label>
                <div class="col-md-6">
                    <select class="custom-select mb-3" name="social_media_provider">
                        <option selected>Select</option>
                        @foreach(\App\BusinessSocialMedia::SOCIAL_MEDIA_PROVIDERS as $socialMediaProvider)
                            <option value="{{ $socialMediaProvider }}">{{ $socialMediaProvider }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="social_media_link" class="col-md-4 col-form-label text-md-right"><b>Social Media URL</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Social Media URL" name="social_media_link" required class="form-control">
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <button type="submit">Submit</button>
            </div>
        </form>
    <!-- Logout Begin -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <!-- Logout End -->
    </main>
@endsection
