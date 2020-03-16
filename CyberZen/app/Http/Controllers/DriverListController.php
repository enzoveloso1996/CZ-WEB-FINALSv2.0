<?php

namespace App\Http\Controllers;

use App\DriverLists;
use Illuminate\Http\Request;
use DB;

class DriverListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companylist = DB::table('tb_mf_client')
        ->select('client_id','client_name')
        ->where('is_archived','=',0)
        ->get();


        $driverlists = DB::table('tb_mf_jeep_personnel')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep_personnel.client_id')
        ->join('tb_mf_position', 'tb_mf_jeep_personnel.position_id', '=', 'tb_mf_position.id')
        ->where('tb_mf_client.is_archived','=',0)
        ->paginate(10);

        $drivercount = DB::table('tb_mf_jeep_personnel')
        ->select(DB::raw('COUNT(id) as count'))
        ->get()->toarray();
       
        $drivercount = array_column($drivercount, 'count');

        
        return view('cms/admin/driverlist')->with('drivercount', json_encode($drivercount, JSON_NUMERIC_CHECK))
                            ->with('driverlists', $driverlists)
                            ->with('companylist', $companylist);

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
     * @param  \App\DriverLists  $driverLists
     * @return \Illuminate\Http\Response
     */
    public function show(DriverLists $driverLists)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DriverLists  $driverLists
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverLists $driverLists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DriverLists  $driverLists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverLists $driverLists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DriverLists  $driverLists
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverLists $driverLists)
    {
        //
    }

    public function combosearch(Request $request)
    {
        if($request->ajax())
    {
        $output="";
        $driverlists = DB::table('tb_mf_jeep_personnel')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep_personnel.client_id')
        ->join('tb_mf_position', 'tb_mf_jeep_personnel.position_id', '=', 'tb_mf_position.id')
        ->select('tb_mf_client.client_name', 'tb_mf_position.position', DB::raw("CONCAT(tb_mf_jeep_personnel.firstname,' ',tb_mf_jeep_personnel.lastname) as drivername"))
        ->where('tb_mf_client.client_name', 'LIKE', '%'.$request->combosearch.'%')
        ->where('tb_mf_client.is_archived','=',0)
        ->paginate(10);
        
        if($driverlists)
        {
            foreach ($driverlists as $key => $driverList) {
                $output.='<tr>'.
                '<td class="center" id="ref"></td>'.
                '<td class="left">'.$driverList->client_name.'</td>'.
                '<td class="left">'.$driverList->drivername.'</td>'.
                '<td class="left">'.$driverList->position.'</td>'.
                '</tr>';
        } 
            return Response($output);
        }
            
    }
    }
}
