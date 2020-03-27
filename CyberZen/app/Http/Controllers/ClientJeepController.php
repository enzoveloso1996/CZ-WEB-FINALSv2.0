<?php

namespace App\Http\Controllers;

use App\ClientJeep;
use Illuminate\Http\Request;
use DB;

class ClientJeepController extends Controller
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

        $jeeplists = DB::table('tb_mf_jeep')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
        ->where('tb_mf_client.is_archived','=',0)
        ->where('tb_mf_client.client_id','=',$client_id)
        ->where("tb_mf_jeep.is_archived","=","0")
        ->orderby('tb_mf_jeep.jeep_id', 'ASC')
        ->paginate(10);

        $jeepcount = DB::table('tb_mf_jeep')
        ->select(DB::raw('COUNT(plate_number) as count'))
        ->where('client_id','=',$client_id)
        ->where("is_archived","=","0")
        ->get()->toarray();
       
        $jeepcount = array_column($jeepcount, 'count');

        
        return view('crm/company/client_jeep')->with('user_id', $id)->with('client_name', $client_name)
                            ->with('jeepcount', json_encode($jeepcount, JSON_NUMERIC_CHECK))
                            ->with('clientname', $clientname)
                            ->with('jeeplists', $jeeplists);
                            
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";

            $jeeplists = DB::table('tb_mf_jeep')
            ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
            ->where('tb_mf_client.is_archived','=',0)
            ->where('tb_mf_client.client_id','=',$client_id)
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
        DB::table('tb_mf_jeep')
        ->insert([
            'client_id'     =>  $request->client_idtext,
            'plate_number'  =>  $request->platenumber
        ]);

        DB::table('tb_mf_client_users_log')
        ->insert([
            'user_id'       =>  $request->adduser_id,
            'action_id'     =>  1,
            'remarks'       => 'Add Ejeep with Plate Number "'.$request->platenumber.' " by '.$request->adduser_id
        ]);

        return redirect("company/crm/company/clientjeeplist/$request->adduser_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientJeep  $clientJeep
     * @return \Illuminate\Http\Response
     */
    public function show(ClientJeep $clientJeep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientJeep  $clientJeep
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientJeep $clientJeep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientJeep  $clientJeep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        DB::table('tb_mf_jeep')
        ->where('jeep_id', '=', $request->editjeep_id)
        ->update([
            'client_id'     =>  $request->editclient_idtext,
            'plate_number'  =>  $request->editplatenumber
        ]);

        DB::table('tb_mf_client_users_log')
        ->insert([
            'user_id'       =>  $request->edituser_id,
            'action_id'     =>  2,
            'remarks'       => 'edit Ejeep with Plate Number "'.$request->editoldplatenumber.' " to '.$request->editplatenumber
        ]);

        return redirect("company/crm/company/clientjeeplist/$request->edituser_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientJeep  $clientJeep
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientJeep $clientJeep)
    {
        //
    }

    public function archive(Request $request){
        DB::table('tb_mf_jeep')
        ->where('jeep_id', $request->deljeep_id)
        ->update(['is_archived' => 1]);

        DB::table('tb_mf_client_users_log')
        ->insert([
            'user_id'       =>  $request->deluser_id,
            'action_id'     =>  3,
            'remarks'       => 'Archived Ejeep with Plate Number "'.$request->delplatenumber.' " by '.$request->deluser_id
        ]);


        return redirect("company/crm/company/clientjeeplist/$request->deluser_id");
    }
}
