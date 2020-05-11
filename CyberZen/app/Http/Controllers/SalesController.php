<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $monthlysale = DB::table('tb_tr_jeep_transactions')
        ->join("tb_mf_jeep","tb_mf_jeep.plate_number","=","tb_tr_jeep_transactions.jeep_plate_number")
        ->join("tb_mf_client","tb_mf_client.client_id","=","tb_mf_jeep.client_id")
        ->select(   DB::raw("SUM(tb_tr_jeep_transactions.fare) as monthlysales"),
                    DB::raw("DATE_FORMAT(tb_tr_jeep_transactions.created_at, '%Y-%M') as monthyear"))
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy(  DB::raw("DATE_FORMAT(tb_tr_jeep_transactions.created_at, '%Y-%M')"))
        ->take(12)
        ->get()->toarray();
        $monthlysale = array_reverse($monthlysale);

        $clientsale = DB::table('tb_tr_jeep_transactions')
        ->join("tb_mf_jeep","tb_mf_jeep.plate_number","=","tb_tr_jeep_transactions.jeep_plate_number")
        ->join("tb_mf_client","tb_mf_client.client_id","=","tb_mf_jeep.client_id")
        ->select(   DB::raw("SUM(tb_tr_jeep_transactions.fare) as clientsales"),
                    DB::raw("tb_mf_client.client_name as client"))
        ->orderBy('tb_tr_jeep_transactions.created_at')
        ->groupBy(  DB::raw("tb_mf_client.client_name"))
        ->get()->toarray();

        $cardchart = DB::table('tb_tr_card_transactions')
        ->join("tb_mf_transactiontype", "tb_mf_transactiontype.transactiontype_id", "=", "tb_tr_card_transactions.transactiontype_id")
        ->select(   DB::raw("SUM(tb_tr_card_transactions.amount) as total"), "tb_mf_transactiontype.transaction_type")
        ->groupBY("tb_mf_transactiontype.transaction_type")
        ->get()->toarray();

        $month = array_column($monthlysale, 'monthyear');
        $client = array_column($monthlysale, 'client');
        
        $monthlysales = array_column($monthlysale, 'monthlysales');
        
        $clientsales = array_column($clientsale, 'clientsales');
        $client_name = array_column($clientsale, 'client');

        $transtype = array_column($cardchart, 'transaction_type');
        $cardtotalsales = array_column($cardchart, 'total');
      
        $totalsales = DB::table('tb_tr_jeep_transactions')
        ->select(DB::raw("SUM(fare) as totalsales"))
        ->get();

        $totalcardsActive = DB::table('tb_mf_carduser_records')
        ->select(DB::raw("COUNT(rfid_number) as count"))
        ->where('is_active','=','1')
        ->get()->toarray();

        $cardsales = DB::table('tb_tr_card_transactions')
        ->select(DB::raw("SUM(amount) as total"))
        ->get();        

        $totalcardsActive = array_column($totalcardsActive, 'count');
        
        if(session('login_status') == 'logged_in'){
            return view('cms/admin/dashboard')->with('user_id', $user_id)
            ->with('monthlysales', json_encode($monthlysales, JSON_NUMERIC_CHECK))
            ->with('month', json_encode($month, JSON_NUMERIC_CHECK))
            ->with('client', json_encode($client, JSON_NUMERIC_CHECK))
            ->with('clientnames', json_encode($client_name, JSON_NUMERIC_CHECK))
            ->with('clientsales', json_encode($clientsales, JSON_NUMERIC_CHECK))
            ->with('totalsales', $totalsales)
            ->with('cardsales', $cardsales)
            ->with('transtype', json_encode($transtype, JSON_NUMERIC_CHECK))
            ->with('cardtotalsales', json_encode($cardtotalsales, JSON_NUMERIC_CHECK))
            ->with('activecards', json_encode($totalcardsActive, JSON_NUMERIC_CHECK));
        }else{
            return redirect('adminlogin');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
