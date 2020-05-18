@extends('crm.passenger.layouts.app')

@section('content')

<style>


#cardnum-text{
    text-align: center;
    font: Medium 15px/18px Rubik;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
    margin-top:40px;
    padding-top:40px;
    font-weight: 700;
}
#crnt-balance{
    font: bold 18px/22px Lato;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
    text-align: center;
    margin-bottom:0px;
    margin-top:70px;
 
}
#bal-card{
    font: Bold 47px/56px Lato;
    letter-spacing: 0px;
    color: #F4C724;
    opacity: 1;
    text-align: center;
    margin-bottom:80px;
}
#regn1{
    text-align: center;
    font: bold 14px/20px Rubik;
    letter-spacing: 0px;
    color: #090909;
    opacity: 1;
}
.userbalance{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000059;
    border-radius: 8px;
    opacity: 1;
}
#regn2{
    text-align: center;
    font-family: 'Rubik', sans-serif;
    font:  13px/15px Rubik;
    font-weight: 500;
    letter-spacing: 0px;
    color: #090909;
    opacity: 1;
    padding-bottom:60px;
}
#bal-output{
    margin-bottom:100px;
}

.m-card_number_mask{
    border: none;
    padding: 0px;
    margin: 0px;
    width: 50px;
}

</style>
<div class="container" id="bal-output">
    <div class="container userbalance">
        {{-- User Card Number --}}
        @foreach ($data as $item)
            
      
        <p id="cardnum-text">Card Number: <input type="password" class="m-card_number_mask" value="{{$item->rfid_left}}" readonly>-.{{$item->rfid_right}}</p>
        <p id="crnt-balance">CURRENT BALANCE</p>
        {{-- User Current balance --}}
        <h2 id="bal-card">₱ {{$item->card_balance}}</h2>
        <p id="regn1">Not on Tapsakay yet? Register Now!</p>
        <p id="regn2">To enjoy more features and secure your card, join TapSakay now!</p>

        @endforeach
    </div>
</div>
@endsection