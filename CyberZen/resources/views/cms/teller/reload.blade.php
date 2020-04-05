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
    .rfid {
        font-weight: 500!important;
    }
    #twozero {
        border: solid 1px orange;
        color: orange;
    }
    #twozero:hover{
        background-color: #ffae42;
        color:white;
    }
    #fiveh {
        border: solid 1px #ffd300;
        color: #ffd300;
    }
    #fiveh:hover{
        background-color: #fff200;
        color:white;
    }
    #result{
        display: none;
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
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">TAP CARDS</a></li>
                            <li class="active">Load</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-->
 
<div class="content">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <h4>Load</h4>
            </div>
            <div class="card-body">
                <div class="float-left p-3">
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="searchLoad" placeholder="RFID.." aria-label="search" aria-describedby="basic-addon1" autofocus>
                    </div>
                </div>
                
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="center">RFID Number</th>
                            <th class="center">Card Balance</th>
                            <th class="center">Full Name</th>
                            <th class="center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($reload as $cardlist)
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Load</h5>
                                    </div>
                                    <div class="modal-body">
                                    <form method="post" action="{{ route('reload-card')}}">
                                        @method('POST') 
                                        @csrf
                                        <input type="text" class="form-control" name="id" id="id" hidden>
                                        <input type="text" class="form-control" name="user_id" id="user_id" value="{{$user_id}}" hidden>
                                        <input type="text" class="form-control" name="updated_by" id="updated_by" value="ron" hidden>
                                        <div class="container text-center">
                                            <h3 class="modal-title rfid" id="rfid"></h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Current Balance:</label>
                                            <input type="text" class="form-control" id="bal" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Amount:</label>
                                            <input class="form-control" id="amount" name="amount" disabled>
                                            <input class="form-control" id="amount2" name="amount2" hidden>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Total Balance:</label>
                                            <input class="form-control" name="tot" id="tot" disabled>
                                            <input class="form-control" name="tot2" id="tot2" hidden>
                                        </div>
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="button" id="twozero" class="btn btn-outline-secondary">20</button>
                                            <button type="button" id="fivezero" class="btn btn-outline-danger">50</button>
                                            <button type="button" id="oneh" class="btn btn-outline-info">100</button>
                                            <button type="button" id="twoh" class="btn btn-outline-success">200</button>
                                            <button type="button" id="fiveh" class="btn btn-outline-warning">500</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" onclick="wow()" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div id="result">
                    <div class="jumbotron text-center">
                        <h4>No available data</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script>
    function wow(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
                icon: 'success',
                title: 'Load Updated'
            })
    }
</script>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var bal = button.data('bal');
    var id = button.data('id');
    var rfid = button.data('rfid');
    var modal = $(this);
    modal.find('#rfid').text(rfid)
    modal.find('.modal-body #bal').val(bal);
    modal.find('.modal-body #id').val(rfid);
  })
</script>
<script> 
    $("#twozero").click(function(event) {
        $('#amount').val(20.00);
        $('#amount2').val(20.00);
        var input = $('[id="bal"],[id="amount"]'),
            input1 = $('[id="bal"]'),
            input2 = $('[id="amount"]'),
            input3 = $('[id="tot"]');
            input4 = $('[id="tot2"]');
            var val1 = (isNaN(parseInt(input1.val()))) ? 0 : parseInt(input1.val());
            var val2 = (isNaN(parseInt(input2.val()))) ? 0 : parseInt(input2.val());
            input3.val(val1 + val2);
            input4.val(input3.val());
    });
    $("#fivezero").click(function(event) { 
        $('#amount').val(50.00);
        $('#amount2').val(50.00);
        var input = $('[id="bal"],[id="amount"]'),
            input1 = $('[id="bal"]'),
            input2 = $('[id="amount"]'),
            input3 = $('[id="tot"]');
            input4 = $('[id="tot2"]');
            var val1 = (isNaN(parseInt(input1.val()))) ? 0 : parseInt(input1.val());
            var val2 = (isNaN(parseInt(input2.val()))) ? 0 : parseInt(input2.val());
            input3.val(val1 + val2);
            input4.val(input3.val());
    }); 
    $("#oneh").click(function(event) { 
        $('#amount').val(100.00);
        $('#amount2').val(100.00);
        var input = $('[id="bal"],[id="amount"]'),
            input1 = $('[id="bal"]'),
            input2 = $('[id="amount"]'),
            input3 = $('[id="tot"]');
            input4 = $('[id="tot2"]');
            var val1 = (isNaN(parseInt(input1.val()))) ? 0 : parseInt(input1.val());
            var val2 = (isNaN(parseInt(input2.val()))) ? 0 : parseInt(input2.val());
            input3.val(val1 + val2);
            input4.val(input3.val()); 
    }); 
    $("#twoh").click(function(event) { 
        $('#amount').val(200.00);
        $('#amount2').val(200.00);
        var input = $('[id="bal"],[id="amount"]'),
            input1 = $('[id="bal"]'),
            input2 = $('[id="amount"]'),
            input3 = $('[id="tot"]');
            input4 = $('[id="tot2"]');
            var val1 = (isNaN(parseInt(input1.val()))) ? 0 : parseInt(input1.val());
            var val2 = (isNaN(parseInt(input2.val()))) ? 0 : parseInt(input2.val());
            input3.val(val1 + val2);
            input4.val(input3.val());
    }); 
    $("#fiveh").click(function(event) { 
        $('#amount').val(500.00);
        $('#amount2').val(500.00);
        var input = $('[id="bal"],[id="amount"]'),
            input1 = $('[id="bal"]'),
            input2 = $('[id="amount"]'),
            input3 = $('[id="tot"]');
            input4 = $('[id="tot2"]');
            var val1 = (isNaN(parseInt(input1.val()))) ? 0 : parseInt(input1.val());
            var val2 = (isNaN(parseInt(input2.val()))) ? 0 : parseInt(input2.val());
            input3.val(val1 + val2);
            input4.val(input3.val());
    });
</script> 
<script type="text/javascript">
    $('#searchLoad').on('keyup',function(){
        $('tbody').empty();
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('cards/searchLoad')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            }
        });

            if($('#searchLoad').val().length === 0) {
                $('#result').css('display', 'block');
            } else {
                $('#result').css('display', 'none');
            }

    })
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection