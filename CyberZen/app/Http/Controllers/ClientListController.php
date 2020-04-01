<?php

namespace App\Http\Controllers;

use App\ClientLists;
use Illuminate\Http\Request;
use DB;

class ClientListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {   
        $tabledtl = DB::table('tb_mf_client')
        ->select('client_id', 'client_name','contact_person', 'contact_number','client_address', 'client_email', 'keyword')
        ->where('is_archived','=',0)
        ->paginate(5);

        $clientcount = DB::table('tb_mf_client')
        ->select(DB::raw("COUNT(client_name) as count"))
        ->where('is_archived','=',0)
        ->get()->toarray();
        
        $clientcount = array_column($clientcount,'count');

        $jeepcount = DB::table('tb_mf_jeep')
        ->select(DB::raw("COUNT(plate_number) as count"))
        ->where('is_archived','=',0)
        ->get()->toarray();

        $jeepcount = array_column($jeepcount,'count');

        return view("cms/admin/clientlist")->with('user_id', $user_id)
                                ->with('tabledtl', $tabledtl)
                                ->with('jeepcount', json_encode($jeepcount, JSON_NUMERIC_CHECK))
                                ->with('clientcount', json_encode($clientcount, JSON_NUMERIC_CHECK));
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";

            $tabledtl=DB::table('tb_mf_client')->where('client_name','LIKE','%'.$request->search."%")
            ->where('is_archived','=',0)
            ->get();
    
            if($tabledtl)
            {
                foreach ($tabledtl as $key => $tabledtll) 
                {
                    $output.='<tr>'.
                    '<td class="center" id="ref"></td>'.
                    '<td class="left">'.$tabledtll->client_name.'</td>'.
                    '<td class="center">'.$tabledtll->contact_number.'</td>'.
                    '<td class="left">'.$tabledtll->client_email.'</td>'.
                    '<td class="center"><button type="submit" value="Edit" class="btn-sx btn-primary"><i class="fa fa-edit"></i>&nbsp; Edit</button>'.
                    '<button type="submit" value="Delete" class="btn-sx btn-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button></td>'.
                    '</tr>';
                } 
                return Response($output);
            }
            
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
        $this->validate($request, [
            'client_name'       =>  'required|max:255',
            'contact_person'    =>  'required',
            'contact_number'    =>  'required',
            'client_address'    =>  'required',
            'client_email'      =>  'required',
            'keyword'           =>  'required|max:50'
        ]);

        DB::table('tb_mf_client')
        ->insert([
            'client_name'       =>  $request->client_name,
            'contact_person'    =>  $request->contact_person,
            'contact_number'    =>  $request->contact_number,
            'client_address'    =>  $request->client_address,
            'client_email'      =>  $request->client_email,
            'keyword'           =>  $request->keyword
        ]);
        
        DB::table('tb_users_log')
        ->insert([
            'user_id'       =>  $request->user_id,
            'action_id'     =>  1,
            'remarks'       => 'Add Client '.$request->client_name
        ]);

        return redirect("jeeps/cms/admin/clientlist/$request->user_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientLists  $clientLists
     * @return \Illuminate\Http\Response
     */
    public function show(ClientLists $clientLists)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientLists  $clientLists
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientLists $clientLists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientLists  $clientLists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client_id)
    {
        DB::table('tb_mf_client')
        ->where('client_id', $request->client_id)
        ->update([
            'client_name'       =>  $request->client_name,
            'contact_person'    =>  $request->contact_person,
            'contact_number'    =>  $request->contact_number,
            'client_address'    =>  $request->client_address,
            'client_email'      =>  $request->client_email,
          
        ]);

        DB::table('tb_users_log')
        ->insert([
            'user_id'       =>  $request->user_id,
            'action_id'     =>  1,
            'remarks'       => 'Edit Client '.$request->client_name
        ]);


        return redirect("jeeps/cms/admin/clientlist/$request->user_id");
    }

    public function archive(Request $request){
        DB::table('tb_mf_client')
        ->where('client_id', $request->client_id)
        ->update(['is_archived' => 1]);

        $client_name = DB::table('tb_mf_client')
        ->where('client_id', '=', $request->client_id)
        ->get();

        foreach ($client_name as $clientname) {
            $client_name = $clientname->client_name;
        }

        DB::table('tb_users_log')
        ->insert([
            'user_id'       =>  $request->user_id,
            'action_id'     =>  1,
            'remarks'       => 'Archived Client '.$client_name
        ]);

        return redirect("jeeps/cms/admin/clientlist/$request->user_id");
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientLists  $clientLists
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {
        
    }
}
