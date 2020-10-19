@extends('themes.localsdirectory.layout.base')
@section ('page_name')Admin Console
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Admin Console</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Users</h2>
                <p>See the last 5 users created</p>
            </div>
            <div class="col-md-12">
                @foreach($users as $user)
                    <div class="row mb-2" style="border: thin solid red">
                        <div class="col-md-12">
                            <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                            <p>{{ $user->email }}</p>
                            @if(!empty($user->username))
                                <p>{{ $user->username }}#{{ $user->id }}</p>
                            @endif
                            <p>{{ $user->created_at->format('m/d/Y g:i:s a') }}</p>
                            {{--                            @if($user->is_active)--}}
                            <a href="{{ route('console.user.admin.update.disable-user', ['user'=> $user->id]) }}"
                               class="btn btn-sm btn-danger">Disable User</a>
                            {{--                            @else--}}
                            <a href="{{route('console.user.admin.update.enable-user', ['user'=> $user->id]) }}"
                               class="btn btn-sm btn-success">Enable User</a>
                            {{--                            @endif--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Search and Promote</h2>
                <p>Search for users and promote them administrative level accounts.</p>
            </div>
            <div class="col-md-12">
                <div class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="query" class="sr-only">Query</label>
                            <input id="query" type="text" placeholder="Search for User by username, name, or email"
                                   name="query" value="{{ old('query') }}">
                        </div>
                        <div class="col-lg-12 text-center">
                            <button id="search" type="button">Search</button>
                            <button id="reset" type="button" class="reset">Reset</button>
                        </div>
                    </div>
                </div>
                <div id="search-results" class="col-lg-12">
                    <div class="row">
                    </div>
                </div>
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
