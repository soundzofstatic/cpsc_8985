@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Console
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <img class="img-fluid"
                     src=" https://d1m7xnn75ypr6t.cloudfront.net/images/media/B4120862-C94A-4650-A773D275932FBF58/?w=1920&h=734"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $business->name }}</h2>
                <div class="d-flex align-items-center">
                    <img width='100'
                         src="https://www.clipartkey.com/mpngs/m/238-2381488_transparent-background-5-star-rating-png.png"/>
                    <p style="color: red" class="mb-0"><strong>3.5 REVIEW</strong></p>
                </div>
            </div>

        </div>


        <div class="row ">
            <div class="col-md-8">
                <div class="card" style="width: 600px; margin-top: 25px">
                    <div class="card-body">
                        <h4 class="card-title">COVID-19 Updates</h4>
                        <h5 class="card-title">Updated Services</h5>
                        <i style="margin-top: 10px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black; font-size: 15px">Dine in</a>
                        <i style="margin-top: 10px;margin-left: 20px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black; font-size: 15px">Delivery</a>
                        <i style="margin-top: 10px;margin-left: 20px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black; font-size: 15px">Take out</a>
                        <i style="margin-top: 10px;margin-left: 20px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black;  font-size: 15px">Pick up</a>

                        <h5 style="margin-top: 15px"
                            class="card-title"> Health Measures</h5>
                        <i style="margin-top: 10px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black; font-size: 15px">Mask Required</a>
                        <i style="margin-top: 10px; margin-left: 20px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black; font-size: 15px">Sanitizer provided</a>
                        <i style="margin-top: 10px; margin-left: 20px" class="fa fa-check fa-lg" aria-hidden="true"></i>
                        <a style="color: black; font-size: 15px">Social distancing</a>

                    </div>
                </div>
                <div style="display: inline-flex;margin-top: 30px">
                    <div class="card" style="width: 10rem; height: 40px">
                        <img class="card-img-top" src="data:image/jpeg;base64,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" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Dosa</h5>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem; margin-left: 56px;height: 40px">
                        <img class="card-img-top" src="data:image/jpeg;base64,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">
                        <div class="card-body">
                            <h5 class="card-title">Idly</h5>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem; margin-left: 56px;height: 40px">
                        <img class="card-img-top" src="https://image.shutterstock.com/image-photo/medu-wada-chutney-sambar-southindian-260nw-1452112697.jpg">
                        <div class="card-body">
                            <h5 class="card-title">Wada</h5>
                        </div>
                    </div>
                </div>

                <div style="display: inline-flex;margin-top: 60px">
                    <div class="card" style="width: 10rem; height: 40px">
                        <img class="card-img-top" src="https://static.toiimg.com/thumb/msid-53315974,width-1070,height-580,resizemode-75/53315974,pt-32,y_pad-40/53315974.jpg">
                        <div class="card-body">
                            <h5 class="card-title">Uttapam</h5>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem; margin-left: 56px;height: 40px">
                        <img class="card-img-top" src="https://www.awesomecuisine.com/wp-content/uploads/2015/08/mangalore-bonda.jpg">
                        <div class="card-body">
                            <h5 class="card-title">Mysore Bonda</h5>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem; margin-left: 56px;height: 40px">
                        <img class="card-img-top" src="https://www.awesomecuisine.com/wp-content/uploads/2015/03/rava-upma.jpg">
                        <div class="card-body">
                            <h5 class="card-title">Upma</h5>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-4">

                <div class="card" style="width:300px;">
                    <div class="card-body">
                        <h5 class="card-title">DELIVERY</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Delivery Address" id="usr">
                        </div>
                        <a style="width: 100%" href="#" class="btn btn-primary">Start Order</a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title">ORDER</h5>
                        <p class="card-text">The pick up and delivery time is 40-50min and delivery fee is $3</p>
                    </div>
                </div>

                <div class="card" style="width: 300px;margin-top: 20px">
                    <div class="card-body">
                        <h5 class="card-title">Details</h5>
                        <div style="display: inline-flex">
                            <i style="margin-top: 10px" class="fa fa-phone fa-lg" aria-hidden="true"></i>
                            <p style="margin-left: 20px; font-size: 15px"> 123-345-679</p>
                        </div>

                        <hr style="border: 1px solid black">
                        <div style="display: inline-flex">
                            <i style="margin-top: 10px" class="fa fa-cutlery fa-lg" aria-hidden="true"></i>
                            <a style="color: black; margin-left: 20px; font-size: 15px" href="">Menu</a>
                        </div>
                        <hr style="border: 1px solid black">
                        <div style="display: inline-flex">
                            <i style="margin-top: 10px" class="fa fa-location-arrow fa-lg" aria-hidden="true"></i>
                            <a style="color: black; margin-left: 20px; font-size: 15px" href="">Location</a>
                        </div>
                        <hr style="border: 1px solid black">
                        <div style="display: inline-flex">
                            <i style="margin-top: 10px" class="fa fa-external-link fa-lg" aria-hidden="true"></i>
                            <p style="margin-left: 20px; font-size: 15px"> www.LANDOFSHARK.com</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div style="text-align:center">');
            <div class='center'>
                <form action="{{route('business-store')}}" method="post">
                    <div class="imgcontainer">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRbjTzEm1nYw9RNk1X74rPbEU8OWCAgBgSXXg&usqp=CAU"
                             alt="Avatar" class="avatar">
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
        </div>
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
