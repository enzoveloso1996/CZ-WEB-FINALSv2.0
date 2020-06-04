@extends('crm.passenger.layouts.app')

@section('content')
<style>
@font-face{
    font-family: 'Rubik', sans-serif;
    src: url('/Rubik/Rubik-Black.tff');
    src: url('/Rubik/Rubik-Bold.tff');
    src: url('/Rubik/Rubik-Regular.tff');
    src: url('/Rubik/Rubik-Medium.tff');
}
#WEBSITE{
    padding:0px;
    background-image: url("/image/tapsakay.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    width: 100%;
}

.HOME{
    padding:0px;
}
/* Home-Container */
#home-container{
    height: 760px;
}
    /* Image */
    #taplogo{
max-width: 10vw;
height: 90px;
width: 90px;
background: transparent;
border: none;
padding-top:5px;

}
/* container */
#home-jumbo{
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    padding-bottom:0px;
    margin-bottom: 0px;
    padding-top: 90px;
}
/* text formats */
.tap-text{
    color: #F4C724;
    margin-bottom:0px;
    font-family: 'Rubik', sans-serif;
    font: Bold 100px/120px Rubik;
    letter-spacing: 0;
    text-shadow: 0px 20px 10px #0000009C;
    opacity: 1;
    
}
/* text Container */
#tap-text2{
    display: flex;
    align-items: center;
    justify-content: center;
}
/* text formats of text2 */
.cashless{
    color:  #FFFFFF;
    margin-right:10px;
    font-family: 'Rubik', sans-serif;
    font: Bold 45px/53px Rubik;
    letter-spacing: 0;
    opacity: 1;  
}
.fare{
    color: #F4C724;
    margin-right:10px;
    font-family: 'Rubik', sans-serif;
    font: Bold 45px/53px Rubik;
    letter-spacing: 0;
    opacity: 1; 
}
.payment{
    color:  #FFFFFF;
    margin-right:10px;
    font-family: 'Rubik', sans-serif;
    font: Bold 45px/53px Rubik;
    letter-spacing: 0;
    opacity: 1;   
}
/* Button container Center items */
#btnregister{
    display: flex;
    align-items: center;
    justify-content: center;
}
/* Button Register Design */
#Register-mobile{
    display: none;
}

#Register{
    background: #1A2E46 0% 0% no-repeat padding-box;
    width: 600px!important;
    border: 0.5px solid #F9EFEF;
    border-radius: 41px;
    opacity: 1;
    height: 50px;
    font-family: 'Rubik', sans-serif;   
    font-size: 20px;
    padding-top:10px;
}
/* Text or */
.or{
    font: Bold 30px/35px Rubik;
    font-family: 'Rubik', sans-serif;   
    color: white;
    margin-bottom:10px;  
    margin-top:10px;
}

/* Button Balance */
.Web-Balance{
    display: flex;
    align-items: center;
    justify-content: center;
}
/* Modal Button3 */
#Balance{
    background: transparent;
    font: Medium 30px/36px Rubik;
    font-family: 'Rubik', sans-serif;
    border: solid white 2px;
    border-radius: 40px;
    width: 600px!important;
    font-size: calc(40px - 20px)!important;
}
#Mobile-Balancebtn{
    background: transparent;
    border: solid white 2px;
    border-radius: 40px;
    width: 600px!important;
    font-size: calc(40px - 20px)!important;
    display: none;
}
#btnbalance{
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MODAL CSS */

#balance-modal-logo{
    height: 150px ;
    width: 150px ;
    position: center;
}
/* footer */
.balance  {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-family: 'Rubik', sans-serif;
    letter-spacing: 0;
    color: #090909;
    opacity: 1;
    padding-top:20px;
    padding-bottom:20px;
    font-weight: 900;
    font-size: 12px;
}
/* Text */
#balance-welcome{
    opacity: 1;
    font-size: 25px;
    letter-spacing: 0;
    font-family: 'Lato', sans-serif;
    font-weight: 900;
}

