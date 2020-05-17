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
    public function index($user_id)
    {
        $users = DB::table('tb_mf_client_users')
        ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
        ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
        ->where("tb_mf_client.is_archived", "=", "0")
        ->where("tb_mf_client_users.is_archived", "=", "0")
        ->paginate(5);

        $clientname = DB::table('tb_mf_client')
        ->where("is_archived","=","0")
        ->get();

        $position = DB::table('tb_mf_position')
        ->wherein('id',[3,4])
        ->get();

        $fullname = DB::table('tb_mf_jeep_personnel')
        ->get();

        if(session('login_status') == 'logged_in'){
            return view('cms/admin/clientusers')->with('user_id', $user_id)
            ->with('userslist', $users)
            ->with('clientname', $clientname)
            ->with('fullname', $fullname)
            ->with('position', $position);
        }else{
            return redirect('adminlogin');
        }

    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";

            $tabledtl=DB::table('tb_mf_client_users')
            ->join("tb_mf_client", "tb_mf_client.client_id", "=", "tb_mf_client_users.client_id")
            ->join("tb_mf_position", "tb_mf_position.id", "=", "tb_mf_client_users.position_id")
            ->where("tb_mf_client.is_archived", "=", "0")
            ->where('firstname','LIKE','%'.$request->search."%")
            ->paginate(5);
   
                foreach ($tabledtl as $key => $tabledtll) 
                {
                    $output.='<tr>'.
                    '<td class="center" id="ref"></td>'.
                    '<td class="left">'.$tabledtll->fullname.'</td>'.
                    '<td class="center">'.$tabledtll->client_name.'</td>'.
                    '<td class="left">'.$tabledtll->position.'</td>'.
                    '<td class="left">'.$tabledtll->username.'</td>'.
                    '</tr>';
                } 
                return Response($output);
            
            
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
        if (empty($request->client_idtext) or empty($request->firstname) or empty($request->lastname) or empty($request->position_idtext) or empty($request->username) or empty($request->password)) {
            return redirect("jeeps/cms/admin/clientusers/$request->user_id")->with('status-alert', "Please complete details");
        }

        $pass = Hash::make($request->password);

        // if (empty($available)) {

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
    
            DB::table('tb_users_log')
            ->insert([
                'user_id'       =>  $request->user_id,
                'action_id'     =>  1,
                'remarks'       => 'Add Client User '.$request->username
            ]);
     
            if(session('login_status') == 'logged_in'){
                return redirect("jeeps/cms/admin/clientusers/$request->user_id")->with('status', "Registered Successfully");
            }else{
                return redirect('adminlogin');
            }
    
                
        // }

    }
    public function usernamecheck(Request $request){
        if(!empty($request->ajax()))
        {
                $tabledtl=DB::table('tb_mf_client_users')
                            ->select('tb_mf_client_users'.'username')
                            ->where('username','=',$request->user)
                            ->count();
                if($tabledtl > 0){
                    echo '<span class="text-danger"><i class="fa fa-exclamation"></i>  Username is already taken</span>';
                } else {
                    echo '<span class="text-success"><i class="fa fa-check"></i>  Username is available</span>';
                }
        }else
        {
            echo '<span class="text-success"></span>';
        }
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
