@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Console
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Business Console</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Business</h2>
                <p>See all the details surrounding your business. Select a business</p>
            </div>
            {{--  todo - Render Data            --}}
            <div class="col-md-12">

                <div class="row">
                    {{--                    <div class="col-lg-12">--}}
                    {{--                        <form action="#" class="arrange-select">--}}
                    {{--                            <span>Arrange by</span>--}}
                    {{--                            <select>--}}
                    {{--                                <option>Newest</option>--}}
                    {{--                                <option>Oldest</option>--}}
                    {{--                            </select>--}}
                    {{--                        </form>--}}
                    {{--                    </div>--}}
                    @foreach($user->businesses as $business)
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items"
                               href="{{ route('console.user.businesses.business.business-console', ['user'=>$user->id, 'business'=>$business->id]) }}">
                                <div class="arrange-pic">
                                    <img src="{{ parse_url(asset('img/arrange/arrange-1.jpg'), PHP_URL_PATH) }}" alt="">
                                    <div class="rating">{{ $business->rating() }}</div>
                                    <div class="tic-text">Restaurants</div>
                                </div>
                                <div class="arrange-text">
                                    <h5>{{ $business->name  }}</h5>
                                    <span>{{ $business->address }}</span>
                                </div>
                            </a>
                        </div>



                    @endforeach
                    <div class="col-lg-12 text-right">
                        <div class="pagination-num">
                            <a href="#">01</a>
                            <a href="#">02</a>
                            <a href="#">03</a>
                        </div>

                    </div>
                </div>


                {{--                @foreach($user->businesses as $business)--}}
                {{--                    <div class="row mb-2" style="border: thin solid red">--}}
                {{--                        <div class="col-md-12 p-3 shadow ">--}}
                {{--                            <p>{{ $review->business->name }}</p>--}}
                {{--                            <p>{{ $review->originalFeedback->text }}</p>--}}
                {{--                            <p>{{ $review->created_at->format('m/d/Y g:i:s a') }}</p>--}}
                {{--                            <div class="d-flex align-items-center justify-content-between my-3">--}}
                {{--                                <div>--}}
                {{--                                    <button type="button" class="btn btn-outline-secondary px-3 btn-sm">Useful</button>--}}
                {{--                                    <button type="button" class="btn btn-outline-secondary px-2 btn-sm">Funny</button>--}}
                {{--                                    <button type="button" class="btn btn-outline-secondary px-2 btn-sm">Cool</button>--}}
                {{--                                </div>--}}
                {{--                                <div>--}}
                {{--                                    <a href="#" class="mr-2">Reply</a>--}}
                {{--                                    <a href="#" class="mr-2">Comment</a>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--  todo - Render list of all businesses owned by Authenticated user --}}
                {{--                @endforeach--}}
            </div>




        {{--        <div class="row mb-5">--}}
        {{--            <div class="col-lg-12 text-center">--}}
        {{--                <a href="{{ route('console.user.settings', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="primary-btn">User Settings</a>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <!-- Logout Begin -->




            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form><!-- Logout End -->

        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Create a Business</h2>
                <p>Click on the button below to start creating a new business.</p>
                <a href="{{ route('console.user.businesses.create', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}"
                   class="btn btn-primary">Create Business</a>
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
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#search').click(function () {
                searchUsers();
            });
            $('#reset').click(function () {
                resetSearchUsers();
            });
            $('input#query').on('keyup', function (event) {

                if (event.key == 'Enter') {
                    searchUsers();
                }

                if (event.key == 'Escape') {
                    resetSearchUsers();
                }

            });
            $('#search-results').on('click', 'button.action', function () {

                var action = $(this).data('action');

                if (action == 'promote') {

                    window.location.href = '/console/update/user/' + $(this).data('user') + '/promote-to-admin';

                } else if (action == 'demote') {

                    window.location.href = '/console/update/user/' + $(this).data('user') + '/demote-from-admin';

                }

            });

            /**
             * Function used to search for users and render them to the page
             */
            function searchUsers() {
                $.ajax({
                    url: "{{ route('user-query') }}",
                    method: 'POST',
                    data: {
                        query: $('input#query').val()
                    },
                    success: function (json_response) {
                        var markup = '';

                        json_response.data.forEach(function (element, index) {

                            markup += '<div class="col-lg-4 col-sm-6">';
                            markup += '<div class="arrange-items">';
                            markup += '<div class="arrange-pic">';
                            if (element.attributes.is_admin) {
                                markup += '<div class="tic-text admin">Admin</div>';
                            } else {
                                markup += '<div class="tic-text reviewer">Reviewer</div>';
                            }

                            markup += '</div>';
                            markup += '<div class="arrange-text">';
                            markup += '<h5>' + element.attributes.first_name + ' ' + element.attributes.last_name + '</h5>';
                            if (element.attributes.username != null) {
                                markup += '<span>' + element.attributes.username + '</span>';
                            }
                            markup += '<p>' + element.attributes.email + '</p>';

                            // todo - Connect click functionality
                            if (element.attributes.is_admin) {
                                markup += '<button class="demote action" data-action="demote" data-user="' + element.id + '">Demote</button>';
                            } else {
                                markup += '<button class="promote action" data-action="promote" data-user="' + element.id + '">Promote</button>';
                            }

                            markup += '</div>';
                            markup += '</div>';
                            markup += '</div>';

                        });

                        $('#search-results .row').html(markup);

                    },
                    error: function (error_response) {

                        // todo

                    }
                })

            }

            function resetSearchUsers() {
                $('#search-results .row').html('');
            }

        });
    </script>
@endsection
