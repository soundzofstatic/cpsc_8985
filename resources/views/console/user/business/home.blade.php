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
            <div class="col-md-12">
                {{--  todo - Render Data            --}}
            </div>
        </div>

        <div style="text-align:center">');
            <div class='center'>
                <form action="" method="post">
                    <div class="imgcontainer">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRbjTzEm1nYw9RNk1X74rPbEU8OWCAgBgSXXg&usqp=CAU"
                             alt="Avatar" class="avatar">
                    </div>

                    <div class="container">
                        <br><label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required><br/>

                        <br><label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required><br/>

                        <br><label for="psw"><b>Confirm Password</b></label>
                        <input type="Confirmpassword" placeholder="Confirm Password" name="psw" required><br/>

                        <br><label for="email"><b>EmailID</b></label>
                        <input type="text" placeholder="Enter EmailID" name="emailid" required><br/>

                        <br><label for="address"><b>Address</b></label>
                        <input type="text" placeholder="Enter address" name="address" required><br/>

                        <br><label for="contact"><b>ContactNo</b></label>
                        <input type="text" placeholder="Enter contact no" name="contact" required><br/>

                        <br><label for="menu_url"><b>Menu_url</b></label>
                        <input type="text" placeholder="Enter menu_url" name="menu_url" required><br/>


                        <br><label for="socialmedia_url"><b>SocialMedia_url</b></label>
                        <input type="text" placeholder="Enter socialmedia_url" name="socialmedia_url" required><br/>

                        <br><label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required><br/>

                        <br><label for="psw"><b>Confirm Password</b></label>
                        <input type="Confirmpassword" placeholder="Confirm Password" name="psw" required><br/>
                        <br>

                        <label for="EstablishedOn">Established Date:</label>
                        <input type="date" id="Established" name="EstablishedOn">

                        <br><button type="submit">submit</button>
                        <br/>
                    </div>
                </form>

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
