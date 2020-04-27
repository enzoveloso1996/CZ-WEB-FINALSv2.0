<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    {{-- <div class="navbar-header">
      <img id="logo-header" src="{{ asset('new/img/logo.png') }}" alt="Logo">
    </div> --}}
    <div class="container">
        <div class="row">
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th >RFID</th>
                            <th >Transaction</th>
                            <th >Amount</th>
                            <th >Updated by</th>
                            <th >Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $card)                             
                        <tr>
                            <td >{{$card->rfid_number}}</td>
                            <td >{{$card->transaction_type}}</td>
                            <td >{{$card->amount}}</td>
                            <td >{{$card->firstname}}</td>
                            <td >{{$card->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    
  </body>
</html>