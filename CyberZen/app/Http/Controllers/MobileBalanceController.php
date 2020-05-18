<?php

namespace App\Http\Controllers;

use App\MobileBalances;
use Illuminate\Http\Request;
use DB;
class MobileBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crm/passenger/mobile_checkbal');
    }

    public function balance_check(Request $request){
        $data = DB::table('tb_mf_carduser_records')
            ->select(DB::Raw('
                *,
                left(rfid_number, 7) as rfid_left,
                RIGHT(rfid_number, 3) as rfid_right	
            '))
            ->where('rfid_number', '=', $request->card_number)
            ->get();
            

        return view('crm/passenger/mobile_card_balance_output')->with('data', $data);
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
     * @param  \App\MobileBalances  $mobileBalances
     * @return \Illuminate\Http\Response
     */
    public function show(MobileBalances $mobileBalances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileBalances  $mobileBalances
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileBalances $mobileBalances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileBalances  $mobileBalances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileBalances $mobileBalances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileBalances  $mobileBalances
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileBalances $mobileBalances)
    {
        //
    }
}
