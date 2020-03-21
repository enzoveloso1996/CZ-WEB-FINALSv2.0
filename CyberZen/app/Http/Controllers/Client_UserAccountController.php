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
        if ($user_position_id == 3){
            $position = [3,4];
        }
        else{
            $position = [$user_position_id];
        }

        if ( $user_position_id == 3) {
            $users = DB::table('tb_mf_client_users')
            ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
            ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
            ->where("tb_mf_client.is_archived", "=", "0")
            ->where("tb_mf_client_users.is_archived", "=", "0")
            ->where("tb_mf_client_users.client_id", "=",$client_id)
            ->wherein("tb_mf_client_users.position_id", $position)
            ->get();            
        } else {
            $users = DB::table('tb_mf_client_users')
            ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
            ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
            ->where("tb_mf_client.is_archived", "=", "0")
            ->where("tb_mf_client_users.is_archived", "=", "0")
            ->where("tb_mf_client_users.user_id", '=', $id)
            ->where("tb_mf_client_users.client_id", "=",$client_id)
            ->get();
            } 

        $clientname = DB::table('tb_mf_client')
        ->where("is_archived","=","0")
        ->where("client_id", "=",$client_id)
        ->get();

        $position = DB::table('tb_mf_position')
        ->wherein('id',$position)
        ->get();      
            
        return view('crm/company/client_useraccount')->with('user_id', $id)
            ->with('userslist', $users)
            ->with('clientname', $clientname)
            ->with('position', $position);
    }

    public function combosearch(Request $request)
    {

        
        $output = "";

        if($request->ajax())
        {
            $accounts = DB::table('tb_mf_client_users')
            ->join('tb_mf_client', 'tb_mf_client_users.client_id', '=', 'tb_mf_client.client_id')
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
            
            if ($request->position_id == 0){
                $position = [3,4];
            }
            else{
                $position = [$request->position_id];
            }
            if ( $user_position_id == 3) {
                $users = DB::table('tb_mf_client_users')
                ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
                ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
                ->where("tb_mf_client.is_archived", "=", "0")
                ->where("tb_mf_client_users.client_id", "=",$client_id)
                ->wherein("tb_mf_client_users.position_id", $position)
                ->get();            
            } else {
                $users = DB::table('tb_mf_client_users')
                ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
                ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
                ->where("tb_mf_client.is_archived", "=", "0")
                ->wherein("tb_mf_client_users.position_id", $position)
                ->where("tb_mf_client_users.user_id", '=', $request->user_id)
                ->where("tb_mf_client_users.client_id", "=",$client_id)
                ->get();
                }
            
            // if($personnellists)
            // {
                foreach ($users as $key => $personnellist) {
                    $output.='<tr>'.
                    '<td class="center" id="ref"></td>'.
                    '<td class="center">'.$personnellist->fullname.'</td>'.
                    '<td class="center">'.$personnellist->client_name.'</td>'.
                    '<td class="center">'.$personnellist->position.'</td>'.
                    '<td class="center">'.$personnellist->username.'</td>'.
                    '<td>'.
                        '<div class="row">'.
                            '<div class="col-md-3">'.                   
                                '<button type="button" class="btn-sx btn-success"  data-toggle="modal" data-target="#editModal" 
                                    data-lastname="'.$personnellist->lastname.'"
                                    data-firstname="'.$personnellist->firstname.'"
                                    data-middlename="'.$personnellist->middlename.'"
                                    data-position_id="'.$personnellist->position_id.'"
                                    data-username="'.$personnellist->username.'">'.
                                    '<i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>'.
                                '</button>'.                            
                            '</div>'.                                                
                            '<div class="col-md-3">
                                    <button type="button" class="btn-sx btn-danger"  data-toggle="modal" data-target="#deleteModal"
                                        data-fullname="'.$personnellist->fullname.'"
                                        data-user_id="'.$personnellist->user_id.'">'.
                                        '<i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>'.
                                    '</button>'.
                            '</div>'.
                        '</div>'.
                    '</td>'.
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
        $users_id = DB::table('tb_mf_client_users')
        ->where('username', '=', $request->username)
        ->get();

        foreach($users_id as $user_id){
            $userid = $user_id->user_id;
        }

        DB::table('tb_mf_jeep_personnel')
        ->insert([
            'user_id'           =>  $userid,
            'client_id'         =>  $request->client_idtext,
            'firstname'         =>  $request->firstname,
            'middlename'        =>  $request->middlename,
            'lastname'          =>  $request->lastname,
            'fullname'          =>  $request->firstname.' '.$request->middlename.' '.$request->lastname,
            'position_id'       =>  $request->position_idtext,
            'is_archived'       =>  "0"
        ]);

        return redirect("company/crm/company/clientuseraccount/$request->addcurrent_user_id");
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
    public function update(Request $request, $cur_user_id)
    {
        $pass = Hash::make($request->editpassword);
            
        DB::table('tb_mf_client_users')
        ->where('user_id', '=', $request->edituser_id)
        ->update([
            'client_id'         =>  $request->editclient_idtext,
            'firstname'         =>  $request->editfirstname,
            'middlename'        =>  $request->editmiddlename,
            'lastname'          =>  $request->editlastname,
            'fullname'          =>  $request->editfirstname.' '.$request->editmiddlename.' '.$request->editlastname,
            'position_id'       =>  $request->editposition_idtext,
            'username'          =>  $request->editusername,
            'password'          =>  $pass

        ]);
    
        DB::table('tb_mf_jeep_personnel')
        ->where('user_id', '=', $request->edituser_id)
        ->update([
            'client_id'         =>  $request->editclient_idtext,
            'firstname'         =>  $request->editfirstname,
            'middlename'        =>  $request->editmiddlename,
            'lastname'          =>  $request->editlastname,
            'fullname'          =>  $request->editfirstname.' '.$request->editmiddlename.' '.$request->editlastname,
            'position_id'       =>  $request->editposition_idtext,
            'is_archived'       =>  "0"
        ]);

        return redirect("company/crm/company/clientuseraccount/$cur_user_id");
    }
    public function archive(Request $request){
        DB::table('tb_mf_client_users')
        ->where('user_id', $request->deluser_id)
        ->update(['is_archived' => 1]);

        DB::table('tb_mf_jeep_personnel')
        ->where('user_id', $request->deluser_id)
        ->update(['is_archived' => 1]);

        return redirect("company/crm/company/clientuseraccount/$request->delcurrent_user_id");
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
