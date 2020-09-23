<?php

namespace App\Http\Controllers;

use App\GoogleToken;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoogleToken  $googleToken
     * @return \Illuminate\Http\Response
     */
    public function show(GoogleToken $googleToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoogleToken  $googleToken
     * @return \Illuminate\Http\Response
     */
    public function edit(GoogleToken $googleToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoogleToken  $googleToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoogleToken $googleToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoogleToken  $googleToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoogleToken $googleToken)
    {
        //
    }

    public function exchangeAuthCode(Request $request)
    {

        if(!empty($request->input('code'))) {

            try {

                $client = new \GuzzleHttp\Client([
                    'base_uri' => "https://oauth2.googleapis.com"
                ]);

                // POST data
                $response = $client->request('POST', '/token', [
                    'form_params' => [
                        'grant_type' => 'authorization_code',
                        'client_id' => env('GOOGLE_SIGN_IN_CLIENT_ID'),
                        'client_secret' => env('GOOGLE_SIGN_IN_CLIENT_SECRET'),
                        'code' => $request->input('code'),
                        'redirect_uri' => 'http://localhost:8090'
                    ]
                ]);

                if ($response->getStatusCode('content-type') == 200) {

                    $credentials = json_decode($response->getBody()->getContents());

                    // Create a New User with the details of id_token (from a JWT)
                    list($header, $payload, $signature) = explode (".", $credentials->id_token);
                    $googleBasicUserData = json_decode(base64_decode($payload));

                    // try to find the user matching the $googleBasicUserData->email
                    $user = User::where('email', '=', $googleBasicUserData->email)
                        ->first();

                    if(empty($user)) {

                        $user = new User();
                        $user->first_name = $googleBasicUserData->given_name;
                        $user->last_name = $googleBasicUserData->family_name;
                        $user->email = $googleBasicUserData->email;
                        $user->username = null;
                        $user->password = 'google_sign_in';
                        $user->save();

                    }

                    $googleToken = GoogleToken::where('user_id', '=', $user->id)
                        ->first();

                    if(empty($googleToken)) {
                        $googleToken = new GoogleToken();
                        $googleToken->access_token = $credentials->access_token;
                        $googleToken->expires_in = Carbon::now()->addSeconds($credentials->expires_in - 360); // Less 5 minutes
                        $googleToken->refresh_token = $credentials->refresh_token;
                        $googleToken->scope = json_encode($credentials->scope);
                        $googleToken->token_type = $credentials->token_type;
                        $googleToken->user_id = $user->id;
//                        $googleToken->id_token = $credentials;
                        $googleToken->save();

                    } else { // Update

                        $googleToken->access_token = $credentials->access_token;
                        $googleToken->expires_in = Carbon::now()->addSeconds($credentials->expires_in - 360); // Less 5 minutes
                        $googleToken->refresh_token = $credentials->refresh_token;
                        $googleToken->scope = json_encode($credentials->scope);
                        $googleToken->token_type = $credentials->token_type;
//                        $googleToken->id_token = $credentials;
                        $googleToken->save();

                    }

                    // todo - Login the User and redirect

                    return $user;

                }

            } catch (ClientException $e) {

                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();

                // todo - log error
                echo $responseBodyAsString . PHP_EOL;
                abort('500');

            } catch (\Exception $e) {

                // todo - log error
                echo $e->getMessage() . PHP_EOL;
                abort('500');

            }

        } else {

            abort('500');

        }

    }



}
