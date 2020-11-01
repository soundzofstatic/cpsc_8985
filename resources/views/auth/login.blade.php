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
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        @if(!empty($name))
            <input id="name" type="text" class="form-control" name="name" value="{{$name}}" required autofocus>
        @else
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        @endif
        @if ($errors->has('name'))
            <span class="help-block">
                                       <strong>{{ $errors->first('name') }}</strong>
                                   </span>
        @endif
    </div>
</div>

    <div class="col-md-6">

        <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>

        <a href="{{ url('login/twitter') }}" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>

        <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>

        <a href="{{ url('login/linkedin') }}" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>

        <a href="{{ url('login/github') }}" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>

        <a href="{{ url('login/bitbucket') }}" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-bitbucket"></i></a>

    </div>

</div>
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

