<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use DB;

class TransactionsController extends Controller
{
    public function jeeptransactions($user_id){

<<<<<<< HEAD
        return view("cms/admin/jeeptransactions")->with('user_id', $user_id);
=======
        return view("cms/admin/jeeptransaction")->with('user_id', $user_id);
>>>>>>> dev-ron
    }

    public function cardtransactions($user_id){

<<<<<<< HEAD
        return view("cms/admin/cardtransactions")->with('user_id', $user_id);
=======
        return view("cms/admin/cardtransaction")->with('user_id', $user_id);
>>>>>>> dev-ron
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'rfid_number'           => 'required',    
            'updated_by'            => 'required'
        ]);

        $data = $request->all();
        DB::table('tb_tr_card_transactions')
        ->insert([
            'rfid_number'           => $data['rfid_number'],    
            'transactiontype_id'    => 2,
            'amount'                => 100.0,
            'updated_by'            => $data['updated_by'],
        ]);

        DB::table('tb_mf_carduser_records')->where('rfid_number', $data['rfid_number'])
                                           ->update(['is_active'=> 1]);
                                   
<<<<<<< HEAD

        return redirect()->route('cardlist.index', ['id' => $data['updated_by']]);
=======
        $access = DB::table('tb_users')
        ->where('user_id', '=', $data['updated_by'])
        ->get();
        foreach($access as $access_lvl){
            $access_level = $access_lvl->access_level_id;
        }
        return redirect()->route('cardlist.index', ['id' => $data['updated_by'], 'access_level'=> $access_level]);
>>>>>>> dev-ron
    }
}
