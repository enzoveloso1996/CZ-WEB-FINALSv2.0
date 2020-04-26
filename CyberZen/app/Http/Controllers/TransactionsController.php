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
        ->where('tb_tr_card_transactions.created_at','LIKE','%'.$current_date_time.'%')
        ->paginate(20);
    
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
    public function cardspdf(){
        $current_date_time = Carbon::today()->toDateString();
        $data = DB::table('tb_tr_card_transactions')
        ->join('tb_users', 'tb_users.user_id', '=', 'tb_tr_card_transactions.updated_by')
        ->join('tb_mf_transactiontype', 'tb_mf_transactiontype.transactiontype_id', '=', 'tb_tr_card_transactions.transactiontype_id')
        ->select('tb_tr_card_transactions.rfid_number','tb_tr_card_transactions.transactiontype_id','tb_mf_transactiontype.transaction_type','tb_tr_card_transactions.amount','tb_users.user_id','tb_users.firstname','tb_tr_card_transactions.created_at')
        ->where('tb_tr_card_transactions.created_at','LIKE','%'.$request->search.'%')
        ->paginate(20);

        $pdf = PDF::loadView('/cms/admin/try' , $data);
        $fileName = $current_date_time;
        //$pdf->save(storage_path('/Downloads').$fileName.'.pdf');
        return $pdf->download($fileName . '.pdf');
    }

    function convert_data_to_html()
    {
        $cards_data = $this->pdf();
        $output = '<!doctype html>
            <html lang="en">
            <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
            <title>Hello, world!</title>
            </head>
            <body>
            <div class="jumbotron jumbotron-fluid">
            <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            </div>
            </div>
            <div class="container">
            <div class="row">
            <h3 align="center">Customer Data</h3>
            <table class="table table-bordered">
            <thead>
            <tr>
            <th class="center"></th>
            <th class="center">RFID</th>
            <th class="center">Transaction Type</th>
            <th class="center">Amount</th>
            <th class="center">Updated by</th>
            <th class="center">Date</th>
            </tr>
            </thead>
            <tbody>';  

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
        $output .= '
                </tbody>
                </table>
                </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
                </body>
                </html>';
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
