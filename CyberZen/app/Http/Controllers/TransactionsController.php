<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;

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
        $current_date_time = Carbon::today()->toDateString();
        $cards = DB::table('tb_tr_card_transactions')
        ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
        ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
        ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
        ->where('tb_tr_card_transactions.created_at','LIKE','%'.$current_date_time.'%')
        ->paginate(20);

        return view("cms/admin/cardtransaction")->with('user_id', $user_id)
                                                ->with('cards', $cards);
    }
    public function pdf()
    {
        $current_date_time = Carbon::today()->toDateString();
        $cards = DB::table('tb_tr_card_transactions')
        ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
        ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
        ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
        // ->where('tb_tr_card_transactions.created_at','LIKE','%'.$current_date_time.'%')
        ->paginate(20);

        //return view("cms/admin/try")->with('cards', $cards);     
        return $cards;
        
    }
    public function view(){
        $cards_data = $this->pdf();
        return view('cms/admin/try')->with('cards_data', $cards_data);
    }
    public function try(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_data_to_html());
        return $pdf->download('invoice.pdf');
    }
    public function trytry(){
        $current_date_time = Carbon::today()->toDateString();
        $data = DB::table('tb_tr_card_transactions')
        ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
        ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
        ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
        // ->where('tb_tr_card_transactions.created_at','LIKE','%'.$current_date_time.'%')
        ->paginate(20);
        // $cards_data = $this->pdf();

        $pdf = PDF::loadView('/cms/admin/try' , $data);
        $fileName = $current_date_time;
        //$pdf->save(storage_path('/Downloads').$fileName.'.pdf');
        return $pdf->download($fileName . '.pdf');
    }
    // function index()
    // {
    //     $cards_data = $this->cards_data();
    //     return view('try')->with('cards_data', $cards_data);
    // }
    // public function cards_data()
    // {
    //     $current_date_time = Carbon::today()->toDateString();
    //     $card_data = DB::table('tb_tr_card_transactions')
    //     ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
    //     ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
    //     ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
    //     // ->where('tb_tr_card_transactions.created_at','LIKE','%'.$current_date_time.'%')
    //     ->paginate(20)
    //     ->get();


    //     return $card_data;
                                                
    // }
    // public function try(){
    //     $pdf = \App::make('dompdf.wrapper');
    //     $pdf->loadHTML($this->convert_data_to_html());
    //     return $pdf->stream();
    // }
    function convert_data_to_html()
    {
        $cards_data = $this->pdf();
        $output = '
            <h3 align="center">Customer Data</h3>
            <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
            <th class="center"></th>
            <th class="center">RFID</th>
            <th class="center">Transaction Type</th>
            <th class="center">Amount</th>
            <th class="center">Updated by</th>
            <th class="center">Date</th>
            </tr>';  
        foreach ($cards_data as $card)
        {
            $output .= '
                <tr>
                <td class="center" id="ref"></td>
                <td class="left">'.$card->rfid_number.'</td>
                <td class="left">'.$card->transaction_type.'</td>
                <td class="center">'.$card->amount.'</td>
                <td class="left">'.$card->firstname.'</td>
                <td class="center">'.$card->created_at.'</td>
                </tr>
                ';
        }
        $output .= '</table>';
        return $output;
    }
    public function cardsbydate(Request $request)
    {
            if(!empty($request->search)){
                $output="";
                $cards = array();
                $cards = DB::table('tb_tr_card_transactions')
                ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
                ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
                ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
                ->where('tb_tr_card_transactions.created_at','LIKE','%'.$request->search.'%')
                ->paginate(20);
            }else{
                $output="";
            }
            
            if($cards)
            {
                foreach ($cards as $key => $card) {
                    $output.='<tr>'.
                    '<td class="center" id="ref"></td>'.
                    '<td class="left">'.$card->rfid_number.'</td>'.
                    '<td class="left">'.$card->transaction_type.'</td>'.
                    '<td class="left">'.$card->amount.'</td>'.
                    '<td class="left">'.$card->firstname.'</td>'.
                    '<td class="left">'.$card->created_at.'</td>'.
                    '</tr>';
                } 
                return Response($output);
            }
    }
    public function jeeps($user_id)
    {
        $jeeps = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
        ->select('tb_tr_jeep_transactions.rfid_number','tb_mf_jeep.plate_number','tb_mf_jeep.client_id','tb_mf_client.client_id','tb_mf_client.client_name','tb_tr_jeep_transactions.totalKm','tb_tr_jeep_transactions.fare','tb_tr_jeep_transactions.jeep_plate_number','tb_tr_jeep_transactions.created_at')
        ->paginate(20);

        return view("cms/admin/jeeptransaction")->with('user_id', $user_id)
                                                ->with('jeeps', $jeeps);
    }
}
