<?php

namespace App\Http\Controllers;

use App\ClientDashboard;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use DB;

class ClientDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $accounts = DB::table('tb_mf_client')
        ->join('tb_mf_client_users', 'tb_mf_client_users.client_id', '=', 'tb_mf_client.client_id')
        ->where('tb_mf_client_users.user_id', '=', $id)
        ->get();
        foreach ($accounts as $account) {
            $client_id = $account->client_id;
            $client_name = $account->client_name;
        }

        $totalsales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(DB::RAW("SUM(tb_tr_jeep_transactions.fare) as totalsales"), DB::raw("year(tb_tr_jeep_transactions.created_at) as year"))
        ->orderBy('tb_tr_jeep_transactions.created_at', 'DESC')
        ->groupBy(  DB::raw("year(tb_tr_jeep_transactions.created_at)"))
        // ->groupBy('tb_mf_jeep.client_id')
        ->take(1)
        ->get();

        $cardusers = DB::table('tb_mf_carduser_records')
        ->select(DB::RAW("COUNT(rfid_number) as totalcardusers"))
        ->get();

        $monthlysales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(   DB::RAW("SUM(tb_tr_jeep_transactions.fare) as monthlysales"),
                    DB::RAW("DATE_FORMAT(tb_tr_jeep_transactions.created_at, '%Y-%M') as monthyear"))
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy(  DB::raw("DATE_FORMAT(tb_tr_jeep_transactions.created_at, '%Y-%M')"))
        ->take(12)
        ->get()->toarray();

        $monthlysales = array_reverse($monthlysales);
        $monthyear = array_column($monthlysales, 'monthyear');
        $monthlysale = array_column($monthlysales, 'monthlysales');
    
        $yearlysales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(   DB::RAW("SUM(tb_tr_jeep_transactions.fare) as yearlysales"),
                    DB::RAW("YEAR(tb_tr_jeep_transactions.created_at) as year"))
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy(  DB::raw("YEAR(tb_tr_jeep_transactions.created_at)"))
        ->take(5)
        ->get()->toarray();

        $yearlysales = array_reverse($yearlysales);
        $year = array_column($yearlysales, 'year');
        $yearlysale = array_column($yearlysales, 'yearlysales');
        
        $faresales = DB::table('tb_tr_jeep_transactions')
        ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
        ->join('tb_mf_carduser_records', 'tb_mf_carduser_records.rfid_number', '=', 'tb_tr_jeep_transactions.rfid_number')
        ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
        ->where('tb_mf_jeep.client_id','=', $client_id)
        ->select(DB::RAW("SUM(tb_tr_jeep_transactions.fare) as totalsales"),'tb_mf_cardtype.cardtype')
        ->orderBy('tb_tr_jeep_transactions.created_at','DESC')
        ->groupBy("tb_mf_cardtype.cardtype")
        ->get()->toarray();

        $cardtype = array_column($faresales, 'cardtype');
        $faresale = array_column($faresales, 'totalsales');

        if(session('login_status') == 'logged_in'){
            return view('crm/company/clientdashboard')->with('user_id', $id)->with('client_name', $client_name)
            ->with('totalsales', $totalsales)
            ->with('totalcardusers', $cardusers)
            ->with('monthyear', json_encode($monthyear, JSON_NUMERIC_CHECK))
            ->with('monthlysales', json_encode($monthlysale, JSON_NUMERIC_CHECK))
            ->with('faresales', json_encode($faresale, JSON_NUMERIC_CHECK))
            ->with('cardtype', json_encode($cardtype, JSON_NUMERIC_CHECK))
            ->with('year', json_encode($year, JSON_NUMERIC_CHECK))
            ->with('yearlysales', json_encode($yearlysale, JSON_NUMERIC_CHECK));
        }else{
            return redirect('clientlogin');
        }


    }
    public function jeeps($id)
    {
        $accounts = DB::table('tb_mf_client')
        ->join('tb_mf_client_users', 'tb_mf_client_users.client_id', '=', 'tb_mf_client.client_id')
        ->where('tb_mf_client_users.user_id', '=', $id)
        ->get();
        foreach ($accounts as $account) {
            $client_id = $account->client_id;
            $client_name = $account->client_name;
        }

        $current_date_time = Carbon::today()->toDateString();
        $jeeps = DB::table('tb_tr_jeep_transactions')
                ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
                ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
                ->select('tb_tr_jeep_transactions.rfid_number','tb_mf_jeep.plate_number','tb_mf_jeep.client_id','tb_mf_client.client_id','tb_mf_client.client_name','tb_tr_jeep_transactions.totalKm','tb_tr_jeep_transactions.fare','tb_tr_jeep_transactions.jeep_plate_number','tb_tr_jeep_transactions.created_at')
                ->where('tb_tr_jeep_transactions.created_at','LIKE','%'.$current_date_time.'%')
                ->paginate(20);

                if(session('login_status') == 'logged_in'){
                    return view("crm/company/jeeptransactions")->with('user_id', $id)
                                                               ->with('client_name', $client_name)
                                                               ->with('jeeps', $jeeps);
                }else{
                    return redirect('clientlogin');
                }
    }
    public function transactionsbydate(Request $request)
    { 
            if(!empty($request->date)){
                $output="";
                $jeeps = array();
                $jeeps = DB::table('tb_tr_jeep_transactions')
                ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
                ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
                ->select('tb_tr_jeep_transactions.rfid_number','tb_mf_jeep.plate_number','tb_mf_jeep.client_id','tb_mf_client.client_id','tb_mf_client.client_name','tb_tr_jeep_transactions.totalKm','tb_tr_jeep_transactions.fare','tb_tr_jeep_transactions.jeep_plate_number','tb_tr_jeep_transactions.created_at')
                ->where('tb_tr_jeep_transactions.created_at','LIKE','%'.$request->date.'%')
                ->paginate(20);
            }else{
                $output="";
            }
            
            if($jeeps)
            {
                foreach ($jeeps as $key => $jeep) {
                    $output.='<tr>'.
                    '<td class="center" id="ref"></td>'.
                    '<td class="left">'.$jeep->rfid_number.'</td>'.
                    '<td class="left">'.$jeep->totalKm.'</td>'.
                    '<td class="left">'.$jeep->fare.'</td>'.
                    '<td class="left">'.$jeep->jeep_plate_number.'</td>'.
                    '<td class="left">'.$jeep->created_at.'</td>'.
                    '</tr>';
                } 
                return Response($output);
            }
    }
    public function transactionspdf(Request $request){
        $current_date_time = Carbon::today()->toDateString();
        $date=$request->get('date');
        $company=$request->get('company');
        $data = DB::table('tb_tr_jeep_transactions')
                ->join('tb_mf_jeep', 'tb_mf_jeep.plate_number', '=', 'tb_tr_jeep_transactions.jeep_plate_number')
                ->join('tb_mf_client', 'tb_mf_client.client_id', '=', 'tb_mf_jeep.client_id')
                ->select('tb_tr_jeep_transactions.rfid_number','tb_mf_jeep.plate_number','tb_mf_jeep.client_id','tb_mf_client.client_id','tb_mf_client.client_name','tb_tr_jeep_transactions.totalKm','tb_tr_jeep_transactions.fare','tb_tr_jeep_transactions.jeep_plate_number','tb_tr_jeep_transactions.created_at')
                ->where('tb_tr_jeep_transactions.created_at','LIKE','%'.$date.'%')
                ->paginate(20);

        $pdf = PDF::loadView('/cms/admin/tryjeep' , $data);
        $fileName = 'JT-'.$current_date_time;
        //return $pdf->stream('/cms/admin/try' , $data);
        return $pdf->download($fileName . '.pdf');
    }

    // public function index_value($value){
    //     $totalsales = DB::table('tb_tr_jeep_transactions')
    //     ->get();
    // }

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
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientDashboard $clientDashboard)
    {
        //
    }
}
