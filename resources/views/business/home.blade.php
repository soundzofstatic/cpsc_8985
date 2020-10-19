@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Console
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Business Page</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Review</h2>
            </div>
            <div class="col-md-12">
                {{--  todo - Render Data            --}}
                <div class="row">
                    {{--                Write a review:--}}
                    <div class="col-md-4">
                        <form action="{{ route('business.action.store-review', ['business' => $business->id]) }}" method="POST">
                            @csrf
                            <fieldset>
                                <legend> RATING SURVEY:</legend>
                                <label for="name">Name:</label>
                                <input type="text" name="name" value="">
                                <br><br>
                                <label for="email">Please tell us your email address: </label>
                                <input type="text" name="email" value="">
                                <br><br>

                                <label for="movie">Restaurant you recently visited: </label>
                                <input type="text" name=“Restaurant” value="">
                                <p><label for="rating">Please rate the resturant:</label></p>
                                <input type="radio" name="rating" value="Very Bad" checked> Very Bad<br>
                                <input type="radio" name="rating" value="Bad"> Bad<br>
                                <input type="radio" name="rating" value="Good"> Good<br>
                                <input type="radio" name="rating" value="Very Good"> Very Good<br>

                                <p>
                                    <label for="survey">
                                        Would you like to be contacted again for addtional surveys?
                                    </label>
                                </p>
                                <input type="radio" name="survey" value="yes" checked> Yes<br>
                                <input type="radio" name="survey" value="no"> No<br>
                                <p align="center">
                                    <input type="submit" name="submit" value="Submit My Information"/>
                                </p>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <p>CALL: 998-77-8888</p>
                    </div>
                </div>
            </div>
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
