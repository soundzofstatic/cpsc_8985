@extends('themes.localsdirectory.layout.base')
@section ('page_name')Create a Business
@endsection
@section ('content')
    <main class="container main-pad">
        {{--                todo - Replace front-page with actual route that stores/processes the data submitted in the form --}}
        <h1>Update a Business</h1>
        <p>Update your business by submitting the details in the form below.</p>
        <form action="{{ route('console.user.businesses.business.business-update', ['user'=>\Illuminate\Support\Facades\Auth::user()->id, 'business'=> $business->id]) }}"
              method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Business Name" name="name" class="form-control" value="{{ old('name', $business->name) }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right"><b>Description</b></label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control" ></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="hours" class="col-md-4 col-form-label text-md-right"><b>Business Hours</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Hours" name="hours"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right"><b>Address</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Address" name="address"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="contact_email" class="col-md-4 col-form-label text-md-right"><b>Contact Email</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Contact Email" name="contact_email"
                           class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="contact_phone" class="col-md-4 col-form-label text-md-right"><b>Contact Phone
                        Number</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Contact Phone Number" name="contact_phone"
                           class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="menu_url" class="col-md-4 col-form-label text-md-right"><b>Menu URL</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Menu URL" name="menu_url"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="web_url" class="col-md-4 col-form-label text-md-right"><b>Web URL</b></label>
                <div class="col-md-6">
                    <input type="text" placeholder="Enter Website URL" name="web_url"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="established_on" class="col-md-4 col-form-label text-md-right"><b>Established On</b></label>
                <div class="col-md-6">
                    <input type="date" placeholder="Enter Established Dates" name="established_on"
                           class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="dollar_rating" class="col-md-4 col-form-label text-md-right"><b>Dollar Rating</b></label>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dollar_rating" id="dollar_rating1" value="1">
                        <label class="form-check-label" for="dollar_rating1">
                            1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dollar_rating" id="dollar_rating2" value="2">
                        <label class="form-check-label" for="dollar_rating2">
                            2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dollar_rating" id="dollar_rating3" value="3">
                        <label class="form-check-label" for="dollar_rating3">
                            3
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dollar_rating" id="dollar_rating4" value="4">
                        <label class="form-check-label" for="dollar_rating4">
                            4
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="dollar_rating" id="dollar_rating5" value="5">
                        <label class="form-check-label" for="dollar_rating5">
                            5
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
