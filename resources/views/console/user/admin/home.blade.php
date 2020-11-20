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
                <p>See the last 5 users created. See <a href="{{ route('console.admin.list-all-users') }}" class="btn btn-sm btn-primary">all users</a></p>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                    @foreach($users as $user)
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items"
                               href="{{ route('user.home', ['user'=>$user->id]) }}">
                                <div class="arrange-text p-3" style="border: thin solid red">
                                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <span>{{ $user->email }}</span>
                                    <br/>
                                    <span>{{ $user->created_at->format('m/d/Y g:i:s a') }}</span>
                                    <br/>
                                    @if(!empty($user->username))
                                        <span>{{ $user->username }}#{{ $user->id }}</span>
                                    @endif
                                    @if($user->is_active)
                                        <a href="{{ route('console.user.admin.update.disable-user', ['user'=> $user->id]) }}"
                                           class="btn btn-sm btn-danger">Disable User</a>
                                    @else
                                        <a href="{{route('console.user.admin.update.enable-user', ['user'=> $user->id]) }}"
                                           class="btn btn-sm btn-success">Enable User</a>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
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
                            <input id="query" type="text" placeholder="Search for User by username, name, or email" name="query" value="{{ old('query') }}">
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
                <h2>Businesses</h2>
                <p>See the last 5 businesses created. See <a href="{{ route('console.admin.list-all-businesses') }}" class="btn btn-sm btn-primary">all businesses</a></p>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                    @foreach($businesses as $business)
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items"
                               href="{{ route('business.home', ['business'=>$business->id]) }}">
                                <div class="arrange-text p-3" style="border: thin solid red">
                                    <h5>{{ $business->name }}</h5>
{{--                                    <span>{{ $user->email }}</span>--}}
{{--                                    <br/>--}}
                                    <span>{{ $business->created_at->format('m/d/Y g:i:s a') }}</span>
                                    <br/>
                                    @if($business->is_active)
                                        <a href="{{ route('console.user.admin.update.business.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                           class="btn btn-sm btn-danger">Suspend Business</a>
                                    @else
                                        <a href="{{ route('console.user.admin.update.business.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                           class="btn btn-sm btn-success">Enable Business</a>
                                    @endif
                                    <a href="{{ route('console.user.businesses.business.update.promoted_business.create', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'business' => $business->id]) }}"
                                       class="btn btn-sm btn-warning">Create Promotion</a>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Search Businesses</h2>
                <p>Search for all businesses</p>
            </div>
            <div class="col-md-12">
                <div class="contact-form">
                    <form method="POST" action="{{ route('console.user.admin.update.listAllBusinesses', ['user'=> \Illuminate\Support\Facades\Auth::user()->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="query" class="sr-only">Query</label>
                                <input id="query" type="text" placeholder="Search for Businesses by name, email, phone, or url"
                                       name="query" value="{{ old('query') }}">
                            </div>
                            <div class="col-lg-12 text-center">
                                <button id="search" type="submit">Search</button>
                                <button id="reset" type="button" class="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Promoted Businesses</h2>
                <p>See the last 5 promoted businesses. See <a href="{{ route('console.admin.list-all-promoted-businesses') }}" class="btn btn-sm btn-primary">all promoted businesses</a></p>
            </div>
            <div class="col-md-12">
                <div class="row mb-2">
                    @foreach($promotedBusinesses as $promotedBusiness)
                        <div class="col-lg-4 col-sm-6">
                            <a class="arrange-items"
                               href="{{ route('business.home', ['business'=>$promotedBusiness->business->id]) }}">
                                <div class="arrange-text p-3" style="border: thin solid red">
                                    <h5>{{ $promotedBusiness->business->name }}</h5>
                                    {{--                                    <span>{{ $user->email }}</span>--}}
                                    {{--                                    <br/>--}}
                                    <h6>Promotion period</h6>
                                    <span>{{ $promotedBusiness->start_date->format('m/d/Y g:i:s a') }} - {{ $promotedBusiness->end_date->format('m/d/Y g:i:s a') }}</span>
                                    <br/>
                                    <span>{{ $promotedBusiness->promo_location }}</span>
                                    <br/>
                                    @if($promotedBusiness->is_active)
                                        <a href="{{ route('console.user.admin.update.promoted_business.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'promoted_business' => $promotedBusiness->id]) }}"
                                           class="btn btn-sm btn-danger">Suspend Promotion</a>
                                    @else
                                        <a href="{{ route('console.user.admin.update.promoted_business.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'promoted_business' => $promotedBusiness->id]) }}"
                                           class="btn btn-sm btn-success">Activate Promotion</a>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Reviews</h2>
                <p>Last 5 Reviews submitted for all businesses</p>
            </div>
            <div class="col-md-12">
                @foreach($reviews as $review)
                    <div class="review-item pb-3">
                        <div class="rating">
                            @for($i=0;$i<$review->rating;$i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for($i=0;$i< (5 - $review->rating);$i++)
                                <i class="fa fa-star-o"></i>
                            @endfor
                        </div>
                        <h5>Review Title</h5>
                        <p>{{ $review->originalFeedback->text }}</p>
                        <div class="client-text">
                            <h5><a href="{{ route('user.home', ['user' => $review->user_id]) }}" class="author-link">{{ $review->user->first_name }} {{ $review->user->last_name }}</a></h5>
                            <span>{{ $review->created_at->format('F j, Y, g:i a') }}</span>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                @foreach($review->relatedFeedbacks as $relatedFeedback)
                                    <div class="col-md-11 offset-md-1 mb-5 related-feedback" style="border-left: solid thin red;">
                                        <p>{{ $relatedFeedback->text }}</p>
                                        <div class="client-text">
                                            <h5><a href="{{ route('user.home', ['user' => $relatedFeedback->user_id]) }}" class="author-link">{{ $relatedFeedback->user->first_name }} {{ $relatedFeedback->user->last_name }}</a></h5>
                                            <span>{{ $relatedFeedback->created_at->format('F j, Y, g:i a') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="disable-enable">
                            @if($review->is_active)
                                <a href="{{ route('console.user.admin.update.review.disable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'review' => $review->id]) }}"
                                   class="btn btn-sm btn-danger">Disable entire Review</a>
                            @else
                                <a href="{{ route('console.user.admin.update.review.enable', ['user'=> \Illuminate\Support\Facades\Auth::user()->id, 'review' => $review->id]) }}"
                                   class="btn btn-sm btn-success">Enable entire Review</a>
                            @endif
                        </div>
                    </div>
                @endforeach
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
                            markup += '<a href="/user/' + element.id + '">';
                            markup += '<h5>' + element.attributes.first_name + ' ' + element.attributes.last_name + '</h5>';
                            markup += '</a>';
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
