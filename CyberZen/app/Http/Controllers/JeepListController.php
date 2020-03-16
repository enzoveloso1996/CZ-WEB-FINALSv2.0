<?php

namespace App\Http\Controllers;

use App\JeepLists;
use Illuminate\Http\Request;
use DB;

class JeepListController extends Controller
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

        $jeeplists = DB::table('tb_mf_jeep')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
        ->select('tb_mf_client.client_name','tb_mf_jeep.plate_number')
        ->where('tb_mf_client.is_archived','=',0)
        ->paginate(5);

        $jeepcount = DB::table('tb_mf_jeep')
        ->select(DB::raw('COUNT(plate_number) as count'))
        ->get()->toarray();
       
        $jeepcount = array_column($jeepcount, 'count');

        
        return view('cms/admin/jeeplist')->with('jeepcount', json_encode($jeepcount, JSON_NUMERIC_CHECK))
                            ->with('jeeplists', $jeeplists)
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
     * @param  \App\JeepLists  $jeepLists
     * @return \Illuminate\Http\Response
     */
    public function show(JeepLists $jeepLists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JeepLists  $jeepLists
     * @return \Illuminate\Http\Response
     */
    public function edit(JeepLists $jeepLists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JeepLists  $jeepLists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JeepLists $jeepLists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JeepLists  $jeepLists
     * @return \Illuminate\Http\Response
     */
    public function destroy(JeepLists $jeepLists)
    {
        //
    }

    public function combosearch(Request $request)
    {
        if($request->ajax())
    {
        $output="";
        $jeeplists = DB::table('tb_mf_jeep')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
        ->select('tb_mf_client.client_name','tb_mf_jeep.plate_number')
        ->where('tb_mf_client.client_name', 'LIKE', '%'.$request->combosearch.'%')
        ->where('tb_mf_client.is_archived','=',0)
        ->paginate(10);
        
        if($jeeplists)
        {
            foreach ($jeeplists as $key => $jeeplist) {
                $output.='<tr>'.
                '<td class="center" id="ref"></td>'.
                '<td class="left">'.$jeeplist->client_name.'</td>'.
                '<td class="left">'.$jeeplist->plate_number.'</td>'.
                '</tr>';
        } 
            return Response($output);
        }
            
    }
    }
}
