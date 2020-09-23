<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://apis.google.com/js/client:platform.js?onload=start" async defer></script>
        <script>
            function start() {
                gapi.load('auth2', function() {
                    auth2 = gapi.auth2.init({
                        client_id: '615012713472-n3n5dlm46tnla94g4tvnboghcr0bq42n.apps.googleusercontent.com',
                        // Scopes to request in addition to 'profile' and 'email'
                        //scope: 'additional_scope'
                    });
                });
            }
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <button id="signinButton">Sign in with Google</button>
                <script>
                    $('#signinButton').click(function() {
                        // signInCallback defined in step 6.
                        auth2.grantOfflineAccess().then(signInCallback);
                    });
                </script>
                <form id="sign-in" method="POST" action="{{ route('google-integrate-auth-token') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="code" id="code" value="" />
                </form>
            </div>

        </div>
        <script>
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



                    {{--$.ajax({--}}
                    {{--    type: 'POST',--}}
                    {{--    url: '{{ route('google-auth-code-exchange') }}',--}}
                    {{--    // Always include an `X-Requested-With` header in every AJAX request,--}}
                    {{--    // to protect against CSRF attacks.--}}
                    {{--    headers: {--}}
                    {{--        'X-Requested-With': 'XMLHttpRequest'--}}
                    {{--    },--}}
                    {{--    // contentType: 'application/octet-stream; charset=utf-8',--}}
                    {{--    data: {--}}
                    {{--        'code': authResult['code']--}}
                    {{--    },--}}
                    {{--    success: function(result) {--}}
                    {{--        // Handle or verify the server response.--}}
                    {{--        console.log(result);--}}

                    {{--        // todo - If a result comes back with a user, Make a Post Request using that User's--}}
                    {{--    },--}}
                    {{--    error: function(error_result) {--}}
                    {{--        console.log(error_result);--}}
                    {{--    },--}}
                    {{--    // processData: false,--}}
                    {{--    // data: authResult['code']--}}
                    {{--});--}}

                } else {
                    // There was an error.
                }
            }
        </script>
    </body>
</html>
