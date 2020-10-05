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
