<?php

namespace App\Http\Controllers;

use App\ClientPersonnel;
use Illuminate\Http\Request;
use DB;

class ClientPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $accounts = DB::table('tb_mf_client')
        ->join('tb_mf_client_users', 'tb_mf_client_users.client_id', '=', 'tb_mf_client.client_id')
        ->where('tb_mf_client_users.user_id', '=', $id)
        ->get();
        foreach ($accounts as $account) {
            $client_id = $account->client_id;
            $client_name = $account->client_name;
        }

        $clientname = DB::table('tb_mf_client')
        ->where("is_archived","=","0")
        ->where("client_id", "=",$client_id)
        ->get();

        $personnels = DB::table('tb_mf_jeep_personnel')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep_personnel.client_id')
        ->join('tb_mf_position', 'tb_mf_position.id', '=', 'tb_mf_jeep_personnel.position_id')
        ->where("tb_mf_jeep_personnel.client_id", "=",$client_id)
        ->get();

        $position = DB::table('tb_mf_position')
        ->get();      
            
        return view('crm/company/client_personnel')->with('user_id', $id)->with('client_name', $client_name)
            ->with('position', $position)    
            ->with('clientname', $clientname)    
            ->with('personnels', $personnels);
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
     * @param  \App\ClientPersonnel  $clientPersonnel
     * @return \Illuminate\Http\Response
     */
    public function show(ClientPersonnel $clientPersonnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientPersonnel  $clientPersonnel
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientPersonnel $clientPersonnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientPersonnel  $clientPersonnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientPersonnel $clientPersonnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientPersonnel  $clientPersonnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientPersonnel $clientPersonnel)
    {
        //
    }
}
