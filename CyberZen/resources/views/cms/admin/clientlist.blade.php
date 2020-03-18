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
                            <h1>Client List</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="/dashboard">DASHBOARD</a></li>
                                <li><a href="#">E-JEEP</a></li>
                                <li class="active">Client List</li>
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
                            <strong class="card-title">E-JEEP COMPANIES</strong>
                        </div>
                        <div class="container">
                            <div class="float-left p-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="search-client" placeholder="Search.." aria-label="search" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="float-right p-3">
                                <button type="submit" value="Edit" class="btn-sx btn-primary"  data-toggle="modal" data-target="#addModal" onclick=""><i class="fa fa-plus-square"></i>&nbsp; Add New Client Company</button>
                            </div>
    
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center"></th>
                                        <th class="center">Company Name</th>
                                        <th class="center">Contact Number</th>
                                        <th class="center">Email Address</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tabledtl as $detail)             
                                    <tr>
                                        <td class="center" id="ref"></td>
                                        <td class="left">{{$detail->client_name}}</td>
                                        <td class="center">{{$detail->contact_number}}</td>
                                        <td class="left">{{$detail->client_email}}</td>
                                        <td class="center">
                                            <div class="row">

                                                <div class="col-md-5">
                                                {{-- This is for edit button --}}
                                                    <form action="{{route('clientlist.update',$detail->client_id)}}" method="post">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="button" class="btn-sx btn-success"  data-toggle="modal" data-target="#editModal" 
                                                            data-client_name="{{$detail->client_name}}" 
                                                            data-client_id="{{$detail->client_id}}"
                                                            data-contact_person="{{$detail->contact_person}}"
                                                            data-contact_number="{{$detail->contact_number}}"
                                                            data-client_address="{{$detail->client_address}}"
                                                            data-keyword="{{$detail->keyword}}"
                                                            data-client_email = "{{$detail->client_email}}">
                                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i>
                                                        </button>
                                                        <div class="modal fade" id="editModal" role="document">
                                                            <div class="modal-dialog modal-lg">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Update {{$detail->client_name}}</h4>
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
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Contact Person</span>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person" aria-label="Contact Person" aria-describedby="basic-addon1">
                                                                                </div>   
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Contact Number</span>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" aria-label="Contact Number" aria-describedby="basic-addon1">
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Address</span>
                                                                                    </div>

                                                                                    <textarea class="form-control text-left" name="client_address" id="client_address" placeholder="Client Address" aria-label="Client Address" aria-describedby="basic-addon1">
                                                                                        
                                                                                    </textarea>
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Email Address</span>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="client_email" id="client_email" placeholder="Client Email Address" aria-label="Client Email Address" aria-describedby="basic-addon1">
                                                                                </div>    
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">keyword</span>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" aria-label="Keyword" aria-describedby="basic-addon1">
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
                                                <div class="col-md-5">
                                                    {{-- This is for delete button --}}
                                                    <form action="{{route('client-archive')}}" method="post">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="button" class="btn-sx btn-danger"  data-toggle="modal" data-target="#deleteModal" 
                                                            data-client_name="{{$detail->client_name}}" 
                                                            data-client_id="{{$detail->client_id}}">
                                                            <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i>
                                                        </button>
                                                        <div class="modal fade" id="deleteModal" role="dialog">
                                                            <div class="modal-dialog modal-md">
                                                            
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Delete {{$detail->client_name}}</h4>
                                                                    </div>
                                                                    <input type="hidden" name="client_id" id="client_id" value="{{$detail->client_id}}">                                                                
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
                            {{$tabledtl->links()}}
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
                    <h4 class="modal-title">Add Client Company</h4>
                </div>
                <form action="{{route('clientlist.store')}}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Name</span>
                                    </div>
                                    <input type="text" class="form-control" name="client_name" placeholder="Client Name" aria-label="Client Name" aria-describedby="basic-addon1">
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Contact Person</span>
                                    </div>
                                    <input type="text" class="form-control" name="contact_person" placeholder="Contact Person" aria-label="Contact Person" aria-describedby="basic-addon1">
                                </div>   
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Contact Number</span>
                                    </div>
                                    <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" aria-label="Contact Number" aria-describedby="basic-addon1">
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Address</span>
                                    </div>
                                    <textarea class="form-control" name="client_address" placeholder="Client Address" aria-label="Client Address" aria-describedby="basic-addon1">
                                    </textarea>
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">Client Email Address</span>
                                    </div>
                                    <input type="text" class="form-control" name="client_email" placeholder="Client Email Address" aria-label="Client Email Address" aria-describedby="basic-addon1">
                                </div>    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 200px;">keyword</span>
                                    </div>
                                    <input type="text" class="form-control" name="keyword" placeholder="Keyword" aria-label="Keyword" aria-describedby="basic-addon1">
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


    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#search-client').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('jeeps/search-client')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            }
        });
    });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var client_name = button.data('client_name'); // Extract info from data-* attributes
        var client_id = button.data('client_id');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('Delete ' + client_name +'?');
        modal.find('.modal-body').text('Are you sure to delete ' + client_name +'?');
        modal.find('#client_id').val(client_id);
    });
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
        modal.find('.modal-title').text('Are you sure to Edit ' + client_name +'?');
        modal.find('#client_id').val(client_id);
        modal.find('#client_email').val(client_email);
        modal.find('#client_address').val(client_address);
        modal.find('#contact_person').val(contact_person);
        modal.find('#contact_number').val(contact_number);
        modal.find('#client_name').val(client_name);
        modal.find('#keyword').val(keyword);
        
    });
</script>
@endsection

@section('script')

@endsection

@section('php')
<?php


?>
@endsection