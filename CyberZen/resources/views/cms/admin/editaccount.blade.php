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
                                <li><a href="#">E-JEEP</a></li>
                                <li class="active">Edit User Accounts</li>
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
                            <strong class="card-title">User Accounts</strong>
                        </div>
                        <div class="container">
                            <div class="float-right p-3">
                                <button type="submit" value="Edit" class="btn-sx btn-primary"  data-toggle="modal" data-target="#editpwModal" ><i class="fa fa-plus-square"></i>&nbsp; Change Password</button>
                            </div>
    
                        </div>
                      
                        <div class="card-body">
                            <form action="{{Route('admin-editaccount')}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{$user_id}}">
                                <input type="hidden" name="access_level" value="{{$access_level}}">

                                <div class="form-group">
                                    @foreach ($userslists as $userlist)
                                        
                                    @endforeach
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="width: 200px;">First Name</span>
                                        </div>
                                        <input type="text" name="firstname" id="firstname_id" placeholder="First Name" class="form-control" value="{{$userlist->firstname}}">
                                    </div>    
    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="width: 200px;">Middle Name</span>
                                        </div>
                                        <input type="text" name="middlename" id="middlename_id" placeholder="Middle Name" class="form-control" value="{{$userlist->middlename}}">
                                    </div>    
    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="width: 200px;">Last Name</span>
                                        </div>
                                        <input type="text" name="lastname" id="lastname_id" placeholder="Last Name" class="form-control" value="{{$userlist->lastname}}">
                                    </div>    
    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="width: 200px;">Username</span>
                                        </div>
                                        <input type="text" name="username" id="username_id" placeholder="User Name" class="form-control" value="{{$userlist->username}}">
                                    </div>    
    
                                    <div class="input-group mb-3">
                                        <button class="btn btn-success" type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

  
    



    <div class="modal fade" id="editpwModal" role="document">
        <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Insert New Password</h4>
                </div>
                <form action="{{Route('admin-editaccount-password')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <div class="form-group">
                        <div class="modal-body">
                            <div class="form-group">
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">New Password</span>
                                    </div>
                                    <input type="password" name="password" id="password_id" placeholder="New Password" class="form-control">
                                 
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
            
            $('#access_level_id').change(function(){
                
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#access_level_idtext').val(idval);
            });

           
        });
       
    </script>


    


@endsection




