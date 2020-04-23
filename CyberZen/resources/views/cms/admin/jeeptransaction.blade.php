@extends('cms.layout')
<link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
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
                            <li class="active">Jeep Transactions</li>
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
                <h4>Jeep Transactions</h4>
            </div>
            <div class="card-body">
                <div class="float-left p-3">
                    <div class="input-group mb-1">
                        <h6>Select date: <input id="dateinput" type="text"></h6>
                    </div>
                </div>
                
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="center"></th>
                            <th class="center">RFID</th>
                            <th class="center">Total KM</th>
                            <th class="center">Fare</th>
                            <th class="center">Jeep Plate Number</th>
                            <th class="center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jeeps as $jeep)                             
                        <tr>
                            <td class="center" id="ref"></td>
                            <td class="left">{{$jeep->rfid_number}}</td>
                            <td class="left">{{$jeep->totalKm}}</td>
                            <td class="center">{{$jeep->fare}}</td>
                            <td class="left">{{$jeep->jeep_plate_number}}</td>
                            <td class="center">{{$jeep->created_at}}</td>
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
@endsection