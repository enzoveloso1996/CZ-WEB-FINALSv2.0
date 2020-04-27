@extends('cms.layout')
<link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
{{-- <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
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
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Reports</a></li>
                            <li class="active">Card Transactions</li>
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
                <h4>Card Transactions</h4>
            </div>
            <div class="card-body">
                <div class="float-left p-3">
                <Form method="get" action="{{ url('cardspdf')}}">
                    <div class="input-group mb-1">
                        <h6>Select date:<input class="form-control" name="date" id="dateinput" type="text"></h6>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary" type="submit">Download Report</button>
                </Form>
                </div>
                
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="center"></th>
                            <th class="center">RFID</th>
                            <th class="center">Transaction Type</th>
                            <th class="center">Amount</th>
                            <th class="center">Updated by</th>
                            <th class="center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $card)                             
                        <tr>
                            <td class="center" id="ref"></td>
                            <td class="left">{{$card->rfid_number}}</td>
                            <td class="left">{{$card->transaction_type}}</td>
                            <td class="center">{{$card->amount}}</td>
                            <td class="left">{{$card->firstname}}</td>
                            <td class="center">{{$card->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    $(function() {
        $('#dateinput').datepicker({
             dateFormat: 'yy-mm-dd' 
        }).datepicker("setDate", new Date());
    });
</script>
<script type="text/javascript">
    $('#dateinput').on('change',function(){
        $('tbody').empty();
        $value=$(this).val();
        console.log($value);
        $.ajax({
            type : 'get',
            url : '{{URL::to('cardsbydate')}}',
            data:{'search':$value},
            cache: false,
            async: true,
            success:function(data){
                $('tbody').html(data);
            },
        });
    });
</script>
{{-- <script>
    $('#download_report').click(function(){
        $date = $('#dateinput').val();

        console.log($date);
        $.ajax({
            type    : 'get',
            url     : '{{URL::to('cardspdf')}}',
            data    : {'date':$date},
            success : function(data){
                console.log("success");
            },
            // error   : function(data) {
            //     console.log("error");
            // }
        });
    });
</script> --}}
{{-- <script type="text/javascript">
    $('#dateinput').on('change',function(){
        $('tbody').empty();
        $value=$(this).val();
        console.log($value);
        $.ajax({
            type : 'get',
            url : '{{URL::to('cardspdf')}}',
            data:{'search':$value},
            cache: false,
            async: true,
            success:function(data){
                $('tbody').html(data);
            },
        });
    });
</script> --}}
@endsection