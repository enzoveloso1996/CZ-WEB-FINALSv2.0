@extends('cms.layout')
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
                                <li><a href="#">E-JEEP</a></li>
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
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="search-user" placeholder="Search.." aria-label="search" aria-describedby="basic-addon1">
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
        $('#search-user').on('keyup',function(){
            $value=$(this).val();
            console.log($value);
            $.ajax({
                type : 'get',
                url : '{{URL::to('jeeps/search-user')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                },
                error: function(data) {console.log("error!!");}
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

        });
       
    </script>


@endsection




