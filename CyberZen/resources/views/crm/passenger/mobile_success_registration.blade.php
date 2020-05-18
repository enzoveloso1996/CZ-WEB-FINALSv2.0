@extends('crm.passenger.layouts.app')

@section('content')

<style>

#mobile-success-container{
    margin-bottom:60px;
}

#mobile-success-content{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000059;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
    margin-top:20px;
}
#mobile-success-text-logo{
    display: flex;
    align-items: center;
    justify-content: center;
    padding:0px!important;
    margin-bottom:20px;
}
#mobile-registration-text{
    font-family: 'Lato', sans-serif;
    font-size:calc(4vw - 1px);
    letter-spacing: 0;
    color: #03BF3C;
    opacity: 1;
    font-weight: 900;
    margin-top:30px;
}
#check{
    height: 20px;
    width: 20px;
    margin-right:10px;
}
#mobile-text-logo{
    padding-left:20%;
    padding-right:20%;
   
}
#mobile-text-logo > p{
    margin-bottom:5px;
}
#mobile-text-logo2{
    padding-left:20%;
    padding-right:30%;
}
#mobile-card-text{
    margin-right:10px;
    letter-spacing: 0;
    font-size: 3vw;
    color: #0A0A0A;
    opacity: 0.7;
    font-family: 'Rubik', sans-serif;

}
#mobile-card-number{
    font-family: 'Rubik', sans-serif;
    letter-spacing: 0;
    color: #0A0A0A;
    opacity: 1;
    font-size: 3vw;
    font-weight: 600;
    
}
#mobile-logo{
    margin-bottom:20px;
}
#mobile-loginbtn{
    border-radius: 8px;
    width: 100%;
    background-color: #1A2E46;
    margin-bottom:20px;
    height: 40px;
    letter-spacing: 0px;
    color: #FFFFFF;
    opacity: 1;
    font: Bold 17px/20px Rubik;
    font-family: 'Rubik', sans-serif;
    font-size:20px;
    font-weight: 500;
    }
#mobile-logo-container{
    height: 400px;
    width: 100%;
}
.m-button-container{
    margin-top:20px;
}

</style>
<div class="container" id="mobile-success-container">
    <div class="container" id="mobile-success-content">
        <div class="container" id="mobile-success-text-logo">
            <h3 id="mobile-registration-text"> <img src="/image/circle_ok.png" id="check"> You're registration is successful!</h3>
        </div>
        <div class="row" id="mobile-text-logo">                                        
            <p id="mobile-card-text">Card Number :</p> <p id="mobile-card-number">{{$card_number}}</p>
        </div>
        <div class="row" id="mobile-text-logo2">                                        
            <p id="mobile-card-text">Card Type  :</p> <p id="mobile-card-number">
                @if ($card_type == 1)
                Regular
            @elseif($card_type == 2)
                Discounted
            @endif
            </p>
        </div>
        <div class="container">
            <img src="/image/Group 22@2x.png" class="img-fluid" alt="Responsive image">
        </div>
        <div class="container m-button-container">
            <a type="button" class="btn btn-secondary btn-sm mobile-next" id="mobile-loginbtn" href="{{route('mob-login-index')}}">Login Now!</a>
        </div>
    </div>
</div>
@endsection
