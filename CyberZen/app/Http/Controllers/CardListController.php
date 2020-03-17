<?php

namespace App\Http\Controllers;

use App\CardLists;
use Illuminate\Http\Request;
use DB;

class CardListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //active
        $cardlisttbl = DB::table('tb_mf_carduser_records')
        ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
        ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id','tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
        ->where('tb_mf_carduser_records.is_active', '=', 1)
        ->paginate(20);

        //inactive
        $cardlisttbl2 = DB::table('tb_mf_carduser_records')
        ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
        ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id', 'tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name','tb_mf_cardtype.cardtype', 'tb_mf_carduser_records.is_active')
        ->where('tb_mf_carduser_records.is_active', '=', 0)
        ->paginate(20);


        //total sales of card
        $cardsales = DB::table('tb_tr_card_transactions')
        ->select(DB::raw("SUM(amount) as total"))
        ->get();

        //total active cards
        $activecards = DB::table('tb_mf_carduser_records')
        ->select(DB::raw("COUNT(rfid_number) as count"))
        ->where('is_active','=','1')
        ->get()->toarray();

        //card types active
        $cardtypes = DB::table('tb_mf_cardtype')
        ->select('cardtype_id','cardtype')
        ->get();

        $activecards = array_column($activecards, 'count');
        
        return view('cms/teller/cardlist')->with('cardlisttbl', $cardlisttbl)
                            ->with('activecards', json_encode($activecards, JSON_NUMERIC_CHECK))
                            ->with('cardsales', $cardsales)
                            ->with('cardlisttbl2', $cardlisttbl2)
                            ->with('cardtypes' , $cardtypes);
    }

    public function searchActive(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $output="";
            $cardlisttbl = array();
            if(!empty($data['type']) && !empty($data['is_active']) && !empty($data['search']) ){
                $cardlisttbl = DB::table('tb_mf_carduser_records')
                ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
                ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id', 'tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
                ->where('tb_mf_cardtype.cardtype_id','=',$data['type'])
                ->where('tb_mf_carduser_records.is_active','=',$data['is_active'])
                ->where('tb_mf_carduser_records.rfid_number','LIKE','%'.$data['search']."%")
                ->paginate(20);
            }else{
                $cardlisttbl = DB::table('tb_mf_carduser_records')
                ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
                ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id','tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
                ->where('tb_mf_carduser_records.is_active', '=', 1)
                ->paginate(20);
            }
            if($cardlisttbl)
            {
                foreach ($cardlisttbl as $key => $cardlisttbll) {
                    $output.='<tr>'.
                    '<td class="left">'.$cardlisttbll->rfid_number.'</td>'.
                    '<td class="center">'.$cardlisttbll->card_balance.'</td>'.
                    '<td class="left">'.$cardlisttbll->first_name.'</td>'.
                    '<td class="center"><button class="btn-sx btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-exclamation"></i></button>&nbsp;'.
                    '<button type="submit" value="Delete" class="btn-sx btn-danger"><i class="fa fa-trash"></i></button></td>'.
                    '</tr>';
            } 
                return Response($output);
            }
                
        }
    }

    public function searchInactive(Request $request)
    {
            if(!empty($request->search)){
                $output="";
                $cardlisttbl = array();
                $cardlisttbl = DB::table('tb_mf_carduser_records')
                ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
                ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id', 'tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
                ->where('tb_mf_carduser_records.is_active','=',0)
                ->where('tb_mf_carduser_records.rfid_number','LIKE','%'.$request->search."%")
                ->paginate(1);
            }else{
                $output="";
            }

            if($cardlisttbl)
            {
                foreach ($cardlisttbl as $key => $cardlisttbll) {
                    $output.='<tr>'.
                    '<td class="left">'.$cardlisttbll->rfid_number.'</td>'.
                    '<td class="center">'.$cardlisttbll->card_balance.'</td>'.
                    '<td class="left">'.$cardlisttbll->first_name.'</td>'.
                    '<td class="center"><button class="btn-sx btn-primary" data-toggle="modal" data-target="#holdcardModal" data-rfid='.$cardlisttbll->rfid_number.'><i class="fa fa-exclamation"></i></button>&nbsp;'.
                    '<button type="submit" value="Delete" class="btn-sx btn-danger"><i class="fa fa-trash"></i></button></td>'.
                    '</tr>';
            } 
                return Response($output);
            }
    }

    public function combosearch(Request $request)
    {
        if($request->ajax())
    {
        $output="";

        $cardlisttbl = DB::table('tb_mf_carduser_records')
        ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
        ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number',  'tb_mf_carduser_records.carduser_id', 'tb_mf_carduser_records.card_balance', 'tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
        ->where('tb_mf_carduser_records.is_active', '=', 1)
        ->where('tb_mf_cardtype.cardtype','LIKE','%'.$request->combosearch."%")
        ->paginate(20);

        if($cardlisttbl)
        {
            foreach ($cardlisttbl as $key => $cardlisttbll) {
                $output.='<tr>'.
                '<td class="left">'.$cardlisttbll->rfid_number.'</td>'.
                '<td class="center">'.$cardlisttbll->card_balance.'</td>'.
                '<td class="left">'.$cardlisttbll->first_name.'</td>'.
                '<td class="center"><button class="btn-sx btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-exclamation"></i></button>&nbsp;'.
                '<button type="submit" value="Delete" class="btn-sx btn-danger"><i class="fa fa-trash"></i></button></td>'.
                '</tr>';
        } 
            return Response($output);
        }
            
    }
    }

    public function reload()
    {
        $reload = DB::table('tb_mf_carduser_records')
        ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
        ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id', 'tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
        ->where('tb_mf_carduser_records.is_active', '=', 1)
        ->paginate(20);

        return view('cms/teller/reload')->with('reload' , $reload);
            
    }

    public function searchLoad(Request $request)
    {

        if(!empty($request->search)){
            $output="";
            $reload = DB::table('tb_mf_carduser_records')
            ->join('tb_mf_cardtype', 'tb_mf_cardtype.cardtype_id', '=', 'tb_mf_carduser_records.cardtype_id')
            ->select('tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.rfid_number', 'tb_mf_carduser_records.carduser_id', 'tb_mf_carduser_records.card_balance','tb_mf_carduser_records.last_name','tb_mf_carduser_records.first_name','tb_mf_carduser_records.middle_name', 'tb_mf_carduser_records.is_active', 'tb_mf_cardtype.cardtype')
            ->where('tb_mf_carduser_records.is_active', '=', 1)
            ->where('tb_mf_carduser_records.rfid_number','LIKE','%'.$request->search."%")
            ->paginate(1);
        } else {
            $output="";
        }
        if($reload)
        {
            foreach ($reload as $key => $cardlist) {
                $output.='<tr>'.
                '<td class="left">'.$cardlist->rfid_number.'</td>'.
                '<td class="center">'.$cardlist->card_balance.'</td>'.
                '<td class="left">'.$cardlist->first_name.'</td>'.
                '<td class="left"><button class="btn-sm btn-success" data-toggle="modal" data-amount='.$cardlist->card_balance.' data-id='.$cardlist->carduser_id.' data-bal='.$cardlist->card_balance.' data-rfid='.$cardlist->rfid_number.' data-target="#exampleModal"><i class="fa fa-bolt"></i>&nbsp;</button></td>'.
                '</tr>';
        } 
            return Response($output);
    }
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
        $data = $request->all();
        DB::table('tb_tr_card_transactions')
        ->insert([
            'rfid_number'           => $data['id'],    
            'transactiontype_id'    => 2,
            'amount'                => $data['amount2'],
            'updated_by'            => $data['updated_by'],
        ]);

        DB::table('tb_mf_carduser_records')->where('rfid_number', $data['id'])
                                            ->update(['card_balance'=> $data['tot2']]);

        return redirect('cards/cms/teller/reload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardLists  $cardLists
     * @return \Illuminate\Http\Response
     */
    public function show(CardLists $cardLists)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardLists  $cardLists
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardLists  $cardLists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        
    }

    public function holdCard(Request $request)
    {
        $reload = DB::table('tb_mf_carduser_records')->where('carduser_id',$request->id)
                                                    ->update(['is_hold'=>$request->hold]);

        return redirect('cms/teller/reload');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardLists  $cardLists
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardLists $cardLists)
    {
        //
    }

}
