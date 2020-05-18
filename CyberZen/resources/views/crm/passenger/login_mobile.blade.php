@extends('crm.passenger.layouts.app')

@section('content')
<style>

.login-content-container{
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 3px 6px #00000059;
border-radius: 8px;
opacity: 1;
margin-top:20px;
margin-bottom:20px;
padding:10px!important;
}
#m-login-body{
    padding:0px;
}
#m-login-logo{
    height: 120px;
    width: 120px;
}
#m-welcome-to{
    opacity: 1;
    font-size: 20px;
    letter-spacing: 0;
    font-family: 'Lato', sans-serif;
    font-weight: 900;
}
#m-tap1{
    letter-spacing: 0;
    color: #F1C524;
    opacity: 1;
    font-size: 20px;
    padding-left:10px;
    font-family: 'Lato', sans-serif;
    font-weight: 900;
}
#m-pass{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000059;
    border-radius: 8px;
    opacity: 1;
    margin-left:20px;
    margin-right:20px;
}
#m-card{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000059;
    border-radius: 8px;
    opacity: 1;
    margin-left:20px;
    margin-right:20px;
}
#m-login-btn{
    width: 100%;
    background: #1A2E46 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
    
}
.login-btn-container{
 margin:35px 20px 0px 20px;
}
#m-policy{
    padding: 20px 40px 0px 40px;
    font-family: 'Rubik', sans-serif;
    text-align: center;
    font-size: 10px;
    margin-top:40px!important;
    margin-bottom:0px;
}
#m-reg-now{
    text-align: center;
    font: Bold 13px/15px Rubik;
    letter-spacing: 0px;
    color: #090909;
    opacity: 1;
    margin-top:25px;
    
}
</style>



<div class="container">
    <div class="container login-content-container">
        <div class="modal-body" id="m-login-body">
        {{-- Modal Image --}}
            <div class="body-content">
                <img src="/image/Group 145@2x.png" id="m-login-logo">
            </div>
            {{-- text --}}
            <div class="row login-modal-text"> 
                <h5 id="m-welcome-to">Welcome to</h5> <h5 id="m-tap1">TAPSAKAY</h5>
            </div>
            {{-- Input type --}}
            <form action="{{route('mob-login')}}">
            @csrf
            @method('GET')

            <div class="input-group">
                <input class="form-control card" id="m-card" type="number" placeholder="Card Number" name="card_number">
            </div>
            <div class="input-group">
                <input class="form-control pass" id="m-pass" type="password" placeholder="Password" name="password">  
            </div>
        {{-- Buton --}}
            <div class="row login-btn-container">
                <button type="submit" class="btn btn-secondary login-btn" id="m-login-btn">Log in</button>
                </div>
                
            </form>
                <h6 id="m-policy">By continuing, you agree to Tapsakay's Terms of Service, Privacy Policy</h6>
                <p id="m-reg-now"> Not on Tapsakay yet? Register Now!</p>
            </div>
        </div>
    </div>
</div>


@endsection
