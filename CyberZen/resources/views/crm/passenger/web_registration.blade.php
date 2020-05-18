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
#content-form-container{
    margin:40px;
}
.form1{
    padding-top:10px;
    padding-left:10px;
}
.form2{
    padding-top:10px;
    padding-left:10px;
}
.progressbar .step::after{
    content:"";
    position:absolute;
    width: 6px;
    height:calc(80% - 70px);
    left:27px;
    top:15px;
    background-color:#F4C724;
    z-index: -1;  
    margin-top:35px;  
}
/* FORM 2 PROGRESS BAR COLOR SET TO #1A2E46 */
#form2{
    background-color:#1A2E46;
}

.bullet{
    height: 30px;
    width: 30px;
    border: solid 8px #1A2E46;
    border-radius: 100%;
    background-color: #F4C724;
    margin:0px;
}
.step{
    padding-top: 45px;
}
.step-next{
    position:absolute;
    left: 80px;
}

/* Text */
#step1{
    font-weight: 700;
    background-color:#1A2E46;
}
#Register-Text{
    margin-top:15px;
}
#progressbar-container{
background: transparent;
box-shadow: 0px 3px 6px #00000029;
border: 1px solid #707070;
border-radius: 8px;
opacity: 1;
margin: 0px 20px 20px 0px;
height: 200px!important;

}
/* botton */
#next{
border-radius: 8px;
width: 100%;
background-color: #1A2E46;
margin-bottom:20px;
}
#previous{
color:black;
background-color:transparent;
width: 37%;
border-radius: 8px;
border: black solid 1px;
margin-bottom:20px;
}
.form-register{
    background-color: #1A2E46;
    border-radius: 8px;
    width: 55%;
    margin-right:5px;
    margin-bottom:20px;
}
/* Stack fieldset above each other */
#tapsakayform > fieldset{
position: relative;
}
#tapsakayform > fieldset:not(:first-of-type) {
    display:none;
}
#form-image-container{
padding:0px!important;
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 3px 6px #00000029;
border: 1px solid #707070;
border-radius: 8px;
opacity: 1;
}
/* Image Container background color */
#image-container{
background-color:#1A2E46;

}
/* text format */
.profile-text{
color: #E4E4E4;

}
/* text-alignment */
#profile-text{
    text-align:center;
    margin:auto;
    padding-top: 80px;
}
.profile-text2{
    color: #E4E4E4;
    text-align:center;
    margin-bottom:20px;
    padding-top: 20px;

}
#register-your-card{
    text-align: center;
    margin-top: 20px;
}
#eye-icon{
    float:right;
    opacity:0.6;
    padding-right:5px;
    margin-top:-30px;  
}
#warning{
    text-align: left;
    font-family: 'Rubik', sans-serif;
    font-size: 10px;
    letter-spacing: 0px;
    color: #DF0514;
    opacity: 1;
    margin-bottom:5px;
}
#excla-icon{
    padding-right:10px;
}


</style>
<div class="container">
    <p id="register-your-card"><strong>Register your Card to get additional features!</strong></p>
</div>

