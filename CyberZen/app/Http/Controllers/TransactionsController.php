<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use DB;

class TransactionsController extends Controller
{
    public function jeeptransactions($user_id){

        return view("cms/admin/jeeptransaction")->with('user_id', $user_id);
    }

    public function cardtransactions($user_id){

        return view("cms/admin/cardtransaction")->with('user_id', $user_id);
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
            'transactiontype_id'    => 1,
            'amount'                => 100.0,
            'updated_by'            => $data['updated_by'],
        ]);

        DB::table('tb_mf_carduser_records')->where('rfid_number', $data['rfid_number'])
                                           ->update(['is_active'=> 1]);
                                   
        $access = DB::table('tb_users')
        ->where('user_id', '=', $data['updated_by'])
        ->get();
        foreach($access as $access_lvl){
            $access_level = $access_lvl->access_level_id;
        }
        return redirect()->route('cardlist.index', ['id' => $data['updated_by'], 'access_level'=> $access_level]);
    }
    public function cards($user_id)
    {
        $cards = DB::table('tb_tr_card_transactions')
        ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
        ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
        ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
        ->paginate(20);

        return view("cms/admin/cardtransaction")->with('user_id', $user_id)
                                                ->with('cards', $cards);
    }
}
