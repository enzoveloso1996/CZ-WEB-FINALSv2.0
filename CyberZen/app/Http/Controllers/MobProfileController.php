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
