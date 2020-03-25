@extends('crm.company.layout')
<style>
    table {
        counter-reset: rowNumber;
    }
    #ref {
        counter-increment: rowNumber;
    }
    #ref::before {
        content: counter(rowNumber);
        min-width: 1em;
        margin-right: 0.5em;
    }
</style>
@section('content')
 
 <!-- Breadcrumbs-->
 <div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Jeep List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="/dashboard">DASHBOARD</a></li>
                            @foreach ($clientname as $client)
                            <li><a href="#">{{$client->client_name}}</a></li>                                    
                            @endforeach
                            <li class="active">E-Jeep List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.breadcrumbs-->
    <div class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><?php echo trim($jeepcount,"[]"); ?></div>
                                <div class="stat-heading">Registered E-Jeeps</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="animated fadeIn">

        <div class="card">
            <div class="card-header">
                <h4>Jeeps</h4>
            </div>
            <div class="card-header">
                <div class="float-left p-3">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" id="searchLoad" placeholder="Search jeep.." aria-label="search" aria-describedby="basic-addon1">
                </div>
                </div>
                <div class="float-right p-3">
                    <button type="submit" value="Edit" class="btn-sx btn-primary"  data-toggle="modal" data-target="#addModal" ><i class="fa fa-plus-square"></i>&nbsp; Add New Jeep to List</button>
                </div>
            </div>
        </div>
            </div>
            <div class="card-body">
                <div class="custom-tab">

                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="custom-nav-active" role="tabpanel" aria-labelledby="custom-nav-active-tab">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center"></th>
                                        <th class="center">PLATE NUMBER</th>
                                        <th class="center">COMPANY NAME</th>
                                        <th class="center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jeeplists as $jeeplist)
                                                               
                                    <tr>
                                        <td class="center" id="ref"></td>
                                        <td class="center">{{$jeeplist->plate_number}}</td>
                                        <td class="left">{{$jeeplist->client_name}}</td>
                                        <td class="center">
                                            <div class="row">
                                                
                                                <div class="col-md-3">
                                                    <!-- Edit Button -->
                                                    <form action="" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="btn-sx btn-success"  data-toggle="modal" data-target="#editModal" 
                                                            >
                                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                                        </button>
                                                        <div class="modal fade" id="editModal" role="document">
                                                            <div class="modal-dialog modal-lg">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Update {{$jeeplist->client_name}}</h4>
                                                                    </div>              
                                                                    <input type="hidden" name="client_id" id="client_id">                                                                                                     
                                                                    <div class="form-group">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Name</span>
                                                                                    </div>
                                                                                    <input type="text"class="form-control" name="client_name" id="client_name" placeholder="Client Name" aria-label="Client Name" aria-describedby="basic-addon1">
                                                                                </div>    
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        <div class="modal-footer"> 
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                                        </div>                                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  

                                                    </form>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Delete Button -->
                                                    <form action="{{route('client-jeep-archive', $user_id)}}" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="btn-sx btn-danger"  data-toggle="modal" data-target="#deleteModal"
                                                            data-delclient_id="{{$jeeplist->client_id}}" 
                                                            data-deljeep_id="{{$jeeplist->jeep_id}}"
                                                            data-delplate_number="{{$jeeplist->plate_number}}">
                                                            <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                        </button>
                                                        
                                                        <div class="modal fade" id="deleteModal" role="dialog">
                                                            <div class="modal-dialog modal-md">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Delete {{$jeeplist->plate_number}}</h4>
                                                                    </div>
                                                                    <input type="text" name="deljeep_id" id="deljeep_id" value="{{$jeeplist->jeep_id}}">                                                                
                                                                    <div class="form-group">
                                                                        <div class="modal-body">
                                                                            Are you sure to Delete?
                                                                            
                                                                        </div>
                                                                        <div class="modal-footer"> 
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                                        </div>                                                              
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{$jeeplists->links()}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>


    <!-- add modal -->
    <div class="modal fade" id="addModal" role="document">
        <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Jeep to List</h4>
                </div>
                <form action="" method="post">
                    @csrf
         
                    <div class="form-group">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Company</span>
                                    </div>
                                    <select class="form-control" name="clientname" id="clientname_id">
                                        {{-- <option value="--">--</option> --}}
                                        @foreach ($clientname as $client)
                                        <option id="{{$client->client_id}}">
                                            {{$client->client_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="client_idtext" id="client_id_" value="">
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Plate Number</span>
                                    </div>
                                    <input type="text" name="platenumber" id="platenumber_id" placeholder="Plate Number" class="form-control">                           
                                </div>    
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>    
                    
                    </div>
                </form>
            </div>
        </div>

</div><!-- .content -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#companylist").change(function(){
            var client = $(this).children(":selected").attr("id");
            console.log(client);
            $.ajax({
                type: 'get',
                url: '{{URL::to('jeeps/combo-search-jeep')}}',
                data:{'combosearch':client},
                success: function(data){
                    console.log(client);

                    $('tbody').html(data);
                },
                error: function(data){
                    console.log(data);
                    console.log($.ajax());
                }
            });
        });
    });
</script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var jeep_id = button.data('deljeep_id'); 
        var client_id = button.data('delclient_id');
        var plate_number = button.data('delplate_number');

        console.log(jeep_id);
        console.log(client_id);
        console.log(plate_number);

        var modal = $(this);
        modal.find('.modal-title').text('Delete ' + plate_number +'?');
        modal.find('.modal-body').text('Are you sure to delete E-jeep with ' + plate_number +' Plate Number?');
        modal.find('#client_id').val(client_id);
    })
</script>

<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);

        var client_name = button.data('client_name'); 
        var client_id = button.data('client_id');
        var client_email = button.data('client_email'); 
        var client_address = button.data('client_address');
        var contact_person = button.data('contact_person');
        var contact_number = button.data('contact_number');
        var keyword = button.data('keyword');
 
        var modal = $(this);
        modal.find('.modal-title').text('Are you sure to delete ' + client_name +'?');
        modal.find('#client_id').val(client_id);
        modal.find('#client_email').val(client_email);
        modal.find('#client_address').val(client_address);
        modal.find('#contact_person').val(contact_person);
        modal.find('#contact_number').val(contact_number);
        modal.find('#client_name').val(client_name);
        modal.find('#keyword').val(keyword);
        
    })
</script>
@endsection