/* input type */
.balance-pass{
    width: 400px;
    margin:auto;  
    margin-top:30px;
}
.balance-card{
    width: 400px;
    margin:auto;
    margin-top:20px;
    margin-left:33px;
    margin-right:33px;
}
#balance-tap{
    letter-spacing: 0;
    color: #F1C524;
    opacity: 1;
    font-size: 25px;
    padding-left:10px;
    font-family: 'Lato', sans-serif;
    font-weight: 700;

}
/* Modal Botton Login */
/* Center Button */
.balance-btn{
    display: flex;
    align-items: center;
    justify-content: center;
}
.check-balance{
    background: #1A2E46 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #0000003D;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
    width: 400px;
    margin:auto; 
    margin-top:20px;
    font-family: 'Rubik', sans-serif;
    font-weight: 700;
}
#policy{   
    padding: 20px 40px 20px 40px;
    font-family: 'Rubik', sans-serif;
    text-align: center;
    font-size: 15px;
    margin-top:40px!important;

}
#checkbalannce  > fieldset{
position: relative;
}
#checkbalance> fieldset:not(:first-of-type) {
    display:none;
}
/* Text FormATS */
#cardnum-text{
    text-align: center;
    font: Medium 15px/18px Rubik;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
    margin-top:40px;
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
#checkbal-reg-btn{
    border-radius: 8px;
    width: 100%;
    background-color: #1A2E46;
    margin-bottom:20px;
    height: 40px;
    font: Bold 15px/20px Rubik;
    letter-spacing: 0px;
    color: #FFFFFF;
    opacity: 1;
}
#checkbalance-error{
    padding:0px 40px 0px 40px;
    font-size: 15px;
}

/* About Container */
.ABOUT{
    height: 760px;
}
#about-container{
    height: 960px;
}
/* About-jumbo */
#about-jumbo{
    padding-bottom:0px;
    margin-bottom: 20px;
    padding-bottom:0px;
}
/* Logo Size */
#about-logo{
height: 5vw;
width: 5vw;
background: transparent;
border: none;
padding-top:0px;

}
#aboutheader-container{
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0px;
    margin:0px;
}
/* text format */
.about-text{
    letter-spacing: 0;
    opacity: 1;
    color: white;
    font-size: 50px;
    font-family: 'Lato', sans-serif;
}
#about-company{
    color: white;
}
/* text responsive */
.about-tapsakay-text{
    letter-spacing: 0;
    opacity: 1;
    color: #F4C724; 
    margin-left:20px;
    font-size: 50px;
    font-family: 'Lato', sans-serif;
}
/* paragraph padding */
#company-container{
    padding:10px 40px 10px 40px;
}
/* text of content */
.about-content{
    font-family: 'Lato', sans-serif;
    text-align: left;
    font-size: 30px;       
}
#about-company{
    font-family: 'Lato', sans-serif;
}

/* Images */
#regular {
    margin:0px 10px 10px 0px;
    padding:0px;
    position: relative;
}
#senior {
    margin:0px 10px 10px 0px;
    padding:0px;
}
#student{
    margin:0px 10px 10px 0px;
    padding:0px;
}
/* Contact Us */
#contact-us-content{
    margin-bottom:0px!important;
}
#CONTACT{
    height: 960;
}
#contact-us-container{
    height: 960px;
    padding-top:30px;

}
#contactheader-container{
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0px;
    margin:0px;
}
.message-question-container{
    padding:20px;
}
.Question{
    padding-right:5%; 
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border-radius: 8px;
    opacity: 1;
}

