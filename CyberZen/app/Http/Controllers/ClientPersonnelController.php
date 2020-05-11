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
        ->select(
           'tb_mf_jeep_personnel.id','tb_mf_jeep_personnel.firstname','tb_mf_jeep_personnel.middlename','tb_mf_jeep_personnel.lastname',
           'tb_mf_jeep_personnel.position_id','tb_mf_jeep_personnel.client_id','tb_mf_jeep_personnel.rfid_number','tb_mf_jeep_personnel.fullname',
           'tb_mf_jeep_personnel.user_id','tb_mf_position.position','tb_mf_client.client_name'
        )
        ->where("tb_mf_jeep_personnel.client_id", "=",$client_id)
        ->orderby('tb_mf_jeep_personnel.id', 'ASC')
        ->paginate(10);

        $position = DB::table('tb_mf_position')
        ->get();      
    
        if(session('login_status') == 'logged_in'){
            return view('crm/company/client_personnel')->with('user_id', $id)->with('client_name', $client_name)
            ->with('position', $position)    
            ->with('clientname', $clientname)    
            ->with('personnels', $personnels);
        }else{
            return redirect('clientlogin');
        }


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
        DB::table('tb_mf_jeep_personnel')
        ->insert([
            'rfid_number'       =>  $request->rfid_number,
            'firstname'         =>  $request->firstname,
            'middlename'        =>  $request->middlename,
            'lastname'          =>  $request->lastname,
            'fullname'          =>  $request->firstname.' '.$request->middlename.' '.$request->lastname,
            'position_id'       =>  $request->position_idtext,
            'client_id'         =>  $request->client_idtext,
            'is_archived'       =>  0
        ]);

        if(session('login_status') == 'logged_in'){
            return redirect("company/crm/company/clientpersonnel/$request->addcurrent_user_id");
        }else{
            return redirect('clientlogin');
        }

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
    public function update(Request $request, $user_id)
    {
        DB::table('tb_mf_jeep_personnel')
        ->where('id', '=', $request->editpersonnel_id)
        ->update([
            'rfid_number'       =>  $request->editrfid_number,
            'firstname'         =>  $request->editfirstname,
            'middlename'        =>  $request->editmiddlename,
            'lastname'          =>  $request->editlastname,
            'fullname'          =>  $request->editfirstname.' '.$request->editmiddlename.' '.$request->editlastname,
            'position_id'       =>  $request->editposition_idtext,
            'client_id'         =>  $request->editclient_idtext,
            
        ]);

        if(session('login_status') == 'logged_in'){
            return redirect("company/crm/company/clientpersonnel/$request->editcurrent_user_id");
        }else{
            return redirect('clientlogin');
        }

    }

    public function archive(Request $request){
        DB::table('tb_mf_client_users')
        ->where('user_id', $request->deluser_id)
        ->update(['is_archived' => 1]);

        DB::table('tb_mf_jeep_personnel')
        ->where('id', $request->delpersonnel_id)
        ->update(['is_archived' => 1]);

        DB::table('tb_mf_client_users_log')
        ->insert([
            'user_id'       =>  $request->delcurrent_user_id,
            'action_id'     =>  3,
            'remarks'       => 'Archived User with user_id "'.$request->deluser_id.' " by '.$request->delcurrent_user_id
        ]);

        if(session('login_status') == 'logged_in'){
            return redirect("company/crm/company/clientpersonnel/$request->delcurrent_user_id");
        }else{
            return redirect('clientlogin');
        }

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
