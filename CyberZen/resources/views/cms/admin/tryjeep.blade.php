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
                            <th class="center"></th>
                            <th class="center">RFID</th>
                            <th class="center">Company</th>
                            <th class="center">Total KM</th>
                            <th class="center">Fare</th>
                            <th class="center">Plate Number</th>
                            <th class="center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $jeep)                             
                        <tr>
                            <td class="center" id="ref"></td>
                            <td class="left">{{$jeep->rfid_number}}</td>
                            <td class="left">{{$jeep->client_name}}</td>
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
    
  </body>
</html>