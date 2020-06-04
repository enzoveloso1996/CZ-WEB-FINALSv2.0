<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class MobProfileController extends Controller
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

        if(session('login_status') <> 'logged_in'){
            return redirect()->route('home');
        }

        return view('crm/passenger/mobile_changeprofile')->with('carduser_id', $carduser_id)->with('data', $data);
    }

    public function profile_change(Request $request)
    {
        DB::table('tb_mf_carduser_records')
            ->where('carduser_id', '=', $request->carduser_id)
            ->update([
                'last_name'     => $request->PLname,
                'first_name'    => $request->PFname,
                'middle_name'   => $request->PMname,
                'fullname'      => $request->PFname.' '.$request->PMname.' '.$request->PLname,
                'email_address' => $request->PEmail,
                'contact_number'=> $request->PContact
            ]);

        $request->session()->flash('msg_value', 1);     
        $request->session()->flash('password_msg', "Profile data Successfully changed");
    
        return redirect("/mtrans/$request->carduser_id")->with('status', 'logged_in');

    }

    public function pass_index($carduser_id)
    {  
        $data = DB::table('tb_mf_carduser_records')
            ->where('carduser_id','=', $carduser_id)
            ->get();

        if(session('login_status') <> 'logged_in'){
            return redirect()->route('home');
        }

        return view('crm/passenger//mobile_changepassword')->with('carduser_id', $carduser_id)->with('data', $data);
    }

    public function change_password(Request $request)
    {
        $result = DB::table('tb_mf_carduser_records')
            ->where('carduser_id', '=', $request->carduser_id)
            ->get();

        foreach($result as $item){
            $pw_hash = $item->password;
        }

        if(Hash::check($request->currentpass, $pw_hash)){
            if($request->newpassword == $request->confirmpass){
            
                $hashpw = Hash::make($request->newpassword);
    
                DB::table('tb_mf_carduser_records')
                    ->where('carduser_id', '=', $request->carduser_id)
                    ->update([
                        'password'=> $hashpw
                    ]);
            }
            $request->session()->flash('msg_value', 1);     
            $request->session()->flash('password_msg', "Password Successfully changed");

        }
        else{
            $request->session()->flash('password_msg', "Please enter your current password First!");
            $request->session()->flash('msg_value', 0);
        }

        return redirect("/mtrans/$request->carduser_id")->with('status', 'logged_in');
    }



    public function hold_card(Request $request){
        $code = $request->code;
        $input = $request->code_input;

        if($code == $input){
            DB::table('tb_mf_carduser_records')
                ->where('carduser_id', '=', $request->carduser_id)
                ->update([
                    'is_hold' => 1
                ]);

                $request->session()->put('card_status', 1);
                return redirect("/mtrans/$request->carduser_id");
        }
    }

    public function change_cardnumber(Request $request){
        $old_card_number = $request->old_card_number;
        $new_card_number = $request->new_card_number;

        $account = DB::table('tb_mf_carduser_records')
            ->where('carduser_id', '=', $request->carduser_id)
            ->get();

        foreach ($account as $row) {
            $card_balance = $row->card_balance;
            $status = $row->status;
            $last_name = $row->last_name;
            $first_name = $row->first_name;
            $middle_name = $row->middle_name;
            $fullname = $row->fullname;
            $password = $row->password;
            $email_address = $row->email_address;
            $contact_number = $row->contact_number;
            $cardtype_id = $row->cardtype_id;
            $is_student = $row->is_student;
        }

        $account2 = DB::table('tb_mf_carduser_records')
            ->where('rfid_number', '=', $new_card_number)
            ->get();

        foreach ($account2 as $row2) {
            $card_balance2 = $row2->card_balance;
        }

        DB::table('tb_mf_carduser_records')
            ->where('rfid_number', '=', $new_card_number)
            ->update([
                'card_balance' => $card_balance + $card_balance2,
                'status' => $status,
                'last_name' => $last_name,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'fullname' => $fullname,
                'password' => $password,
                'email_address' => $email_address,
                'contact_number' => $contact_number,
                'cardtype_id' => $cardtype_id,
                'is_student' => $is_student
            ]);
        
        DB::table('tb_mf_carduser_records')
            ->where('rfid_number', '=', $old_card_number)
            ->update([
                'card_balance' => 0,
                'is_archived' => 1
            ]);
            
        $request->session()->forget('login_status');
        $request->session()->flash('msg_status', 1);
        return redirect("/");

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
