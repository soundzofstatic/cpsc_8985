<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserApiController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Method used to Query the users table
     *
     * @param Request $request
     * @return ErrorResource|UsersResource
     */
    public function query(Request $request)
    {
        try{

            if(empty($request->input('query'))) {

                throw new \Exception('Query cannot be left blank');

            }

            $users = User::where('username', 'LIKE', '%' . $request->input('query') . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->input('query') . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->input('query') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->input('query') . '%')
                ->get();

            UsersResource::withoutWrapping();
            return new UsersResource($users);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            ErrorResource::withoutWrapping();
            return new ErrorResource($e);

        }

    }
}
