<?php

namespace App\Http\Controllers;

use App\MobileTransactions;
use Illuminate\Http\Request;
use DB;

class MobileTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($carduser_id)
    {

        $data = DB::table('tb_mf_carduser_records')
        ->where('carduser_id', '=', $carduser_id)
        ->get();

        foreach($data as $row){
            $card_number = $row->rfid_number;
        }

        
        $PDO = DB::connection('mysql')->getPdo();
        $stmt = $PDO->prepare("
                        SELECT
                            tb_tr_card_transactions.rfid_number,
                            tb_tr_card_transactions.amount,
                            tb_tr_card_transactions.created_at,
                            '' = 0 as type,
                            '' = 1 as totalKm
                        FROM
                            tb_tr_card_transactions
                        WHERE
                        tb_tr_card_transactions.rfid_number = ".$card_number."
                            
                        UNION ALL

                        SELECT
                            tb_tr_jeep_transactions.rfid_number,
                            tb_tr_jeep_transactions.fare as amount,
                            tb_tr_jeep_transactions.created_at,
                            '' = 1 as type,
                            tb_tr_jeep_transactions.totalKm
                        FROM
                            tb_tr_jeep_transactions
                        WHERE
                        tb_tr_jeep_transactions.rfid_number = ".$card_number."
                        ORDER BY
                            created_at DESC   
                        LIMIT 15                                                        
                                      ");

        $stmt->execute();
        $result_union = $stmt->fetchAll((\PDO::FETCH_ASSOC));
        $result_final_union = json_encode($result_union);

        $lastest_reload = DB::table('tb_tr_card_transactions')
            ->where('rfid_number', '=', $card_number)
            ->orderBy('created_at', 'DESC')
            ->take(1)
            ->get();

        $latest_payment = DB::table('tb_tr_jeep_transactions')
            ->where('rfid_number', '=', $card_number)
            ->orderBy('created_at', 'DESC')
            ->take(1)
            ->get();

            
            $result_unions = json_decode($result_final_union, true);

        if(session('login_status') <> 'logged_in'){
            return redirect()->route('home');
        }
        
        return view('crm/passenger/mobile_transaction_history')
                        ->with('result_union', $result_unions)
                        ->with('data', $data)
                        ->with('latest_reload', $lastest_reload)
                        ->with('latest_payment', $latest_payment)
                        ->with('carduser_id', $carduser_id);
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
     * @param  \App\MobileTransactions  $mobileTransactions
     * @return \Illuminate\Http\Response
     */
    public function show(MobileTransactions $mobileTransactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileTransactions  $mobileTransactions
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileTransactions $mobileTransactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileTransactions  $mobileTransactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileTransactions $mobileTransactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileTransactions  $mobileTransactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileTransactions $mobileTransactions)
    {
        //
    }

}
