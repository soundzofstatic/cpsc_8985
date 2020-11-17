@extends('themes.localsdirectory.layout.base')
@section ('page_name')User Settings
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>User Settings</h1>
            </div>
        </div>
        @if(empty(Auth::user()->username))
            <!-- Username Begin -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Update Username</h2>
                        <p>Set your username before you can start to use {{ env('APP_NAME') }}</p>
                    </div>
                    <div class="col-md-12">
                        @include('components.username-update')
                    </div>
                </div>
                <!-- Username End -->
        @else
            <!-- Username Begin -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-item">
                        <div class="blog-text">
                            <h2>Username</h2>
                            <p>Your username is: <strong>{{ Auth::user()->username . '#' . Auth::user()->id  }}</strong>.</p>
                            <a href="{{ route('console.update.user.username-form', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="primary-btn">Change Username</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Username End -->
        @endif
    <!-- Avatar Begin -->
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-item">
                    <div class="blog-text">
                        <h2>Avatar Image</h2>
                        @if(!empty(Auth::user()->avatar))
                            <div class="row mb-3">
                                <div class="col-md-12 text-center">
                                    <div class="avatar-preview">
                                        <div class="image text-center">
                                            <img src="/storage/{{ str_replace("public/", "", Auth::user()->avatar->file_path) }}"
                                                 alt="{!! Auth::user()->avatar->alt_text !!}"/>
                                        </div>
                                    </div>
                                    <div class="delete-link">
                                        <a href="{{ route('console.user.reviewer.update.destroy-avatar', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="btn btn-md btn-danger">Remove Avatar Photo</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('console.user.reviewer.update.store-avatar-upload', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" enctype="multipart/form-data">
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
        <!-- Avatar End -->
    <!-- User Details Update Begin -->
        <div class="row">
            <div class="col-md-12">
                <h2>Update Details</h2>
            </div>
            <div class="col-md-12">
                @include('components.user-update')
            </div>
        </div>
    <!-- User Details Update End -->
    <!-- User Password Update Begin -->
        <div class="row">
            <div class="col-md-12">
                <h2>Update Password</h2>
            </div>
            <div class="col-md-12">
                @include('components.user-password-update')
            </div>
        </div>
    <!-- User Password Update End -->
    <!-- Logout Begin -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <!-- Logout End -->
    </main>
@endsection
