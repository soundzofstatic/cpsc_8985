@extends('themes.localsdirectory.layout.base')
@section ('page_name')Login
@endsection
@section ('content')

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('login') }}" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Your E-mail" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="password" placeholder="Password" name="password">
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 text-center">
                    <button id="signinButton" type="button">
                        <span class="icon">
                            <img src=" {{ asset('img/google_sign_in/vector/btn_google_light_normal_ios.svg') }}">
                        </span>
                        <span class="buttonText">Continue with Google</span>
                    </button>
                    <form id="sign-in" method="POST" action="{{ route('google-integrate-auth-token') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="code" id="code" value=""/>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
@section('scripts')
    <script src="https://apis.google.com/js/client:platform.js?onload=start" async defer></script>
    <script>

        $(document).ready(function () {

            $('#signinButton').click(function () {
                // signInCallback defined in step 6.
                auth2.grantOfflineAccess().then(signInCallback);
            });

        });

        function start() {
            gapi.load('auth2', function () {
                auth2 = gapi.auth2.init({
                    client_id: '615012713472-n3n5dlm46tnla94g4tvnboghcr0bq42n.apps.googleusercontent.com',
                    // Scopes to request in addition to 'profile' and 'email'
                    //scope: 'additional_scope'
                });
            });
        }

        function signInCallback(authResult) {

            console.log(authResult); // eg. {code: "4/4QHAUbi7m98Q4Lybm_niMXlb0bJM9KPdF20lGFjbvihVg74hS1obhwB8rsDSXZySYVksbP3YQqT3XXMsEoZYsSE"}

            if (authResult['code']) {

                // Hide the sign-in button now that the user is authorized, for example:
                $('#signinButton').attr('style', 'display: none');

                // Send the code to the server
                // Note - The AJAX Post works, but then it complicates the process because we lose the state
                // todo -  Instead, we should GET the CODE to a subsequent page

                // window.location.href = '/google/integrate/' + encodeURIComponent(authResult['code']);

                $('input#code').val(authResult['code']);
                $('form#sign-in').submit();

            } else {
                // There was an error.
            }
        }
    </script>
@endsection

