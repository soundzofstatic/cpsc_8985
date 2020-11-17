@extends('themes.localsdirectory.layout.base')
@section ('page_name')Promote a Business
@endsection
@section ('content')
    <main class="container main-pad">
        {{--                todo - Replace front-page with actual route that stores/processes the data submitted in the form --}}
        <h1>Promote the Business</h1>
        <p>Promote your business by submitting the details in the form below.</p>
        <form action="{{ route('console.user.businesses.business.update.promoted_business.store', ['user'=>\Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
              method="POST">
            @csrf
            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-right"><b>Start Date</b></label>
                <div class="col-md-6">
                    <input type="date" placeholder="Enter Start Dates" name="start_date" required
                           class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-md-4 col-form-label text-md-right"><b>End Date</b></label>
                <div class="col-md-6">
                    <input type="date" placeholder="Enter End Dates" name="end_date" required
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-12 text-left">
            <div class="form-group row">
                <label for="promo_location" class="col-md-4 col-form-label text-md-right"><b>Promo Location</b></label>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promo_location" id="location1" value="location_1">
                        <label class="form-check-label" for="location1">
                            Location1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promo_location" id="location2" value="location_2">
                        <label class="form-check-label" for="location2">
                            Location2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promo_location" id="location3" value="location_3">
                        <label class="form-check-label" for="location3">
                            Location3
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-center">
                <button type="submit">Submit</button>
            </div>
        </form>
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
