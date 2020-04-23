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
                    <div class="input-group mb-1">
                    </div>
                </div>
                <div class="float-right p-3">
                    <input data-provide="datepicker">
                    <input class="datepicker" data-date-format="yyyy-mm-dd">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    {{-- <select name="company-list" id="companylist" class="form-control">
                        <option value="0">All</option>
                        @foreach ($companylist as $list)
                            <option id="{{$list->client_name}}" value="{{$list->client_id}}">{{$list->client_name}}</option>
                        @endforeach    
                    </select> --}}
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



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
@endsection