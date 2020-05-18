@extends('crm.passenger.layouts.app')

@section('content')

<style>
#Mobile-container{
    display: block;
    margin:20px 20px 50px 20px;
}
#mobile-form-container{
    padding:0px!important;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000059;
    border: 0.5px solid #707070;
    border-radius: 8px;
    opacity: 1;
}
/* P format */
#register-your-card{
    text-align: left;
    font-size: 15px;
    letter-spacing: 0;
    color: #010101;
    opacity: 1;
}
#mobile-step1{
    text-align: left;
    font:Bold 15px/18px Rubik;
    letter-spacing: 0;
    color: #000000;
    opacity: 1;
    
}
#mobile-step2{
    text-align: left;
    font:Bold 15px/18px Rubik;
    letter-spacing: 0;
    color: #000000;
    opacity: 1;
   
}
.form1, .form2{
    padding: 15px 15px 15px 15px!important
}

#previous{
    color:black;
    background-color:transparent;
    width: 37%;
    border-radius: 8px;
    border: black solid 1px;
    margin-bottom:20px;
    width: 100%;
}
/* Button design */
#register{
    background-color: #1A2E46;
    border-radius: 8px;
    width: 100%;
    margin-right:5px;
    margin-bottom:20px;
}
#next{
border-radius: 8px;
width: 100%;
background-color: #1A2E46;
margin-bottom:20px;
height: 40px;
}
#tapsakayform > fieldset{
position: relative;
}
#tapsakayform > fieldset:not(:first-of-type) {
    display:none;
}
input[type=text]{
    text-align: left;
    font: Medium 15px/18px Rubik;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
    font-family: 'Rubik', sans-serif;

}
input[type=password]{
    text-align: left;
    font: Medium 15px/18px Rubik;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
    font-family: 'Rubik', sans-serif;
}

#register-your-card{
    text-align: left;
    font: Black 15px/18px Lato;
    letter-spacing: 0px;
    color: #010101;
    opacity: 1;
}
#eye-icon{
    float:right;
    opacity:0.6;
    padding-right:20px;
    margin-top:-27px;  
}
#m-warning{
    text-align: left;
    font-family: 'Rubik', sans-serif;
    font-size: 12px;
    letter-spacing: 0px;
    color: #DF0514;
    opacity: 1;
    margin-bottom:5px;
    
}
#m-excla-icon{
    padding-right:10px;
}
#previousbtn-container{
    padding:0px!important;
}
#registerbtn-container{
    padding:0px!important;
}
</style>


<div class="row" id="Mobile-container">
    <p id="register-your-card"><strong>Register your Card to get additional features!</strong></p>
    <div class="container" id="mobile-form-container">
        <form id="tapsakayform" action="{{route('mob-reg-success')}}">
            @csrf
            @method('GET')

            <fieldset class="form1">
                <p id="mobile-step1">Step 1 of 2</p>
                <div class="form-group">
                    <input type="text" class="form-control" id="cardnumber"  placeholder="Card Number" required>
                    <b class="form-text text-danger" id="mobile-cnumberError"></b>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="firstname"  placeholder="First Name" required>
                    <b class="form-text text-danger" id="mobile-fnameError"></b>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" required>
                    <b class="form-text text-danger" id="mobile-lnameError"></b>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="middlename" placeholder="Middle Name" required>
                    <b class="form-text text-danger" id="mobile-mnameError"></b>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pass" placeholder="Password" required >
                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true" id="eye-icon"></i>
                    <b class="form-text text-danger" id="mobile-passError"></b>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="confirmpass" placeholder="Confirm Password" required>
                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true" id="eye-icon"></i>
                    <b class="form-text text-danger" id="mobile-confirmpassError"></b>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="contactnum" placeholder="Contact Number" required>
                    <b class="form-text text-danger" id="mobile-contactnumError"></b>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="emailadd" placeholder="Email Address" required>
                    <b class="form-text text-danger" id="mobile-emailaddError"></b>
                </div>
                <button type="button" class="btn btn-secondary btn-sm next" id="next">Next</button>
                <p id="m-warning"><strong><i class="fa fa-exclamation-circle fa-2x" id="m-excla-icon" aria-hidden="true"></i>Please complete all require fields.</strong></p>
            </fieldset>
    
            <fieldset class="form2">
                <p id="mobile-step2">Step 2 of 2</p>
                <div class="form-group">
                    <label for="cardnumber"><b>Card Number</b></label>
                    <input type="text" class="form-control" id="cardnumberf2" name="cardnumber" required style="border:none; border-bottom:4px solid #707070;
                    ">
                </div>
                <div class="form-group">
                    <label for="fname"><b>First Name</b></label>
                    <input type="text" class="form-control" id="firstnamef2" name="firstname" required style="border:none; border-bottom:4px solid #707070;
                    ">
                </div>
                <div class="form-group">
                    <label for="lname"><b>Last Name</b></label>
                    <input type="text" class="form-control" id="lastnamef2" name="lastname" required style="border:none; border-bottom:4px solid #707070;
                    box-shadow: 0px 3px 6px #00000029;">
                </div>
                <div class="form-group">
                    <label for="mname"><b>Middle Name</b></label>
                    <input type="text" class="form-control" id="middlenamef2" name="middlename" required style="border:none; border-bottom:4px solid #707070;
                    box-shadow: 0px 3px 6px #00000029;">
                </div>
                <div class="form-group">
                    <label for="password"><b>Password</b></label>
                    <input type="password" class="form-control" id="passwordf2" name="password" required style="border:none; border-bottom:4px solid #707070;
                    box-shadow: 0px 3px 6px #00000029;">
                    <i class="fa fa-eye-slash fa-lg" aria-hidden="true" id="eye-icon"></i>
                </div>
                <div class="form-group">
                    <label for="contactnum"><b>Contact Number</b></label>
                    <input type="text" class="form-control" id="contactnumf2" name="contactnum" required style="border:none; border-bottom:4px solid #707070;
                    box-shadow: 0px 3px 6px #00000029;">
                </div>
                <div class="form-group">
                    <label for="emailadd"><b>Email Address</b></label>
                    <input type="text" class="form-control" id="emailaddf2" name="emailadd" required style="border:none; border-bottom:4px solid #707070;
                    box-shadow: 0px 3px 6px #00000029;">
                </div>   
                <div class="container" id="registerbtn-container">         
                    <input class="btn btn-primary form-register" id="register" type="submit" value="Register">
                </div> 
                <div class="container" id="previousbtn-container"> 
                    <button class="btn btn-primary cancel" type="button" id="previous">Cancel</button>
                </div>
        </fieldset>
        </form>
    </div>
</div>

@endsection