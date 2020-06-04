<?php

namespace App\Http\Controllers;

use App\MobileLogins;
use Illuminate\Http\Request;
use DB;
use Hash;

class MobileLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crm/passenger/login_mobile');
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
     * @param  \App\MobileLogins  $mobileLogins
     * @return \Illuminate\Http\Response
     */
    public function show(MobileLogins $mobileLogins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileLogins  $mobileLogins
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileLogins $mobileLogins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileLogins  $mobileLogins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileLogins $mobileLogins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileLogins  $mobileLogins
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileLogins $mobileLogins)
    {
        //
    }

    public function login(Request $request){
        $card_number = $request->card_number;
        // $card_number = 0450604003;
        $password = $request->password;

        $carduser_id = 0;
        $result = DB::table('tb_mf_carduser_records')
            ->where('rfid_number', '=', $card_number)
            ->get();

            if(count($result) == 1){
            foreach($result as $row){
                $hashpw = $row->password;
                $carduser_id = $row->carduser_id;
                $is_hold = $row->is_hold;
                $is_archived = $row->is_archived;
            }
            
            if ($is_archived == 1){
                return redirect('/');                
            }
            
            if(Hash::check($password,$hashpw )){
                $request->session()->put('login_status', "logged_in");
                $request->session()->put('carduser_id', $carduser_id);
                $request->session()->put('card_status', $is_hold);
                return redirect("mtrans/$carduser_id");
            }
            else{
                return redirect('/mob-login-index');
            }
        }
        else{
            return redirect('/mob-login-index');
        }

    }

    public function logout(Request $request){
        $request->session()->flush();
        $request->session()->forget('login_status');

        return redirect()->route('home');
    }

}
