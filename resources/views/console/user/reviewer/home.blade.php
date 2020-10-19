@extends('themes.localsdirectory.layout.base')
@section ('page_name')User Console
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>User Console</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Reviews</h2>
                <p>See your last 5 reviews.</p>
            </div>
            <div class="col-md-12">
                @foreach($user->lastFiveReviews as $review)
                    <div class="row mb-2" style="border: thin solid red">
                        <div class="col-md-12 p-3 shadow ">
                            <p>{{ $review->business->name }}</p>
                            <p>{{ $review->originalFeedback->text }}</p>
                            <p>{{ $review->created_at->format('m/d/Y g:i:s a') }}</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary px-3 btn-sm">Useful</button>
                                    <button type="button" class="btn btn-outline-secondary px-2 btn-sm">Funny</button>
                                    <button type="button" class="btn btn-outline-secondary px-2 btn-sm">Cool</button>
                                    </div>
                                <div>
                                    <a href="/" class="mr-2">Reply</a>
                                    <a href="/" class="mr-2">Comment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Check-Ins</h2>
                <p>See your last 5 check-ins.</p>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                @foreach($user->lastFiveBusinessCheckIns as $CheckIn)
                        <div class="col-md-4 m-1" style="border: thin solid red">
                            <p>{{ $CheckIn->business->name }}</p>
                            <p>{{ $CheckIn->created_at->format('m/d/Y g:i:s a') }}</p>
                        </div>
                @endforeach
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Bookmarks</h2>
                <p>See all of your bookmarks.</p>
            </div>

            <div class="col-md-12">
                <div class="row">
                    @foreach($user->bookmarks as $bookmark)
                        <div class="col-md-3 m-1" style="border:thin solid red">
                            <p>{{ $bookmark->business->name }}</p>
                            <p>{{ $bookmark->created_at->format('m/d/Y g:i:s a') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <a href="{{ route('console.user.settings', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}"
                   class="primary-btn">User Settings</a>
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
