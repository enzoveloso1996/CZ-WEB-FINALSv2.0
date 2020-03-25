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
        return view('crm/company/clientlogin');
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

    public function logout($user_id){
        DB::table('tb_mf_client_users_log')
        ->insert([
            'user_id'       =>  $user_id,
            'action_id'     =>  4,
            'remarks'       => 'Log Out' 
        ]);
        return redirect('/clientlogin');
    }

    public function login(Request $request){

        $hashpw = DB::table('tb_mf_client_users')
        ->where('username', '=', $request->username)
        ->get();
        
        
        if (COUNT($hashpw)>0) {
            foreach ($hashpw as $hashpword) {
                $hashpw = $hashpword->password;
                $user_id = $hashpword->user_id;
            }
            if(Hash::check($request->password, $hashpw)){
                DB::table('tb_mf_client_users_log')
                ->insert([
                    'user_id'       =>  $user_id,
                    'action_id'     =>  4,
                    'remarks'       => 'Log In' 
                ]);
                return redirect()->route('clientdashboard.index', ['id' => $user_id]);
            }
            else{
               
                return redirect('clientlogin')->with('status', "Incorrect Password!!");
            }
        }
        else{
            return redirect('clientlogin')->with('status', "Incorrect Username!!");
            
        }

        
    }
}
