<?php

namespace App\Http\Controllers;

use App\ClientUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class ClientUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('tb_mf_client_users')
        ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
        ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
        ->where("tb_mf_client.is_archived", "=", "0")
        ->get();

        $clientname = DB::table('tb_mf_client')
        ->where("is_archived","=","0")
        ->get();

        $position = DB::table('tb_mf_position')
        ->wherein('id',[3,4])
        ->get();

        $fullname = DB::table('tb_mf_jeep_personnel')
        ->get();

        return view('cms/admin/clientusers')
            ->with('userslist', $users)
            ->with('clientname', $clientname)
            ->with('fullname', $fullname)
            ->with('position', $position);
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
        
        $pass = Hash::make($request->password);
            
        DB::table('tb_mf_client_users')
        ->insert([
            'client_id'         =>  $request->client_idtext,
            'firstname'         =>  $request->firstname,
            'middlename'        =>  $request->middlename,
            'lastname'          =>  $request->lastname,
            'fullname'          =>  $request->firstname.' '.$request->middlename.' '.$request->lastname,
            'position_id'       =>  $request->position_idtext,
            'username'          =>  $request->username,
            'password'          =>  $pass

        ]);

        DB::table('tb_mf_jeep_personnel')
        ->insert([
            'client_id'         =>  $request->client_idtext,
            'firstname'         =>  $request->firstname,
            'middlename'        =>  $request->middlename,
            'lastname'          =>  $request->lastname,
            'fullname'          =>  $request->firstname.' '.$request->middlename.' '.$request->lastname,
            'position_id'       =>  $request->position_idtext,
            'is_archived'       =>  "0"
        ]);

        return redirect('cms/admin/clientusers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientUsers  $clientUsers
     * @return \Illuminate\Http\Response
     */
    public function show(ClientUsers $clientUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientUsers  $clientUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientUsers $clientUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientUsers  $clientUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientUsers $clientUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientUsers  $clientUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientUsers $clientUsers)
    {
        //
    }
}
