@extends('themes.localsdirectory.layout.base')
@section ('page_name')Console Home
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Console Home</h1>
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
            <div class="row mb-5">
                <!-- User Console Begin -->
                <div class="{{ \Illuminate\Support\Facades\Auth::user()->isAdmin() ? 'col-lg-4' : 'col-lg-6' }}">
                    <div class="trend-item">
                        <div class="trend-pic">
                            <img src="{{ asset('img/trending/trending-1.jpg') }}" alt="">
                            <div class="rating">4.9</div>
                        </div>
                        <div class="trend-text">
                            <h4>User Console</h4>
                            <p>Review all actions by your user account.</p>
                            <a href="{{ route('console.user.reviewer.home', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="closed">Manage</a>
                        </div>
                        <div class="tic-text">User</div>
                    </div>
                </div>
                <!-- User Console End -->
                <!-- Business Console Begin -->
                <div class="{{ \Illuminate\Support\Facades\Auth::user()->isAdmin() ? 'col-lg-4' : 'col-lg-6' }}">
                    <div class="trend-item nightlife">
                        <div class="trend-pic">
                            <img src="{{ asset('img/trending/trending-2.jpg') }}" alt="">
                            <div class="rating">4.9</div>
                        </div>
                        <div class="trend-text">
                            <h4>Business Console</h4>
                            <p>See latest updates for your businesses.</p>
                            <a href="{{ route('console.user.businesses.home', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="closed">Manage</a>
                        </div>
                        <div class="tic-text">Business</div>
                    </div>
                </div>
                <!-- Business Console End -->
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <!-- Admin Console Begin -->
                    <div class="col-lg-4">
                        <div class="trend-item hotels">
                            <div class="trend-pic">
                                <img src="{{ asset('img/trending/trending-3.jpg') }}" alt="">
                                <div class="rating">4.6</div>
                            </div>
                            <div class="trend-text">
                                <h4>Admin Console</h4>
                                <p>Manage users, businessesses and related reviews.</p>
                                <a href="{{ route('console.user.admin.home', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="closed">Manage</a>
                            </div>
                            <div class="tic-text">Admin</div>
                        </div>
                    </div>
                    <!-- Admin Console End -->
                @endif
            </div>

    @endif
    <div class="row mb-5">
        <!-- User Console Begin -->
        <div class="col-lg-12" id="notifications">
            <h4>Notifications</h4>
            <p>Review all alerts.</p>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Helpers\Alert::unread() as $alert)
                    <tr>
                        <td>{{ $alert->text }}{{ \App\Helpers\Alert::markRead($alert) }}</td>
                        <td>{{ $alert->created_at->format('m/d/Y g:ia') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- User Console End -->
    </div>
    <!-- Logout Begin -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <!-- Logout End -->
    </main>
@endsection