<div class="row" id="content-form-container">
    <div class="col progressbar" id="progressbar-container">
        <div class="step">
          <p class="step-next"><strong> Step 1 - Basic Information</strong></p>
          <p class="bullet"></p>
        </div>
        <div class="step">
        <p class="step-next"><strong>Step 2 - Register</strong></p>
        <p class="bullet" id="form2"></p>
        </div>
    </div>
    <div class="col-sm-8" id="tapsakayform1">
        <div class="row" id="form-image-container">
            <div class="col-sm">
                <form id="tapsakayform" action="{{route('web-reg-success')}}">
                    @csrf
                    @method('GET')
                    
                    <fieldset class="form1">
                        <p id="warning"><strong><i class="fa fa-exclamation-circle" id="excla-icon" aria-hidden="true"></i>Please complete all require fields.</strong></p>
                            <div class="form-group">
                                <label for="cardnumber"><b>Card Number</b></label>
                                <input type="text" class="form-control" id="cardnumber" required>
                                <b class="form-text text-danger" id="cardError"></b>
                            </div>
                            <div class="form-group">
                                <label for="firstname"><b>First Name</b></label>
                                <input type="text" class="form-control" id="firstname" required>
                                <b class="form-text text-danger" id="firstnameError"></b>
                            </div>
                            <div class="form-group">
                                <label for="lastname"><b>Last Name</b></label>
                                <input type="text" class="form-control" id="lastname" required>
                                <b class="form-text text-danger" id="lastnameError"></b>
                            </div>
                            <div class="form-group">
                                <label for="middlename"><b>Middle Name</b></label>
                                <input type="text" class="form-control" id="middlename" required>
                                <b class="form-text text-danger" id="middlenameError"></b>
                            </div>
                            <div class="form-group">
                                <label for="password"><b>Password</b></label>
                                <input type="password" class="form-control" id="pass" required>
                                <b class="form-text text-danger" id="passError"></b>
                                <i class="fa fa-eye-slash fa-lg" aria-hidden="true" id="eye-icon"></i>
                            </div>
                            <div class="form-group">
                                <label for="confirmpass"><b>Confirm Password</b></label>
                                <input type="password" class="form-control" id="confirmpass" required>
                                <b class="form-text text-danger" id="confirmpassError"></b>
                                <i class="fa fa-eye-slash fa-lg" aria-hidden="true" id="eye-icon"></i>
                            </div>
                            <div class="form-group">
                                <label for="contactnum"><b>Contact Number</b></label>
                                <input type="text" class="form-control" id="contactnum" required>
                                <b class="form-text text-danger" id="contactnumError"></b>
                            </div>
                            <div class="form-group">
                                <label for="emailadd"><b>Email Address</b></label>
                                <input type="email" class="form-control" id="emailadd" required>
                                <b class="form-text text-danger" id="emailError"></b>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm next" id="next">Next</button>
                    </fieldset>
            
                    <fieldset class="form2">
                            <div class="form-group">
                                <label for="cardnumber"><b>Card Number</b></label>
                                <input type="text" class="form-control" id="cardnumberf2" name="cardnumber" required style="border:none; border-bottom:2px solid black">
                            </div>
                            <div class="form-group">
                                <label for="fname"><b>First Name</b></label>
                                <input type="text" class="form-control" id="firstnamef2" name="firstname" required style="border:none; border-bottom:2px solid black">
                            </div>
                            <div class="form-group">
                                <label for="lname"><b>Last Name</b></label>
                                <input type="text" class="form-control" id="lastnamef2" name="lastname" required style="border:none; border-bottom:2px solid black">
                            </div>
                            <div class="form-group">
                                <label for="mname"><b>Middle Name</b></label>
                                <input type="text" class="form-control" id="middlenamef2" name="middlename" required style="border:none; border-bottom:2px solid black">
                            </div>
                            <div class="form-group">
                                <label for="password"><b>Password</b></label>
                                <input type="password" class="form-control" id="passwordf2" name="password" required style="border:none; border-bottom:2px solid black">
                                <i class="fa fa-eye-slash fa-lg" aria-hidden="true" id="eye-icon"></i>
                            </div>
                            <div class="form-group">
                                <label for="contactnum"><b>Contact Number</b></label>
                                <input type="text" class="form-control" id="contactnumf2" name="contactnum" required style="border:none; border-bottom:2px solid black">
                            </div>
                            <div class="form-group">
                                <label for="emailadd"><b>Email Address</b></label>
                                <input type="email" class="form-control" id="emailaddf2" name="emailadd" required style="border:none; border-bottom:2px solid black">
                            </div>             
                            <input class="btn btn-primary form-register" type="submit" value="Register">
                            <button class="btn btn-primary previous" type="button" id="previous">Previous</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm" id="image-container">
                <div class="col-sm" id="profile-text">
                    <h3 class="profile-text"><strong>TapSakay</strong></h3><br>
                </div>
                <img src="/image/Group 143@2x.png" class="img-fluid" alt="Responsive image">
                <div class="col-sm">
                    <p class="profile-text2">Join the fastest and affordable way of transportation</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection