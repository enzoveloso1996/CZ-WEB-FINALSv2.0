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

    public function clientlogout($user_id){
        DB::table('tb_mf_client_users_log')
        ->insert([
            'user_id'       =>  $user_id,
            'action_id'     =>  4,
            'remarks'       => 'Log Out' 
        ]);
        return redirect('/clientlogin');
    }

    public function clientlogin(Request $request){

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


    public function adminlogout($user_id){
        DB::table('tb_mf_users_log')
        ->insert([
            'user_id'       =>  $user_id,
            'action_id'     =>  4,
            'remarks'       => 'Log Out' 
        ]);
        return redirect('/adminlogin');
    }

    public function adminlogin(Request $request){

        $hashpw = DB::table('tb_mf_users')
        ->where('username', '=', $request->username)
        ->get();
        
        
        if (COUNT($hashpw)>0) {
            foreach ($hashpw as $hashpword) {
                $hashpw = $hashpword->password;
                $user_id = $hashpword->user_id;
            }
            if(Hash::check($request->password, $hashpw)){
                DB::table('tb_mf_users_log')
                ->insert([
                    'user_id'       =>  $user_id,
                    'action_id'     =>  4,
                    'remarks'       => 'Log In' 
                ]);
                return redirect()->route('dashboard.index', ['id' => $user_id]);
            }
            else{
               
                return redirect('adminlogin')->with('status', "Incorrect Password!!");
            }
        }
        else{
            return redirect('adminlogin')->with('status', "Incorrect Username!!");
            
        }

        
    }


    public function register_index($user_id)
    {
        $access_level = DB::table('tb_access_level')->get();
        
        return view("/cms/register/$user_id")->with('access_levels', $access_level);
    }

    public function register(Request $request)
    {
        $password_hash = Hash::make($request->password);

        DB::table('tb_users')
        ->insert([
            'username'          =>  $request->username,
            'password'          =>  $password_hash,
            'firstname'         =>  $request->firstname,  
            'middlename'        =>  $request->middlename,
            'lastname'          =>  $request->lastname,
            'access_level_id'   =>  $request->accesslevel_id
        ]);

        
        return redirect()->route('dashboard.index', ['id' => $user_id]);
    }



}
