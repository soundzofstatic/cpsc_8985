@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Profile picture Settings
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Business Profile picture Settings</h1>
{{--                @dd(\Request::route()->getName())--}}
            </div>
        </div>
        <!-- Avatar Begin -->
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-item">
                    <div class="blog-text">
                        <h2>Business Image</h2>
{{--                        todo - You cannot use this form to Remove a photo because you do not pass the context of the ID of the photo to delete to this form --}}
{{--                        todo - You can just use a link to destroy the photo from wherever we will show business photos in the Business console --}}
{{--                        @if(!empty(Auth::user()->photo))--}}
{{--                            <div class="row mb-3">--}}
{{--                                <div class="col-md-12 text-center">--}}
{{--                                    <div class="avatar-preview">--}}
{{--                                        <div class="image text-center">--}}
{{--                                            <img src="/storage/{{ str_replace("public/", "", Auth::user()->photo->file_path) }}"--}}
{{--                                                 alt="{!! Auth::user()->photo->alt_text !!}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="delete-link">--}}
{{--                                        <a href="{{ route('console.user.businesses.business.update.destroy-photo', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="btn btn-md btn-danger">Remove Avatar Photo</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        @if(\Request::route()->getName() == 'business.photo.upload-photo')
                            <form method="POST" action="{{ route('business.photo.store-photo', ['business' => $business->id]) }}" enctype="multipart/form-data">
                        @else
                            <form method="POST" action="{{ route('console.user.businesses.business.update.photo.store-photo', ['user' => \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}" enctype="multipart/form-data">
                        @endif
                            @csrf

                            <div class="form-group row">
                                <label for="file_path" class="col-md-4 col-form-label text-md-right">{{ __('Image Upload') }}</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control form-control-file" id="file_path" name="file_path">

                                    @error('file_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alt-text"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Alternative Text for Image') }}</label>

                                <div class="col-md-6">
                                    <input id="alt-text" type="text"
                                           class="form-control @error('alt-text') is-invalid @enderror" name="alt-text"
                                           value="{{ old('alt-text') }}" autofocus>

                                    @error('alt-text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