#name-textbox{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border-radius: 8px;
    opacity: 1;
    margin-bottom:20px;
}
#email-textbox{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border-radius: 8px;
    opacity: 1;
    margin-bottom:20px;
}
.Send{
    background: #F4C724 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border-radius: 8px;
    opacity: 1;
    height: 30px;
    width: 200px;
    padding:0px 0px 0px 0px;
    font-family: 'Rubik', sans-serif;
    font-weight: 700;
    color:#1A2E46;
}
/* Text Formats */
.contact-text1{
    font-family: 'Rubik', sans-serif;
    font-size:25px;
    padding-top:20px;
    padding-left:20px;
    color:#707070;
}
.contact-text2  {
    font-family: 'Rubik', sans-serif;
    font-size:15px;
    padding-top:10px;
    padding-left:20px;
    padding-bottom:20px;
    color:#707070;
}
.Question > p {
    color:#707070;
    font-family: 'Rubik', sans-serif;
    font-size:15px;
    text-align: justify;
}
#Inquire{
    color:white;
    font-family: 'Lato', sans-serif;
    font-size: 20px;
}
#loc{
    color:#F4C724;
    padding-left:30px;
    padding-right:20px;
}
#contact-icon{
    color:#F4C724;
    padding-left:30px;
    padding-right:20px;
}
#mail-icon{
    color:#F4C724;
    padding-left:30px;
    padding-right:20px;
}
.Mobile-Balance{
    display:none;
}

    
@media screen and (max-width: 768px) { 
/* HIDE ABOUT and CONTACT  CONTENTS  */
.ABOUT{
    display:none;
}
.CONTACT{
    display:none;
}
/* HOME MOBILE DESIGN */

/* Mobile Balance Show */
#Mobile-Balancebtn{
    display:block;
}
/* Hide Web modal button */
#Balance{
    display:none;
}

.HOME{
    height: 760px;
}
#home-jumbo{
    padding-top:100px;
}
/* Image resize */
#taplogo{
    height: 50px;
    width: 50px;
}
/* FONTS */
.tap-text{
    color: #F4C724;
    font: bolder 50px/45px Rubik;

}
.cashless{
    font: Bolder 20px/22px Rubik;
    color: #F4C724;
    margin-right:10px;
}
.fare{
    font: Bolder 20px/22px Rubik;
    color: white;
    margin-right:10px;
}
.payment{
    font: Bolder 20px/22px Rubik;
    color: #F4C724;
    margin-bottom:10px; 
}
.or{
    margin-bottom: 10px;
    margin-top:10px;
    font: Bolder 15px/22px Rubik;
    color: white;
    margin-right:10px;
}
/* Buttons */
#Register-mobile{
    border: 1px solid #FFFFFF;
    height: 46px;
    padding-top: 12px;
    font: Bold 17px/20px Rubik;
    letter-spacing: 0;
    opacity: 1;
    width:350px!important;
    display: block;
    background: #1A2E46 0% 0% no-repeat padding-box;
    /*width: 600px!important;*/
    /*border: 0.5px solid #F9EFEF;*/
    border-radius: 41px;
    /*opacity: 1;*/
    /*height: 50px;*/
    font-family: 'Rubik', sans-serif;   
    font-size: 20px;
    /*padding-top:10px;*/
    
}
#Register{
    display: none;    
}
#Mobile-Balancebtn{
    font:  Bold 12px/15px Rubik;
    height: 46px;
    width:350px!important;
    padding-top: 15px;
}


/* ABOUT MOBILE  */
.ABOUT{
    height:calc(500 * 2px );
}

#about-jumbo{
    margin-bottom:0px;
}

/* Text Style */
.about-text{
    font-size:25px;
    letter-spacing: 0;
    opacity: 1;
    color: #707070;
    text-decoration: underline #F4C724;
}
.about-tapsakay-text{
    font: Regular 23px/28px Rubik;
    font-size:25px;
    letter-spacing: 0;
    color: #F4C724;
    margin-left:5px;
}
#about-logo{
    height: 40px;
    width: 40px;
}
#company-container{
        padding:10px 0px 10px 0px;
}
#about-company{
    text-align: center;
    font: Regular 15px/18px Rubik;  
    font-size: 12px;
    letter-spacing: 0;
    color: black;
    opacity: 1;
}
#regular{
    background: #1A2E46 0% 0% no-repeat padding-box;
    border-radius: 7px 7px 7px 7px;
    opacity: 1;
    
}
#senior{
    background: #1A2E46 0% 0% no-repeat padding-box;
    border-radius: 7px 7px 7px 7px;
    opacity: 1;
}
#student{
    background: #1A2E46 0% 0% no-repeat padding-box;
    border-radius: 7px 7px 7px 7px;
    opacity: 1;
}
/* MOBILE CONTACT DESIGN */
.Question{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #707070;
    border-radius: 11px;
    opacity: 1; 
    padding-top: 10px;
    margin-bottom:10px;
}

