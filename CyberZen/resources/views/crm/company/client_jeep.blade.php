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
                    <input type="text" class="form-control" id="search-jeep" placeholder="Search jeep.." aria-label="search" aria-describedby="basic-addon1">
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
                                                            data-editplatenumber = "{{$jeeplist->plate_number}}">
                                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                                        </button>
                                                        <div class="modal fade" id="editModal" role="document">
                                                            <div class="modal-dialog modal-lg">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Edit Ejeep Details</h4>
                                                                    </div>              
                                                                                                                                                                    
                                                                    <div class="form-group">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="edituser_id" id="edituser_id" value={{$user_id}}>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Company</span>
                                                                                    </div>
                                                                                    <select class="form-control" name="editclientname" id="editclientname_id">
                                                                                        {{-- <option value="--">--</option> --}}
                                                                                        @foreach ($clientname as $client)
                                                                                        <option id="{{$client->client_id}}">
                                                                                            {{$client->client_name}}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <input type="hidden" name="editclient_idtext" id="editclient_id_" value="">
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Plate Number</span>
                                                                                    </div>
                                                                                    <input type="text" name="editplatenumber" id="editplatenumber_id" placeholder="Plate Number" class="form-control">                           
                                                                                </div>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer"> 
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                                                            data-delplatenumber="{{$jeeplist->plate_number}}">
                                                            <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                        </button>
                                                        
                                                        <div class="modal fade" id="deleteModal" role="document">
                                                            <div class="modal-dialog modal-md">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <input type="hidden" name="deluser_id" id="deluser_id" value={{$user_id}}>

                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Delete Ejeep</h4>
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
                <form action="{{Route('clientjeeplist.store')}}" method="post">
                    @csrf
         
                    <div class="form-group">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="adduser_id" id="adduser_id" value={{$user_id}}>

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

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>

  
    $(document).ready(function(){
        $("#clientname_id option[id="+{{$client->client_id}}+"]").attr('selected', 'selected');
        
        $('#client_id_').val({{$client->client_id}});

        $('#clientname_id').change(function(){
            
            var idval = $(this).children(":selected").attr("id");
            console.log(idval);
            $('#client_id_').val(idval);
        });

        $("#editclientname_id option[id="+{{$client->client_id}}+"]").attr('selected', 'selected');
        
        $('#editclient_id_').val({{$client->client_id}});

        $('#editclientname_id').change(function(){
            
            var idval = $(this).children(":selected").attr("id");
            console.log(idval);
            $('#editclient_id_').val(idval);
        });
        
        

        $("#search-jeep").on('keyup',function(){
            
            $value = $(this).val();
            var user_id = button.data('edituser_id')
            console.log($value);
            console.log($cur_user_id);
            $.ajax({
                type : 'get',
                url : '{{URL::to('company/search-jeep')}}',
                data:{  'search':$value,
                        'cur_user_id':user_id
                        },
                success:function(data){
                    $('tbody').html(data);
                },
                error: function(data) {console.log("error!!");}
            });

        });
    });
   
   
</script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    <script>
        $(document).ready(function(){
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var platenumber = button.data('editplatenumber');
                var user_id = $('#edituser_id').val();
                console.log(platenumber);
                console.log(user_id);

                var modal = $(this);
                $('#editplatenumber_id').val(platenumber);    
                modal.find('.modal-title').text('Are you sure to Edit ejeep with plate number ' + platenumber +'?');
            });
    
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var delplatenumber = button.data('delplatenumber'); 
                var deluser_id = $('#deluser_id').val();
                var deljeep_id = button.data('deljeep_id');
            
                console.log(delplatenumber);
                console.log(deluser_id);
                console.log(deljeep_id);
                $('#deljeep_id').val(deljeep_id);
                modal.find('.modal-body').text('Are you sure to delete EJeep with Plate number ' + delplatenumber +'?');
         
            });
    
        });
    </script>
    <script>
        $(document).ready(function(){

        })
    </script>
@endsection