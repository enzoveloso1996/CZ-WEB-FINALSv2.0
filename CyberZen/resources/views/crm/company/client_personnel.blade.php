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
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

    <!-- Breadcrumbs-->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Client User Accounts</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="/dashboard/{{$user_id}}">DASHBOARD</a></li>
                                @foreach ($clientname as $client)
                                <li><a href="#">{{$client->client_name}}</a></li>                                    
                                @endforeach
                                <li class="active">Client User Accounts</li>
                            </ol>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- /.breadcrumbs-->

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <strong class="card-title">Client User Accounts</strong>
                        </div>
                        <div class="container">
                            <div class="float-left p-3">
                                <div class="input-group">
                                   
                                    
                                    {{-- <select name="search-position" id="search-position_id">
                                        <option id="0" value="{{$user_id}}">ALL</option>
                                        @foreach ($position as $pos)
                                        <option id="{{$pos->id}}" value="{{$user_id}}">
                                            {{$pos->position}}
                                        </option>
                                        @endforeach
                                    </select> --}}
                                    
                                   
                                </div>
                            </div>
                            <div class="float-right p-3">
                                <button type="submit" value="Edit" class="btn-sx btn-primary"  data-toggle="modal" data-target="#addModal" ><i class="fa fa-plus-square"></i>&nbsp; Add New User Account</button>
                            </div>
    
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center"></th>
                                        <th class="center">RFID Number</th>
                                        <th class="center">Full Name</th>
                                        <th class="center">Company</th>
                                        <th class="center">Position</th>
                                        <th class="center">Action</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($personnels as $personnel)
                                    <tr>
                                        <td class="center" id="ref"></td>
                                        <td class="center">{{$personnel->rfid_number}}</td>
                                        <td class="center">{{$personnel->fullname}}</td>
                                        <td class="center">{{$personnel->client_name}}</td>
                                        <td class="center">{{$personnel->position}}</td>
                                        <td>
                                      
                                            <div class="row">

                                                <div class="col-md-5">
                                                {{-- This is for edit button --}}

                                                    <button type="button" class="btn-sx btn-success"  data-toggle="modal" data-target="#editModal" 
                                                        data-editlastname="{{$personnel->lastname}}"
                                                        data-editfirstname="{{$personnel->firstname}}"
                                                        data-editmiddlename="{{$personnel->middlename}}"
                                                        data-editposition_id="{{$personnel->position_id}}"
                                                        data-editclient_id ="{{$personnel->client_id}}"
                                                        data-editrfidnumber ="{{$personnel->rfid_number}}"
                                                        data-editfullname ="{{$personnel->fullname}}"
                                                        data-editpersonnel_id ="{{$personnel->id}}"
                                                        >
                                                        <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                                    </button>
                                                    <div class="modal fade" id="editModal" role="document">
                                                        <div class="modal-dialog modal-lg">
                                                        
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Update Employee Details</h4>
                                                                </div>    
                                                                      
                                                                <form action="{{Route('clientpersonnel.update', $user_id)}}" method="post">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <div class="input-group mb-3">
                                                                                    <input type="hidden" name="editcurrent_user_id" id="editcurrent_user_id" value="{{$user_id}}">                                                                
                                                                                    <input type="hidden" name="editpersonnel_id" id="editpersonnel_id">                                                                
                                                                                                                        
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Company</span>
                                                                                    </div>
                                                                                    <select class="form-control" name="editclientname" id="editclientname_id">                           
                                                                                        @foreach ($clientname as $client)
                                                                                        <option id="{{$client->client_id}}" value="{{$client->client_id}}" >
                                                                                            {{$client->client_name}}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <input type="hidden" name="editclient_idtext" id="editclient_id_" value="">
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">First Name</span>
                                                                                    </div>
                                                                                    <input type="text" name="editfirstname" id="editfirstname_id" placeholder="First Name" class="form-control">                                    
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Middle Name</span>
                                                                                    </div>
                                                                                    <input type="text" name="editmiddlename" id="editmiddlename_id" placeholder="Middle Name" class="form-control">                                    
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Last Name</span>
                                                                                    </div>
                                                                                    <input type="text" name="editlastname" id="editlastname_id" placeholder="Last Name" class="form-control">                                    
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Position</span>
                                                                                    </div>
                                                                                    <select class="form-control" name="editposition" id="editposition_id">
                                                                                        <option id="0">SELECT POSITION</option>                                        
                                                                                        @foreach ($position as $pos)
                                                                                        <option id="{{$pos->id}}">
                                                                                            {{$pos->position}}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <input type="hidden" name="editposition_idtext" id="editposition_id_" value="">
                                                                                </div>    
                                                
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">RFID Number</span>
                                                                                    </div>
                                                                                    <input type="text" name="editrfid_number" id="editrfid_number_id" placeholder="RFID Number" class="form-control">                                 
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
                                                    </div> 
                                                </div>         
                                                                             
                                                <div class="col-md-5">
                                                {{-- This is for delete button --}}
                                                
                                                        
                                                    <button type="button" class="btn-sx btn-danger"  data-toggle="modal" data-target="#deleteModal" 
                                                        data-delfullname="{{$personnel->fullname}}" 
                                                        data-deluser_id="{{$personnel->user_id}}" 
                                                        data-delpersonnel_id="{{$personnel->id}}">
                                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                    </button>
                                                    
                                                    <div class="modal fade" id="deleteModal" role="document">
                                                        <div class="modal-dialog modal-md">
                                                            
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Delete Personnel</h4>
                                                                </div>
                                                                
                                                                <form action="{{Route('client-personnel-archive')}}" method="post">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group">
                                                                        <input type="text" name="delcurrent_user_id" id="delcurrent_user_id" value="{{$user_id}}">                                                                
                                                                        <input type="text" name="delpersonnel_id" id="delpersonnel_id">                                                                
                                                                        <input type="text" name="deluser_id" id="deluser_id">                                                                
                                                                        
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
                                {{$personnels->links()}}
                                </tbody>
                            </table>
                            {{$personnels->links()}}
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

  



    <div class="modal fade" id="addModal" role="document">
        <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Personnel</h4>
                </div>
                <form action="{{Route('clientpersonnel.store')}}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="addcurrent_user_id" id="addcurrent_user_id" value="{{$user_id}}">                                                                
                                                                        
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Company</span>
                                    </div>
                                    <select class="form-control" name="clientname" id="clientname_id">                           
                                        @foreach ($clientname as $client)
                                        <option id="{{$client->client_id}}" value="{{$client->client_id}}" >
                                            {{$client->client_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="client_idtext" id="client_id_" value="">
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">First Name</span>
                                    </div>
                                    <input type="text" name="firstname" id="firstname_id" placeholder="First Name" class="form-control">                                    
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Middle Name</span>
                                    </div>
                                    <input type="text" name="middlename" id="middlename_id" placeholder="Middle Name" class="form-control">                                    
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Last Name</span>
                                    </div>
                                    <input type="text" name="lastname" id="lastname_id" placeholder="Last Name" class="form-control">                                    
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Position</span>
                                    </div>
                                    <select class="form-control" name="position" id="position_id">
                                        <option id="0">SELECT POSITION</option>                                        
                                        @foreach ($position as $pos)
                                        <option id="{{$pos->id}}">
                                            {{$pos->position}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="position_idtext" id="position_id_" value="">
                                </div>    

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">RFID Number</span>
                                    </div>
                                    <input type="text" name="rfid_number" id="rfid_number_id" placeholder="RFID Number" class="form-control">                                 
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
    </div>   


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    
      
        $(document).ready(function(){
            $("#clientname_id option[id="+{{$client->client_id}}+"]").attr('selected', 'selected');
            
            $('#client_id_').val({{$client->client_id}})
            $('#clientname_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#client_id_').val(idval);
            });

            $('#editclientname_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#editclient_id_').val(idval);
            });
            
            $('#position_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#position_id_').val(idval);
            });

            $('#editposition_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#editposition_id_').val(idval);
            });

            $("#search-position_id").change(function(){
                
                var position_id = $(this).children(":selected").attr("id");
                var user_id = $(this).children(":selected").attr("value");
                console.log(user_id);
                console.log(position_id);
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('company/combo-search-position')}}',
                    data:{  'position_id':position_id,
                            'user_id':user_id 
                            },
                    success: function(data){
                        console.log(data);

                        $('tbody').html(data);
                    },
                    error: function(data){
                        console.log(data);
                        console.log("error!!");
                    }
                });

            });
        });
       
       
    </script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    <script>
        $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var user_id = button.data('edituser_id')
        var lastname = button.data('editlastname');
        var firstname = button.data('editfirstname'); 
        var middlename = button.data('editmiddlename');
        var position_id = button.data('editposition_id');
        var client_id = button.data('editclient_id');
        var rfidnumber = button.data('editrfidnumber');
        var fullname = button.data('editfullname');
        var personnel_id = button.data('editpersonnel_id');

        console.log(user_id);
        console.log(lastname);
        console.log(firstname);
        console.log(middlename);
        console.log(position_id);
        console.log(client_id);
        console.log(rfidnumber);
        console.log(fullname);
        console.log(personnel_id);

        var modal = $(this);
        console.log(modal);
        $(document).ready(function(){
            $('#edituser_id_').val(user_id);
            $('#editclient_id_').val(client_id);
            $('#editclientname_id').val(client_id);
            $("#editclientname_id option[id="+client_id+"]").attr('selected', 'selected');

            $('#editfirstname_id').val(firstname);
            $('#editmiddlename_id').val(middlename);
            $('#editlastname_id').val(lastname);
            $('#editposition_id_').val(position_id);
            $("#editposition_id option[id="+position_id+"]").attr('selected', 'selected');

            $('#editrfidnumber').val(rfidnumber);
            $('#editpersonnel_id').val(personnel_id);

        });
        
        
        modal.find('.modal-title').text('Are you sure to Edit ' + fullname +'?');
        // modal.find('.modal-body').text('Are you sure to edit user for ' + username +'?');
        // modal.find('#editlastname').val(lastname);
        // modal.find('#editfirstname').val(firstname);
        // modal.find('#editmiddlename').val(middlename);
        // modal.find('#editposition_id').val(position_id);
        // modal.find('#editusername').val(username);
    
        });
    </script>
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var delfullname = button.data('delfullname'); 
            var deluser_id = button.data('deluser_id');
            var delpersonnel_id = button.data('delpersonnel_id');
          
           
            console.log(delfullname);
            console.log(deluser_id);
            console.log(delpersonnel_id);

            var modal = $(this);
            $(document).ready(function(){
                // $('#deluser_id').val(deluser_id);
             });
            modal.find('.modal-body').text('Are you sure to delete user for ' + delfullname +'?');
            modal.find('#deluser_id').val(deluser_id);
            modal.find('#delpersonnel_id').val(delpersonnel_id);
        })
    </script>
    
    <script type="text/javascript">
        $('#search-client').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('company/combo-search-position')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    
    
    
    

   
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
  

@endsection