#Inquire{
    font: Regular 15px/18px Rubik;
    letter-spacing: 0;
    color: #707070;
    opacity: 1;
}
#name{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
}
#message{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
}

.Send{
    background: #1A2E46 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
    color:white;
    width: 100%;
    height: 40px;
}
.contact-text2{
    color:#1A2E46;
    font-family: 'Rubik', sans-serif;
    font-size:15px;
    text-align: justify;
}
.contact-text1{
    color:#707070;
    font-family: 'Rubik', sans-serif;
    text-align: center;
    font: Bold 19px/23px Rubik;
}
.Question > p {
    color:#1A2E46;
    text-align:left;
}
/* Image Resize Contact us  */
#pin, #contact, #email {
    height:20px!important;
    width:20px!important;
    margin-left:10px;

}

}
.w-card_number_mask{
    border: none;
    padding: 0px;
    margin: 0px;
    width: 50px;
}
</style>

{{-- Home --}}
<div class="container-fluid" id="WEBSITE">
    @if (session('msg_status') == 1)
    <p class=" text-success">
        Changing Card Number Success, Please Logged In again.
    </p>
    @endif
    <div class="container HOME" id="homesection">
        <div class="container-xl" id="home-container">
                    {{-- Text 1 --}}
            <div class="jumbotron jumbotron-fluid" id="home-jumbo">
                <h1 class="tap-text">TAPSAKAY</h1>
                <img src="/image/tap@2x.png" id="taplogo">
            </div>
                    {{-- Text 2 --}}
            <div class="row" id="tap-text2">
                <h1 class="cashless">    CASHLESS    </h1>
                <h1 class="fare">    FARE        </h1>
                <h1 class="payment">    PAYMENT     </h1>
            </div>
                    {{-- Button --}}

            <div class="container">
                <div class="row" id="btnregister">
                    <a class="btn btn-primary" href="{{route('web-registration')}}" role="button" id="Register">Register your Card!</a>
                </div>
                <div class="row" id="btnregister">
                    <a class="btn btn-primary" href="{{route('mob-registration')}}" role="button" id="Register-mobile">Register your Card!</a>
                </div>

            </div>
            <div class="row" id="tap-text2">
                <h1 class="or">    Or    </h1>
            </div>
                {{-- Button --}}
            <div class="container">
                <div class="row" id="btnbalance">
                    <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop" id="Balance">
                                Check your Balance here.
                            </button>
                        
                            <a type="button" class="btn btn-primary" id="Mobile-Balancebtn" href="{{route('m-bal')}}">Check your Balance here.</a>
                      
                        <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                
                                <div class="modal-body" id="checkbalance">
                                    <fieldset class="balance-input">
                                    {{-- TapLogo --}}
                                    <div class="body-content">
                                        <img src="/image/Group 145@2x.png" id="balance-modal-logo">
                                    </div>
                                            {{-- Text --}}
                                    <div class="row login-modal-text"> 
                                        <h5 id="balance-welcome">Welcome to</h5> <h5 id="balance-tap">TAPSAKAY</h5>
                                    </div>

                                    <form action="{{route('web-bal-check')}}" method="get">
                                    @csrf

                                    <div class="input-group" id="balance-textbox">
                                        <input class="form-control balance-card" name="card_number" type="number" id="cardbaltextbox" placeholder="Card Number:**** **** ***" required>
                                    </div>
                                   <span><b class="form-text text-danger" id="checkbalance-error"></b></span>
                                    <div class="row balance-btn">
                                        <button type="submit" class="btn btn-primary check-balance">Check Balance</button>
                                    </div> 

                                    </form>

                                    <h6 id="policy">By continuing, you agree to Tapsakay's Terms of Service, Privacy Policy</h6>
                                    </fieldset>

                                    
                                </div>
                                

                                <div class="modal-footer balance">
                                    <p>Not on Tapsakay yet? <a href="{{route('web-registration')}}">  Register Now!</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="staticBackdrop2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body" id="checkbalance2">
                                    <fieldset class="balance-output">
                                        <div class="container">
                                            <div class="container">
                                                    {{-- User Card Number --}}
                                                <p id="cardnum-text">Card Number: <input type="password" class="w-card_number_mask" value="{{Session::get('rfid_left')}}">-{{Session::get('rfid_right')}}</p>
                                            </div>
                                            <div class="container">
                                                <p id="crnt-balance">CURRENT BALANCE</p>
                                                {{-- User Current balance --}}
                                                <h2 id="bal-card">₱ {{Session::get('card_balance')}}</h2>
                                            </div>
                                            <div class="container">
                                                <p id="regn1">To enjoy more features and secure your card, join Tapsakay now!</p>
                                            </div>
                                            <div class="container">
                                                <a type="button" class="btn btn-secondary btn-sm" id="checkbal-reg-btn" href="{{route('web-registration')}}">Register here!</a>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="modal-footer balance">
                                    <p>Not on Tapsakay yet? Register Now!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


            {{-- About --}}
    <div class="container ABOUT" id="aboutsection">
        <div class="container-xl" id="about-container">
        {{-- About Content --}}
            <div class="jumbotron jumbotron-fluid" id="about-jumbo" style="background:transparent;">
                <div class="container row " id="aboutheader-container">
                    <h1 class="about-text">ABOUT</h1>
                    <h1 class="about-tapsakay-text">TAPSAKAY</h1>
                    <img src="/image/tap@2x.png" id="about-logo">
                </div>
            </div>
            <div class="jumbotron jumbotron-fluid" id="company-container" style="background:transparent;">
                <div class="container">
                    <p id="about-company">The TapSakay is a convenient fare payment system for E-Jeepneys public commuters. 
                            TapSakay Card will be used as a fare payment on public E-Jeepney transport. 
                            It can be availed in the terminals and inside of E-Jeepneys. The commuters can avail discounts if the commuter is a Student, 
                            Senior Citizen or PWD. Commuters who want to avail of the card need to provide at least one valid ID. 
                            Through presenting valid IDs, the commuters can avail 20% discount in his/her fare payment.</p>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img src="/image/Group 142@2x.png" class="img-fluid" alt="Responsive image" id="regular">
                    </div>
                    <div class="col-sm">
                        <img src="/image/Group 143@2.png" class="img-fluid" alt="Responsive image" id="senior">
                    </div>
                    <div class="col-sm">
                        <img src="/image/Group 144@2x.png" class="img-fluid" alt="Responsive image" id="student">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
        {{-- Contact Us --}}
    <div class="container CONTACT" id="contactsection">
        <div class="container-xl" id="contact-us-container">
            {{-- Contact US HEADER --}}
            <div class="jumbotron jumbotron-fluid" style="Background:transparent;" id="contact-us-content">
                <div class="container row " id="contactheader-container">
                    <h1 class="about-text">CONTACT</h1>
                    <h1 class="about-tapsakay-text">US</h1>
                </div>
            </div>
            {{-- Content - Container --}} 
            <div class="container" id="content-question-container">
                <div class="row message-container">
                    <div class="col-sm Question">
                        <h3 class="contact-text1">Have any Question?</h3>
                        <h3 class="contact-text2">You can contact us through the following info or you can sign up the form below.</h3>
                        <p> <i class="fa fa-map-marker fa-2x" id="loc" aria-hidden="true"></i>13 Urbano Street, Brgy. Bagbag, Novaliches, Quezon City</p>
                        <p><i class="fa fa-phone fa-2x" id="contact-icon" aria-hidden="true"></i>(02) 779-31862</p>
                        <p><i class="fa fa-envelope fa-2x" id="mail-icon" aria-hidden="true"></i>cyberzen@gmail.com</p>
                    </div>
                                    
                    <div class="col-sm">
                        <p id="Inquire">Inquire here:</p>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Name" id="name-textbox">                        
                        </div>   
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Email" id="email-textbox">
                        </div>
                        <div class="form-group message-container">
                            <textarea class="form-control" rows="5" placeholder="Message" id="message"></textarea>
                        </div>
                        <form action="#" method="post">
                            <button type="button" class="btn btn-warning Send">SEND</button>
                        </form>
                    </div>
                </div>
            </div>      
        </div>
    </div>

    
@endsection 