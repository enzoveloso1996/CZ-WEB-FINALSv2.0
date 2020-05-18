@extends('crm.passenger.layouts.app')

@section('content')

<style>
    /* CARD BALANCE */
    /* Background white */
    .Mobile-Balance{
        background-color:white;
        padding: 30px 20px 30px 20px;
    }
    /* Logo Size */
    #Mobile-balance-logo{
        height: 120px ;
        width: 120px ;
        position: center;
        padding-top:20px;
    }
    /* Container Design */
    #mobile-balance-container{
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #00000059;
        border-radius: 8px;
        opacity: 1;
        height: 400px;
    }
    /* Center Logo */
    .Mobile-Balance-Content{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Center Text */
    #Mobile-Balance-Text{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom:10px;
    }
    /* Text Formats */
    #mobile-welcome{
        opacity: 1;
        letter-spacing: 0;
        font-family: 'Lato', sans-serif;
        font-weight: 600;

    }
    #mobile-tap{
        letter-spacing: 0;
        color: #F1C524;
        opacity: 1;
        font-family: 'Lato', sans-serif;
        padding-left:10px;
        font-weight: 700;
    }
    .balance-card{
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #00000029;
        border: 0.5px solid #707070;
        border-radius: 8px;
        opacity: 1;
    }
    /* Center the button */
    .mobile-balance-btn{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .check-balance{
        background: #1A2E46 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #00000029;
        border: 0.5px solid #707070;
        border-radius: 8px;
        opacity: 1;
        width: 100%;
        margin: 30px 15px 0px 15px;
        font-family: 'Rubik', sans-serif;
        font: Bold 17px/20px Rubik;
        letter-spacing: 1px;
    
    }
    /* Text Format */
    #m-policy{
        font-family: 'Rubik', sans-serif;
        color: #090909;
        opacity: 1;
        margin:20px 0px 20px 0px;
        font-size: 12px;
        text-align: center;
    }
    .balance-text{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #Register-now{
        text-align: center;
        font: Bold 13px/15px Rubik;
        letter-spacing: 0;
        color: #090909;
        opacity: 1;
    }
    </style>
    
     <div class="container Mobile-Balance">
            <div class="container" id="mobile-balance-container">
                <div class="Mobile-Balance-Content">
                    <img src="/image/Group 145@2x.png" id="Mobile-balance-logo">
                </div>
                <div class="row" id="Mobile-Balance-Text">
                    <h5 id="mobile-welcome">Welcome to</h5> <h5 id="mobile-tap">TAPSAKAY</h5>
                </div>
                
                <form action="{{route('m-bal-check')}}" method="get">
                @csrf
                
                <div class="input-group" id="balance-textbox">
                    <input class="form-control balance-card" type="number" name="card_number" id="cardbaltextbox" placeholder="Card Number:**** **** ***" required>
                </div>
                <div class="row mobile-balance-btn">
                    <button type="submit" class="btn btn-primary check-balance">Check Balance</button>  
                </div> 
                
                </form>

                <p id="m-policy">By continuing, you agree to Tapsakay's Terms of Service, Privacy Policy</p>
                <div class="balance-text">
                    <p id="Register-now">Not on Tapsakay yet? Register Now!</p>
                </div>
            </div>
        </div>
    </div>
    
    


@endsection