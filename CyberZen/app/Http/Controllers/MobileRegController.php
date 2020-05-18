<?php

namespace App\Http\Controllers;

use App\MobileRegs;
use Illuminate\Http\Request;
use DB;
use Hash;

class MobileRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('crm/passenger/mobile_registration');
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
     * @param  \App\MobileRegs  $mobileRegs
     * @return \Illuminate\Http\Response
     */
    public function show(MobileRegs $mobileRegs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileRegs  $mobileRegs
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileRegs $mobileRegs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileRegs  $mobileRegs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileRegs $mobileRegs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileRegs  $mobileRegs
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileRegs $mobileRegs)
    {
        //
    }

    public function reg_success(Request $request)
    {
        $card_number = $request->cardnumber;
        $pw_hash = Hash::make($request->password);

        DB::table('tb_mf_carduser_records')
            ->where('rfid_number', '=', $card_number)
            ->update([
                'last_name'             => $request->lastname,
                'first_name'            => $request->firstname,
                'middle_name'           => $request->middlename,
                'fullname'              => $request->firstname.' '.$request->middlename.' '.$request->lastname,
                'email_address'         => $request->emailadd,
                'contact_number'        => $request->contactnum,
                'password'              => $pw_hash
            ]);
        
        $data = DB::table('tb_mf_carduser_records')
            ->where('rfid_number', '=', $card_number)
            ->get();
        
            foreach($data as $items){
                $card_type = $items->cardtype_id;
            }
            
        return view('crm/passenger/mobile_success_registration')->with('card_number', $card_number)->with('card_type', $card_type);
    }
}
