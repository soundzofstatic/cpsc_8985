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
                <h2>Search and Promote</h2>
                <p>Search for users and promote them administrative level accounts.</p>
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
        $(document).ready(function(){
            $('#search').click(function(){

                $.ajax({
                    url: "{{ route('user-query') }}",
                    method: 'POST',
                    data: {
                        query: $('input#query').val()
                    },
                    success: function(json_response) {
                        var markup = '';

                        json_response.data.forEach(function(element, index) {

                            markup += '<div class="col-lg-4 col-sm-6">';
                            markup += '<a class="arrange-items" href="single-listing.html">';
                            markup += '<div class="arrange-pic">';
                            if(element.attributes.is_admin) {
                                markup += '<div class="tic-text">Admin</div>';
                            } else {
                                markup += '<div class="tic-text">Reviewer</div>';
                            }

                            markup += '</div>';
                            markup += '<div class="arrange-text">';
                            markup += '<h5>' + element.attributes.first_name + ' ' + element.attributes.last_name + '</h5>';
                            markup += '<span>' + element.attributes.username + '</span>';
                            markup += '<p>' + element.attributes.email + '</p>';

                            // todo - Connect click functionality
                            if(element.attributes.is_admin) {
                                markup += '<div class="closed">Demote</div>';
                            } else {
                                markup += '<div class="open">Promote</div>';
                            }

                            markup += '</div>';
                            markup += '</a>';
                            markup += '</div>';

                        });

                        $('#search-results .row').html(markup);

                    },
                    error: function(error_response) {

                        // todo

                    }
                })

            });
        });
    </script>
@endsection
