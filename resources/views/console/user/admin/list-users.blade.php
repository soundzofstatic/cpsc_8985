@extends('themes.localsdirectory.layout.base')
@section ('page_name')User Listing
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>User Listing</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Search Users</h2>
                <p>Search for users and act on their accounts.</p>
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
        <div class="row">
            <div class="col-md-12">
                <h2>All Users</h2>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                    @foreach($users as $user)
                        <div class="col-lg-4 col-sm-6">
                            <div class="arrange-items">
                                <div class="fixed-label">
                                    @if($user->isAdmin())
                                        <div class="tic-text admin">Admin</div>
                                    @else
                                        <div class="tic-text reviewer">Reviewer</div>
                                    @endif
                                </div>
                                <div class="arrange-text">
                                    <a href="{{ route('user.home', ['user'=>$user->id]) }}">
                                        <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    </a>
                                    @if(!empty($user->username))
                                        <span>{{ $user->username }}#{{ $user->id }}</span>
                                    @endif
                                    <ul class="meta">
                                        <li><span>Email:</span> {{ $user->email }}</li>
                                        <li><span>Created:</span> {{ $user->created_at->format('m/d/Y g:i:s a') }}</li>
                                    </ul>
                                    @if($user->isAdmin())
                                        <a class="demote action" href="{{ route('console.update.user.demote-user', ['user'=>$user->id]) }}">Demote</a>
                                    @else
                                        <a class="promote action"  href="{{ route('console.update.user.promote-user', ['user'=>$user->id]) }}">Promote</a>
                                    @endif
                                    @if($user->is_active)
                                        <a href="{{ route('console.user.admin.update.disable-user', ['user'=> $user->id]) }}"
                                           class="btn btn-sm btn-danger">Disable User</a>
                                    @else
                                        <a href="{{route('console.user.admin.update.enable-user', ['user'=> $user->id]) }}"
                                           class="btn btn-sm btn-success">Enable User</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                            markup += '<div class="fixed-label">';
                            if (element.attributes.is_admin) {
                                markup += '<div class="tic-text admin">Admin</div>';
                            } else {
                                markup += '<div class="tic-text reviewer">Reviewer</div>';
                            }

                            markup += '</div>';
                            markup += '<div class="arrange-text">';
                            markup += '<a href="/user/' + element.id + '">';
                            markup += '<h5>' + element.attributes.first_name + ' ' + element.attributes.last_name + '</h5>';
                            markup += '</a>';
                            if (element.attributes.username != null) {
                                markup += '<span>' + element.attributes.username + '#' + element.id +'</span>';
                            }
                            markup += '<ul class="meta">';
                            markup += '<li><span>Email:</span> ' + element.attributes.email + '</li>';
                            markup += '</ul>';



                            // todo - Connect click functionality
                            if (element.attributes.is_admin) {
                                markup += '<button class="demote action mr-1" data-action="demote" data-user="' + element.id + '">Demote</button>';
                            } else {
                                markup += '<button class="promote action mr-1" data-action="promote" data-user="' + element.id + '">Promote</button>';
                            }
                            if (element.attributes.is_active) {
                                markup += '<a href="/console/user/' + element.id + '/admin/update/disable-user" class="btn btn-sm btn-danger">Disable User</a>';
                            } else {
                                markup += '<a href="/console/user/' + element.id + '/admin/update/enable-user" class="btn btn-sm btn-success">Enable User</a>';
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
