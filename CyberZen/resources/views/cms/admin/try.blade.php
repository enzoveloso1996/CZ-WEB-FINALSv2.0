<!DOCTYPE html>
<html>

<head>
	<link href="https://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
</head>
<body>
    <div class="content">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <h4>Card Transactions</h4>
                </div>
                <div class="card-body">
                    <div class="float-left p-3">
                        <div class="input-group mb-1">
                            <h6>Select date:<input class="form-control" id="dateinput" type="text"></h6>
                        </div>
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
                            @foreach ($cards_data as $card)                             
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
        $('#dateinput').datepicker();
    });
</script>
</body>
</html>