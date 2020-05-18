<?php

namespace App\Http\Controllers;

use App\WebLogin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;
use Hash;

class WebLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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
     * @param  \App\WebLogin  $webLogin
     * @return \Illuminate\Http\Response
     */
    public function show(WebLogin $webLogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WebLogin  $webLogin
     * @return \Illuminate\Http\Response
     */
    public function edit(WebLogin $webLogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebLogin  $webLogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebLogin $webLogin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WebLogin  $webLogin
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebLogin $webLogin)
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
            }
            
            
            if(Hash::check($password,$hashpw )){
                $request->session()->flash('msg_value', 2);     
                $request->session()->put('login_status', "logged_in");
                $request->session()->put('carduser_id', $carduser_id);
                return redirect("/trans/$carduser_id");
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }

    }

    public function logout(Request $request){
        $request->session()->flush();
        $request->session()->forget('login_status');

        return redirect()->route('home');
    }
    
    public function web_bal_check(Request $request){

        $data = DB::table('tb_mf_carduser_records')
            ->select(DB::Raw('
                *,
                left(rfid_number, 7) as rfid_left,
                RIGHT(rfid_number, 3) as rfid_right	
            '))
            ->where('rfid_number', '=', $request->card_number)
            ->get();

        foreach ($data as $item) {
            $rfid_left = $item->rfid_left;
            $rfid_right = $item->rfid_right;
            $card_balance = $item->card_balance;
        }
        // $rfid_left = array_column($data, 'rfid_left');
        // $rfid_right = array_column($data, 'rfid_right');
        // $card_balance = array_column($data, 'card_balance');

        $request->session()->flash('rfid_left', $rfid_left);
        $request->session()->flash('rfid_right', $rfid_right);
        $request->session()->flash('card_balance', $card_balance);

        return redirect("/")->with('bal_status', "success")->with('data', $data);
    }
}
