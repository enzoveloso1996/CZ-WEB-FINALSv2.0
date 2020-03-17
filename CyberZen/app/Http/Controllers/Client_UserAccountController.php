<?php

namespace App\Http\Controllers;

use App\Client_UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class Client_UserAccountController extends Controller
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
        ->get()->toarray();

        $client_id = array_column($accounts, 'client_id');
        
        $user_position_ids = DB::table('tb_mf_client_users')
        ->select('position_id')
        ->where('user_id', '=', $id)
        ->get();

        foreach ($user_position_ids as $user_position_id) {
            $user_position_id = $user_position_id->position_id;
        }

        if ( $user_position_id == 3) {
            $users = DB::table('tb_mf_client_users')
            ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
            ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
            ->where("tb_mf_client.is_archived", "=", "0")
            ->where("tb_mf_client_users.client_id", "=",$client_id)
            ->wherein("tb_mf_client_users.position_id", [3,4])
            ->get();            
        } else {
            $users = DB::table('tb_mf_client_users')
            ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
            ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
            ->where("tb_mf_client.is_archived", "=", "0")
            ->where("tb_mf_client_users.user_id", '=', $id)
            ->where("tb_mf_client_users.client_id", "=",$client_id)
            ->get();
            }

        $clientname = DB::table('tb_mf_client')
        ->where("is_archived","=","0")
        ->where("client_id", "=",$client_id)
        ->get();

        $position = DB::table('tb_mf_position')
        ->wherein('id',[1,2,4])
        ->get();

        $fullname = DB::table('tb_mf_jeep_personnel')
        ->where("client_id", "=",$client_id)
        ->get();

        
            
        return view('crm/company/client_useraccount')->with('user_id', $id)
            ->with('userslist', $users)
            ->with('clientname', $clientname)
            ->with('fullname', $fullname)
            ->with('position', $position);
    }

    public function combosearch(Request $request)
    {

        

        if($request->ajax())
        {
            $accounts = DB::table('tb_mf_client')
            ->join('tb_mf_client_users', 'tb_mf_client_users.client_id', '=', 'tb_mf_client.client_id')
            ->where('tb_mf_client_users.user_id', '=', $request->user_id)
            ->get()->toarray();

            $client_id = array_column($accounts, 'client_id');

            $user_position_ids = DB::table('tb_mf_client_users')
            ->select('position_id')
            ->where('user_id', '=', $request->user_id)
            ->get();
    
            foreach ($user_position_ids as $user_position_id) {
                $user_position_id = $user_position_id->position_id;
            }
    
            if ( $user_position_id == 3) {
                $users = DB::table('tb_mf_client_users')
                ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
                ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
                ->where("tb_mf_client.is_archived", "=", "0")
                ->where("tb_mf_client_users.client_id", "=",$client_id)
                ->wherein("tb_mf_client_users.position_id", [3,4])
                ->get();            
            } else {
                $users = DB::table('tb_mf_client_users')
                ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
                ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
                ->where("tb_mf_client.is_archived", "=", "0")
                ->where("tb_mf_client_users.user_id", '=', $id)
                ->where("tb_mf_client_users.client_id", "=",$client_id)
                ->get();
                }
            
            // if($personnellists)
            // {
                foreach ($personnellists as $key => $personnellist) {
                    $output.='<tr>'.
                    '<td class="center" id="ref"></td>'.
                    '<td class="center">'.$personnellist->fullname.'</td>'.
                    '<td class="center">'.$personnellist->client_name.'</td>'.
                    '<td class="center">'.$personnellist->position.'</td>'.
                    '<td class="center">'.$personnellist->username.'</td>'.
                    '</tr>';
                } 
                return Response($output);
            // }
                
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

        return redirect("company/crm/company/clientuseraccount/$request->client_idtext");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client_UserAccount  $client_UserAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Client_UserAccount $client_UserAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client_UserAccount  $client_UserAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Client_UserAccount $client_UserAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client_UserAccount  $client_UserAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client_UserAccount  $client_UserAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client_UserAccount $client_UserAccount)
    {
        //
    }
}
