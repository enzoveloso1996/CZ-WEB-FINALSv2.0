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
                                <li><a href="/dashboard">DASHBOARD</a></li>
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
                                   
                                    <form action="" method="post">
                                    <select name="positions" id="positions_id">
                                        <option value="{{$user_id}}">ALL</option>
                                        @foreach ($position as $pos)
                                        <option id="{{$pos->id}}" value="{{$user_id}}">
                                            {{$pos->position}}
                                        </option>
                                        @endforeach
                                    </select>
                                    
                                    </form>
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
                                        <th class="center">Full Name</th>
                                        <th class="center">Company Name</th>
                                        <th class="center">Position</th>
                                        <th class="center">Username</th>
                                        <th class="center">Action</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($userslist as $userlist)
                                    <tr>
                                        <td class="center" id="ref"></td>
                                        <td class="center">{{$userlist->fullname}}</td>
                                        <td class="center">{{$userlist->client_name}}</td>
                                        <td class="center">{{$userlist->position}}</td>
                                        <td class="center">{{$userlist->username}}</td>
                                        <td>
                                            <div class="row">

                                                <div class="col-md-3">
                                                {{-- This is for edit button --}}
                                                

                                                    <button type="button" class="btn-sx btn-success"  data-toggle="modal" data-target="#editModal" 
                                                        data-lastname="{{$userlist->lastname}}"
                                                        data-firstname="{{$userlist->firstname}}"
                                                        data-middlename="{{$userlist->middlename}}"
                                                        data-position_id="{{$userlist->position_id}}"
                                                        data-username="{{$userlist->username}}">
                                                        <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                                    </button>
                                                    <div class="modal fade" id="editModal" role="document">
                                                        <div class="modal-dialog modal-lg">
                                                        
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Update Account</h4>
                                                                </div>              
                                                                <form action="{{Route('clientusers.update', $userlist->user_id)}}" method="post">
                                                                    @csrf
                                                                    
                                                                    <div class="form-group">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Company</span>
                                                                                    </div>
                                                                                    <select class="form-control" name="editclientname" id="editclientname_id">
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
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Username</span>
                                                                                    </div>
                                                                                    <input type="text" name="editusername" id="editusername_id" placeholder="Username" class="form-control">
                                                                                    
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Password</span>
                                                                                    </div>
                                                                                    <input type="password" name="editpassword" id="editpassword_id" placeholder="Password" class="form-control">
                                                                                    
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
                                                <div class="col-md-3">
                                                    {{-- This is for delete button --}}
                                                    <form action="" method="post">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="button" class="btn-sx btn-danger"  data-toggle="modal" data-target="#deleteModal" 
                                                            data-fullname="{{$userlist->fullname}}" 
                                                            data-client_id="{{$userlist->user_id}}">
                                                            <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                        </button>
                                                        <div class="modal fade" id="deleteModal" role="dialog">
                                                            <div class="modal-dialog modal-md">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Delete {{$userlist->fullname}}</h4>
                                                                    </div>
                                                                    <input type="hidden" name="delclient_id" id="delclient_id" value="{{$userlist->user_id}}">                                                                
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

                                </tbody>
                            </table>
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
                    <h4 class="modal-title">Add User Account</h4>
                </div>
                <form action="{{Route('clientusers.store')}}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Company</span>
                                    </div>
                                    <select class="form-control" name="clientname" id="clientname_id">
                                        <option value="--">--</option>
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
                                        <option value="--">--</option>
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
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Username</span>
                                    </div>
                                    <input type="text" name="username" id="username_id" placeholder="Username" class="form-control">
                                 
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Password</span>
                                    </div>
                                    <input type="password" name="password" id="password_id" placeholder="Password" class="form-control">
                                  
                                </div>      
                                {{-- <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Retype Password</span>
                                    </div>
                                    <input type="password" name="password2" id="password_id2" placeholder="Retype Password" class="form-control">
                                    
                                </div>       --}}

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


    

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    
    
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    
      
        $(document).ready(function(){
            
            $('#clientname_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#client_id_').val(idval);
            });

            
            $('#position_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#position_id_').val(idval);
            });


            $("#positions_id").change(function(){
                
                var positions = $(this).children(":selected").attr("id");
                var client_ids = $(this).children(":selected").attr("value");
                console.log(client_ids);
                console.log(positions);
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('company/combo-search-position')}}',
                    data:{  'position':positions,
                            'client_id':client_ids },
                    success: function(data){
                        console.log(data);

                        $('tbody').html(data);
                    },
                    error: function(data){
                        console.log(data);
                        console.log($.ajax());
                    }
                });

            });
        });
       
        $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        
        var lastname = button.data('lastname');
        var firstname = button.data('firstname'); 
        var middlename = button.data('middlename');
        var position_id = button.data('position_id');
        var username = button.data('username');
      
 
        var modal = $(this);
        modal.find('.modal-title').text('Are you sure to Edit ' + username +'?');
        
        modal.find('#editlastname').val(lastname);
        modal.find('#editfirstname').val(firstname);
        modal.find('#editmiddlename').val(middlename);
        modal.find('#editposition_id').val(position_id);
        modal.find('#editusername').val(username);
        
    })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
  

@endsection




