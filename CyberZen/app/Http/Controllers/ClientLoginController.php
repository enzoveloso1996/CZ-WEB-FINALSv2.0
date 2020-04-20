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
    public function adminindex()
    {
        return view('cms/login');
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
        session_start();
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
        
        DB::table('tb_users_log')
        ->insert([
            'user_id'       =>  $user_id,
            'action_id'     =>  5,
            'remarks'       => 'Log Out' 
        ]);
      
        return redirect('/adminlogin');
    }

    public function adminlogin(Request $request){
        session_start();
        $hashpw = DB::table('tb_users')
        ->where('username', '=', $request->username)
        ->get();
        
        
        if (COUNT($hashpw)>0) {
            foreach ($hashpw as $hashpword) {
                $hashpw = $hashpword->password;
                $user_id = $hashpword->user_id;
                $access_level = $hashpword->access_level_id;
            }
            if(Hash::check($request->password, $hashpw)){
                DB::table('tb_users_log')
                ->insert([
                    'user_id'       =>  $user_id,
                    'action_id'     =>  4,
                    'remarks'       => 'Log In' 
                ]);
                if($access_level == 1){
                    return redirect()->route('dashboard.index', ['user_id' => $user_id, 'access_level' => $access_level]);
                }
                return redirect()->route('cardlist.index', ['user_id' => $user_id, 'access_level' => $access_level]);

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
    {   $access_level = DB::table('tb_access_level')->get();
        $userlist = DB::table('tb_users')
        ->join('tb_access_level', 'tb_access_level.id', '=', 'tb_users.access_level_id')
        ->paginate(10);

        return view("/cms/admin/adduser")->with('access_levels', $access_level)->with('user_id', $user_id)
                        ->with('userslists', $userlist);
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
            'access_level_id'   =>  $request->access_level_text
        ]);

        
        return redirect()->route('admin-register-index', ['id' => $request->user_id]);
    }



}
