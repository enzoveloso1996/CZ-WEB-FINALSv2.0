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
        $clientname = DB::table('tb_mf_client')
        ->where("is_archived","=","0")
        ->where("client_id", "=",$id)
        ->get();

        $jeeplists = DB::table('tb_mf_jeep')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
        ->where('tb_mf_client.is_archived','=',0)
        ->where('tb_mf_client.client_id','=',$id)
        ->paginate(5);

        $jeepcount = DB::table('tb_mf_jeep')
        ->select(DB::raw('COUNT(plate_number) as count'))
        ->where('client_id','=',$id)
        ->get()->toarray();
       
        $jeepcount = array_column($jeepcount, 'count');

        
        return view('crm/company/client_jeep')->with('user_id', $id)
                            ->with('jeepcount', json_encode($jeepcount, JSON_NUMERIC_CHECK))
                            ->with('clientname', $clientname)
                            ->with('jeeplists', $jeeplists);
                            
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
            'client_id'     =>  $request->client_id,
            'plate_number'  =>  $request->platenumber
        ]);
        return redirect('company/clientjeeplist');
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
    public function update(Request $request, ClientJeep $clientJeep)
    {
        //
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
        ->where('jeep_id', $request->jeep_id)
        ->update(['is_archived' => 1]);

        return redirect('company/clientjeeplist');
    }
}
