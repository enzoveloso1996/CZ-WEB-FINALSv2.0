<?php

namespace App\Http\Controllers;

use App\ClientDashboard;
use Illuminate\Http\Request;
use DB;

class ClientDashboardController extends Controller
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
        ->get()
        ->toarray();

        $client_id = array_column($accounts, 'client_id');
        

        $totalsales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(DB::RAW("SUM(tb_tr_jeep_transactions.fare) as totalsales"), DB::raw("year(tb_tr_jeep_transactions.created_at) as year"))
        ->orderBy('tb_tr_jeep_transactions.created_at', 'DESC')
        ->groupBy(  DB::raw("year(tb_tr_jeep_transactions.created_at)"))
        // ->groupBy('tb_mf_jeep.client_id')
        ->take(1)
        ->get();

        $cardusers = DB::table('tb_mf_carduser_records')
        ->select(DB::RAW("COUNT(rfid_number) as totalcardusers"))
        ->get();

        $monthlysales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(   DB::RAW("SUM(tb_tr_jeep_transactions.fare) as monthlysales"),
                    DB::RAW("DATE_FORMAT(tb_tr_jeep_transactions.created_at, '%Y-%M') as monthyear"))
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy(  DB::raw("DATE_FORMAT(tb_tr_jeep_transactions.created_at, '%Y-%M')"))
        ->take(12)
        ->get()->toarray();

        $monthlysales = array_reverse($monthlysales);
        $monthyear = array_column($monthlysales, 'monthyear');
        $monthlysale = array_column($monthlysales, 'monthlysales');
    
        $yearlysales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(   DB::RAW("SUM(tb_tr_jeep_transactions.fare) as yearlysales"),
                    DB::RAW("YEAR(tb_tr_jeep_transactions.created_at) as year"))
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy(  DB::raw("YEAR(tb_tr_jeep_transactions.created_at)"))
        ->take(5)
        ->get()->toarray();

        $yearlysales = array_reverse($yearlysales);
        $year = array_column($yearlysales, 'year');
        $yearlysale = array_column($yearlysales, 'yearlysales');
        
        $faresales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->join('tb_mf_carduser_records', 'tb_mf_carduser_records.rfid_number', '=', 'tb_tr_jeep_transactions.rfid_number')
        ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(DB::RAW("SUM(tb_tr_jeep_transactions.fare) as totalsales"),'tb_mf_cardtype.cardtype')
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy("tb_mf_cardtype.cardtype")
        ->get()->toarray();

        $cardtype = array_column($faresales, 'cardtype');
        $faresale = array_column($faresales, 'totalsales');


        return view('crm/company/clientdashboard')->with('user_id', $id)
                    ->with('totalsales', $totalsales)
                    ->with('totalcardusers', $cardusers)
                    ->with('monthyear', json_encode($monthyear, JSON_NUMERIC_CHECK))
                    ->with('monthlysales', json_encode($monthlysale, JSON_NUMERIC_CHECK))
                    ->with('faresales', json_encode($faresale, JSON_NUMERIC_CHECK))
                    ->with('cardtype', json_encode($cardtype, JSON_NUMERIC_CHECK))
                    ->with('year', json_encode($year, JSON_NUMERIC_CHECK))
                    ->with('yearlysales', json_encode($yearlysale, JSON_NUMERIC_CHECK));

                }

    // public function index_value($value){
    //     $totalsales = DB::table('tb_tr_jeep_transactions')
    //     ->get();
    // }

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
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientDashboard $clientDashboard)
    {
        //
    }
}
