<?php

namespace App\Http\Controllers;

use App\ClientLogin;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class ClientLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientlogin');
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
     * @param  \App\ClientLogin  $clientLogin
     * @return \Illuminate\Http\Response
     */
    public function show(ClientLogin $clientLogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientLogin  $clientLogin
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientLogin $clientLogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientLogin  $clientLogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientLogin $clientLogin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientLogin  $clientLogin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientLogin $clientLogin)
    {
        //
    }

    public function login(Request $request){

        $hashpw = DB::table('tb_mf_client_users')
        ->where('username', '=', $request->username)
        ->get();
        
        foreach ($hashpw as $hashpword) {
            $hashpw = $hashpword->password;
            $user_id = $hashpword->user_id;
        }

        if(Hash::check($request->password, $hashpw)){
            return redirect()->route('clientdashboard.index', ['id' => $user_id]);
        }
        else{
            return redirect('clientlogin');
        }

    }
}
