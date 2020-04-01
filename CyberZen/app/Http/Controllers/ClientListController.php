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
                foreach ($tabledtl as $detail) 
                {
                    $output.=
                            '<tr>'.
                                '<td class="center" id="ref"></td>'.
                                '<td class="left">'.$detail->client_name.'</td>'.
                                '<td class="center">'.$detail->contact_number.'</td>'.
                                '<td class="left">'.$detail->client_email.'</td>'.
                                '<td class="center">'.
                                    '<div class="row">'.

                                        '<div class="col-md-5">'.
                                            '<form action="'.route("clientlist.update", $detail->client_id).'" method="post">'.
                                                '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                                                '<input type="hidden" name="_method" value="PATCH">'.

                                                '<input type="hidden" name="user_id" value="'.$request->user_id.'">'.

                                                '<button type="button" class="btn-sx btn-success"  data-toggle="modal" data-target="#editModal"'. 
                                                    'data-client_name="'.$detail->client_name.'"'. 
                                                    'data-client_id="'.$detail->client_id.'"'.
                                                    'data-contact_person="'.$detail->contact_person.'"'.
                                                    'data-contact_number="'.$detail->contact_number.'"'.
                                                    'data-client_address="'.$detail->client_address.'"'.
                                                    'data-keyword="'.$detail->keyword.'"'.
                                                    'data-client_email = "'.$detail->client_email.'">'.
                                                    '<i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>'.
                                                '</button>'.
                                                '<div class="modal fade" id="editModal" role="document">'.
                                                    '<div class="modal-dialog modal-lg">'.
                                                    
                                                        '<div class="modal-content">'.
                                                            '<div class="modal-header">'.
                                                                '<button type="button" class="close" data-dismiss="modal">&times;</button>'.
                                                                '<h4 class="modal-title">Update '.$detail->client_name.'</h4>'.
                                                            '</div>'.              
                                                            '<input type="hidden" name="client_id" id="client_id">'.
                                                            '<div class="form-group">'.
                                                                '<div class="modal-body">'.
                                                                    '<div class="form-group">'.
                                                                        '<div class="input-group mb-3">'.
                                                                            '<div class="input-group-prepend">'.
                                                                                '<span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Name</span>'.
                                                                            '</div>'.
                                                                            '<input type="text"class="form-control" name="client_name" id="client_name" placeholder="Client Name" aria-label="Client Name" aria-describedby="basic-addon1">'.
                                                                        '</div>'.    
                                                                        '<div class="input-group mb-3">'.
                                                                            '<div class="input-group-prepend">'.
                                                                                '<span class="input-group-text" id="basic-addon1" style="width: 200px;">Contact Person</span>'.
                                                                            '</div>'.
                                                                            '<input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person" aria-label="Contact Person" aria-describedby="basic-addon1">'.
                                                                        '</div>'.
                                                                        '<div class="input-group mb-3">'.
                                                                            '<div class="input-group-prepend">'.
                                                                                '<span class="input-group-text" id="basic-addon1" style="width: 200px;">Contact Number</span>'.
                                                                            '</div>'.
                                                                            '<input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" aria-label="Contact Number" aria-describedby="basic-addon1">'.
                                                                        '</div>'.
                                                                        '<div class="input-group mb-3">'.
                                                                            '<div class="input-group-prepend">'.
                                                                                '<span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Address</span>'.
                                                                            '</div>'.
                                                                            '<textarea class="form-control text-left" name="client_address" id="client_address" placeholder="Client Address" aria-label="Client Address" aria-describedby="basic-addon1">'.
                                                                                
                                                                            '</textarea>'.
                                                                        '</div>'.
                                                                        '<div class="input-group mb-3">'.
                                                                            '<div class="input-group-prepend">'.
                                                                                '<span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Email Address</span>'.
                                                                            '</div>'.
                                                                            '<input type="text" class="form-control" name="client_email" id="client_email" placeholder="Client Email Address" aria-label="Client Email Address" aria-describedby="basic-addon1">'.
                                                                        '</div>'.
                                                                    '</div>'.
                                                                    
                                                                '</div>'.
                                                                '<div class="modal-footer">'.
                                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'.
                                                                    '<button type="submit" class="btn btn-primary">Yes</button>'.
                                                                '</div>'.
                                                            '</div>'.
                                                        '</div>'.
                                                    '</div>'.
                                                '</div>'.
                                            '</form>'.
                                        '</div>'.
                                        '<div class="col-md-5">'.
                                            '<form action="'.route("client-archive").'" method="post">'.
                                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                                            '<input type="hidden" name="_method" value="PATCH">'.
                                            '<input type="hidden" name="user_id" value="'.$request->user_id.'">'.
                                                '<button type="button" class="btn-sx btn-danger"  data-toggle="modal" data-target="#deleteModal"'.
                                                    'data-client_name="'.$detail->client_name.'"'.
                                                    'data-client_id="'.$detail->client_id.'">'.
                                                    '<i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>'.
                                                '</button>'.
                                                '<div class="modal fade" id="deleteModal" role="dialog">'.
                                                    '<div class="modal-dialog modal-md">'.
                                                        '<div class="modal-content">'.
                                                            '<div class="modal-header">'.
                                                                '<button type="button" class="close" data-dismiss="modal">&times;</button>'.
                                                                '<h4 class="modal-title">Delete '.$detail->client_name.'</h4>'.
                                                            '</div>'.
                                                            '<input type="hidden" name="client_id" id="client_id" value="'.$detail->client_id.'">'.
                                                            '<div class="form-group">'.
                                                                '<div class="modal-body">'.
                                                                    'Are you sure to Delete?'.
                                                                '</div>'.
                                                                '<div class="modal-footer"> '.
                                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'.
                                                                    '<button type="submit" class="btn btn-primary">Yes</button>'.
                                                                '</div>'.
                                                            '</div>'.
                                                        '</div>'.
                                                    '</div>'.
                                                '</div>'.
                                            '</form>'.
                                        '</div>'.
                                    '</div>'.
                                '</td>'.
                            '</tr>'.
                            '<script>'.
                                '$("#deleteModal").on("show.bs.modal", function (event) {'.
                                    'var button = $(event.relatedTarget);'.

                                    'var client_name = button.data("client_name");'.
                                    'var client_id = button.data("client_id");'.
                                    'var modal = $(this);'.

                                    'modal.find(".modal-title").text("Delete " + client_name +"?");'.
                                    'modal.find(".modal-body").text("Are you sure to delete " + client_name +"?");'.
                                    'modal.find("#client_id").val(client_id);'.
                                '});'.
                            '</script>'.

                            '<script>'.
                                '$("#editModal").on("show.bs.modal", function (event) {'.
                                    'var button = $(event.relatedTarget);'.

                                    'var client_name = button.data("client_name"); '.
                                    'var client_id = button.data("client_id");'.
                                    'var client_email = button.data("client_email"); '.
                                    'var client_address = button.data("client_address");'.
                                    'var contact_person = button.data("contact_person");'.
                                    'var contact_number = button.data("contact_number");'.
                            
                                    'var modal = $(this);'.
                                    'modal.find(".modal-title").text("Are you sure to Edit " + client_name +"?");'.
                                    'modal.find("#client_id").val(client_id);'.
                                    'modal.find("#client_email").val(client_email);'.
                                    'modal.find("#client_address").val(client_address);'.
                                    'modal.find("#contact_person").val(contact_person);'.
                                    'modal.find("#contact_number").val(contact_number);'.
                                    'modal.find("#client_name").val(client_name);'.                               
                                '});'.
                            '</script>';

                    // $output.='<tr>'.
                    // '<td class="center" id="ref"></td>'.
                    // '<td class="left">'.$tabledtll->client_name.'</td>'.
                    // '<td class="center">'.$tabledtll->contact_number.'</td>'.
                    // '<td class="left">'.$tabledtll->client_email.'</td>'.
                    // '<td class="center"><button type="submit" value="Edit" class="btn-sx btn-primary"><i class="fa fa-edit"></i>&nbsp; Edit</button>'.
                    // '<button type="submit" value="Delete" class="btn-sx btn-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button></td>'.
                    // '</tr>';
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
        $unavailable = DB::table('tb_mf_client')
        ->where('client_name', '=', $request->client_name)
        ->get();

        foreach ($unavailable as $avail) {
            $client = $avail->client_name;
        }
        if (empty($request->client_name) or empty($request->contact_person) or empty($request->contact_number) or empty($request->client_address) or empty($request->client_email)) {
            return redirect("jeeps/cms/admin/clientlist/$request->user_id")->with('status-alert', "Please complete details");

        }
        

        if (empty($client)) {
            DB::table('tb_mf_client')
            ->insert([
                'client_name'       =>  $request->client_name,
                'contact_person'    =>  $request->contact_person,
                'contact_number'    =>  $request->contact_number,
                'client_address'    =>  $request->client_address,
                'client_email'      =>  $request->client_email
            
            ]);
            
            DB::table('tb_users_log')
            ->insert([
                'user_id'       =>  $request->user_id,
                'action_id'     =>  1,
                'remarks'       => 'Add Client '.$request->client_name
            ]);
    
            return redirect("jeeps/cms/admin/clientlist/$request->user_id")->with('status', "Client is successfully registered!!");
                
        }
        return redirect("jeeps/cms/admin/clientlist/$request->user_id")->with('status-alert', "Client is already registered!!");
        
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
            'action_id'     =>  3,
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
            'action_id'     =>  2,
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
