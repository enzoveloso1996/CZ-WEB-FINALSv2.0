<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500&display=swap" rel="stylesheet"> 
        <title>Tapsakay</title>
        
    <style>
  
      .tapsakay{
        color:white;
        padding: 10px 0px 10px 0px;
        margin:0px;
        font-family: 'Lato', sans-serif;
        font: Bold 20px/22px Lato;

      }
      /* NAVBAR */
      .navbar{
        width: 100%;
      }
      #nav-tapsakay-logo{
        height: 50px;
        width: 50px ;
      }
      .nav-links  > li{
        list-style: none;
        padding-bottom:10px;
      }
      #m-taplogo{
        padding:10px 20px 10px 20px;
      }
      .nav-links > li a {
        font-family: 'Lato', sans-serif;
        letter-spacing: 0px;
        color: #A9BED6;
        opacity: 1;
        
      }
      .nav-links  li  a:hover{
      color: #F4C724;
      text-decoration: underline;
      color:#F4C724;
      }
      /* DROPDOWN */
      /* DROPDOWN */
    .dropdown{
      padding:0px 10px 10px 0px;
      position: relative;
      display: inline-block;
    }
    .dropdown > li > a {
      font-family: 'Lato', sans-serif;
      letter-spacing: 0px;
      color: #A9BED6;
      opacity: 1;
      font-size: 20px;
    }
    .dropdown-content {
      display: none;
      position: relative;
      overflow: auto;
    }
    .dropdown-content > li  {
      color: #A9BED6;
      padding-left:60px;
      width: 100%;
      text-decoration: none;
      display: block;
      padding-top:10px;
    }
    .dropdown-content > li > a{
      color: #A9BED6;
      font-family: 'Lato', sans-serif;
      letter-spacing: 0px;
      opacity: 1;
      font-size:20px;
      
    }
    

    .show {
      display: block;
    }
      .toggle{
        width: 100%;
        padding: 10px 20px;
        background:#1A2E46;
        text-align:left;
        font-size: 30px;
        display: none;
      }
      .menu{
        color:#F4C724;
      }
      /* Navi-Items Hide */
      #mobile-trans, #mobile-settings, #mobile-login{
        display: none;
      }
      .menu2, .mobile-text{
        display:none;
      }
      /* Hide ICons */
      #iconH, #iconA, #iconC, #iconT, #iconS, #iconL{
        display: none;
      }
      /* MODAL DESIGN */
      /* modal button */
      .button-modal-login{
      background: #D9D9D7 0% 0% no-repeat padding-box;
      border-radius: 28px;
      opacity: 1;
      color:#1A2E46!important;
      font-family: 'Lato', sans-serif;
      font-weight: 900;
      width: 100px;
      margin-right:10px;
      }
      /* modal-register-btn */
      .button-modal-register{
      background: #D9D9D7 0% 0% no-repeat padding-box;
      border-radius: 28px;
      opacity: 1;
      width: 100px;
      color:#1A2E46!important;
      font-family: 'Lato', sans-serif;
      font-weight: 900;
      }
      /* BUTTON  FOCUS */
      .button-modal-register:focus {
        background-color: #F4C724;
      }
      .button-modal-login:focus {
        background-color: #F4C724;
      }
     
      /* position of modal */
      .login-modal{
      padding-top:100px;
        
      }
      /* size of modal */
      .modal-body{
        height: 500px;
      }
      /* size of logo */
      #tapsakay-modal-logo{
        height: 150px ;
        width: 150px ;
        position: center;
      }
      /* center image */
      .body-content{
        display: flex;
        align-items: center;
        justify-content: center;
      }
      /* Center Text of modal */
      .login-modal-text{
        display: flex;
        align-items: center;
        justify-content: center;
      }
      /* text formats */
      #policy{
        padding: 20px 40px 20px 40px;
        font-family: 'Rubik', sans-serif;
        text-align: center;
        font-size: 15px;
        margin-top:40px!important;
      }
      #reg-now{
        text-align: center;
        font: Bold 13px/15px Rubik;
        letter-spacing: 0px;
        color: #090909;
        opacity: 1;
      }
      #tap1{
      letter-spacing: 0;
      color: #F1C524;
      opacity: 1;
      font-size: 25px;
      padding-left:10px;
      font-family: 'Lato', sans-serif;
      font-weight: 900;
      }
      #welcome-to{
      opacity: 1;
      font-size: 25px;
      letter-spacing: 0;
      font-family: 'Lato', sans-serif;
      font-weight: 900;
      }
      /* botton position */
      .pass{
        width: 400px;
        margin:auto;  
        margin-top:30px;
        margin-left:33px;
        margin-right:33px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #0000003D;
        border: 0.5px solid #707070;
        border-radius: 8px;
        opacity: 1;
      }
      .card{
        width: 400px;
        margin:auto;
        margin-top:20px;
        margin-left:33px;
        margin-right:33px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #0000003D;
        border: 0.5px solid #707070;
        border-radius: 8px;
        opacity: 1;
      }
      /* botton container */
      .login-btn{
        display: flex;
        align-items: center;
        justify-content: center;
      }
      #login-btn{
        background: #1A2E46 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #0000003D;
        border: 0.5px solid #707070;
        border-radius: 8px;
        opacity: 1;
        width: 400px;
        margin:auto; 
        margin-top:30px;
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
      }
     
      .modal-footer-login > p {
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
      #mobile-logo{
        height: 30px;
        width: 30px;
      }
      /* FOOTER */
          /* Footer */
    #website-footer{
        background-color: #1A2E46FC;
    }
    .tap-footer{
    font-size: 20px;
    color: #F4C724;
    margin-bottom:0px;
    font-family: 'Rubik', sans-serif;
    padding-top:30px;

    }
    #taplogo-footer{
    max-width: 10vw;
    height: 3vw;
    width: 3vw;
    background: transparent;
    border: none;
    padding-top:5px;
    position: relative;
    background-color: #1A2E46;
    }
    /* text */
    #footer-text1, #footer-text3, #footer-text5, #footer-text6, #footer-text8, #footer-text9, #footer-text10{
        color:#E4E4E4;
        font-size: 12px;
        font-family: 'Rubik', sans-serif;


    }
    #footer-text2, #footer-text4, #footer-text7{
        color: #F4C724;
        font-size: 20px;
        margin-bottom:0px;
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
    }
    /* Footer Logo */
    #footer-contact-logo, #footer-email-logo{
        height: 20px!important;
        width: 20px!important;
        margin-right:10px;
    }
    #footer-text10{
       margin:auto;
       
    }
    #cyberzen-copyright{
        height: 80px;
        display: flex;
        border-top: solid #F4C724 2px;
    }
    #mobile-footer{
      display:none;
    }
    #m-nav-home, #m-nav-about, #m-nav-contact{
      display:none;
    }
    
      /* MOBILE VIEW */
      @media (max-width: 768px) {
        /* Hide Items */
        #botton-register{
          display: none;
        }
        #modal-login{
          display: none;
        }
        #nav-home, #nav-about, #nav-contact{
          display:none;
        }
        /* Items Show */
        #mobile-trans, #mobile-settings, #mobile-login{
        display: block;
      }
        .menu2, .mobile-text{
          display:block;
        }
        .toggle{
          display:block;
          padding:10px;
        }
        .tapsakay{
          display: none;
        }
        #m-nav-home, #m-nav-about, #m-nav-contact{
          display:block;
        }
        .nav-links{
          position:absolute;
          left:-100%;
          height: 100vh;
          top:0vh;
          width: 80%;
          background-color: #1A2E46;
          display: flex;
          flex-direction: column;
          justify-content: flex-start!important;
          align-items: left;
          z-index: 1;
        }
        /* CONTACT DESIGN */

        /* HOVER FOR MOBILE */
        .dropdown a:hover {
        color: #F4C724;
        border-left: #F4C724 3px solid;
        }
        .nav-links > li {
          font-size:20px;
        }
        .nav-links > li > a:hover {
        color: #F4C724;
        border-left: #F4C724 3px solid;
        
        }
        #toggle-logo{
          height: 20px;
          width: 20px;
        }
        .mobile-header{
         font-family: 'Lato', sans-serif;
         font-size: 20px;
         color: #E4E4E4;
         text-align: center;
        }
        .menu{
          float: left;
          font-size:40px;
        }
        .active {
        transition: all .5s;
        left:0px;
        }
        #mobile-logo{
          float: left;
          height: 40px;
          width: 40px;
          margin-right:10px;
        }
        .mobile-text{
          color:#F4C724;
          font-family: 'Lato', sans-serif;
          font-size: calc(30px - 5px);
        }
        .menu2{
          float: right;
          font-size:40px;
          color:#F4C724;
        }
        /* ICONS */
        #iconH, #iconA, #iconC, #iconT, #iconS, #iconL{
          font-size: 30px;
          margin-right:10px;
          display:inline-block;
      }
        /* FOOTER MOBILE */
        #website-footer{
          display:none;
        }
        #mobile-footer{
          display:block;
        }
        #mobile-footer{
                background-color: #1A2E46FC;
                
            }
        #mobile-taplogo-footer{
            background: transparent;
            height: 30px;
            width: 30px;
        }
        .mobile-footer-text{
            font-size: 20px;
            letter-spacing: 0;
            color: #E4E4E4;
            opacity: 1;
            text-align: center;
            margin-bottom:0px;
            padding-top:30px;
            font-family: 'Rubik', sans-serif;
        }
        #mobile-footer-text2{
            font-family: 'Rubik', sans-serif;
            letter-spacing: 0;
            color: #E4E4E4;
            opacity: 1;
            text-align: center;
            font-size: 12px;
        }
        #mobile-footer-text3{
            text-align: left;
            font: 17px/8px Rubik;
            letter-spacing: 0;
            color: #E4E4E4;
            opacity: 1;
            padding-top:30px;
            text-align: center;
            font-size: 10px;
        }

        .mobile-about{
            text-align: center;
            font-family: 'Rubik', sans-serif;
            font-size:15px;
            font-weight: 700;
            letter-spacing: 0;
            color: #F4C724;
            opacity: 1; 
            margin-bottom:10px;
        }
        .mobile-contact{
            text-align: center;
            font-family: 'Rubik', sans-serif;
            font-size:15px;
            font-weight: 700;
            letter-spacing: 0;
            color: #F4C724;
            opacity: 1; 
            margin-bottom:10px;
        }
        #mobile-about-contact{
            margin-bottom:40px;
        }
        #mobile-cyberzen-copyright{
            border-top: solid #F4C724 2px;
            height: 60px;
            
            
        }
      }

    </style>
 
</head>
  <body>
    <nav class="navbar" style="background-color:#1A2E46FC">
      <div class="toggle">
        <i class="fa fa-bars menu" aria-hidden="true"></i>
        <p class="mobile-header">TapSakay <img src="/image/tap@2x.png" id="toggle-logo"></p>
      </div>
      <span class="navbar-brand mb-0 h1 tapsakay">TapSakay
        <img src="/image/tap@2x.png" id="nav-tapsakay-logo">
      </span>
      <ul class="nav justify-content-end nav-links">
        <li class="nav-item" id="m-taplogo">
          <i class="fa fa-bars menu2" aria-hidden="true"></i>
          <p class="mobile-text"><img src="/image/Untitled-1-02.png" id="mobile-logo" class="img-fluid" alt="Responsive image"> TapSakay</p>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('home')}}" id="nav-home"><i class="fa fa-home"  aria-hidden="true" id="iconH"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#aboutsection" id="nav-about"><i class="fa fa-info-circle" aria-hidden="true" id="iconA"></i>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contactsection" id="nav-contact"><i class="fa fa-phone-square" aria-hidden="true" id="iconC"></i>Contact</a>
        </li>

        {{-- Mobile Nave --}}
        <li class="nav-item">
          <a class="nav-link active" href="{{route('home')}}" id="m-nav-home"><i class="fa fa-home"  aria-hidden="true" id="iconH"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="m-nav-about"><i class="fa fa-info-circle" aria-hidden="true" id="iconA"></i>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="m-nav-contact"><i class="fa fa-phone-square" aria-hidden="true" id="iconC"></i>Contact</a>
        </li>

        @if (session('login_status') == 'logged_in')
        
        <li class="nav-item">
          <a class="nav-link" href="{{route('m-transaction', ['carduser_id' => session('carduser_id')])}}" id="mobile-trans"><i class="fa fa-history" aria-hidden="true" id="iconT"></i>Transaction History</a>
        </li>
        
        <div class="dropdown">
          <li class="nav-item">
            <a class="nav-link dropbtn" href="javascript:void(0);" onclick="myFunction()" id="mobile-settings" role="button"><i class="fa fa-cog" aria-hidden="true" id="iconS"></i>Settings</a>
          </li>
          <div class="dropdown-content" id="myDropdown">
            <li class="nav-item"> <a class="nav-item" href="{{route('profile-index', ['carduser_id' => session('carduser_id')])}}">My Profile</a></li>
            <li class="nav-item"><a class="nav-item" href="{{route('password-index', ['id' => session('carduser_id')])}}">Change Password</a></li>
          </div>
        </div>
            
        @endif

        @if (session('login_status') == 'logged_in')
        <li class="nav-item" id="modal-login">
          <a type="button"  class="btn btn-primary button-modal-login"  href="{{route('web-logout')}}" role="button">Log Out</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="{{route('mob-logout')}}" id="mobile-login" id="nav-login"><i class="fa fa-sign-in" aria-hidden="true" id="iconL"></i></i>Log Out</a>
        </li>

        @else
        <li class="nav-item" id="modal-login">
          <a type="button"  class="btn btn-primary button-modal-login" data-toggle="modal" data-target="#loginModal" href="#" role="button">Login</a>
        </li>
        
        {{-- mobile login button --}}
        <li class="nav-item">
          <a class="nav-link" href="{{route('mob-login-index')}}" id="mobile-login" id="nav-login"><i class="fa fa-sign-in" aria-hidden="true" id="iconL"></i></i>Login</a>
        </li>
        
        @endif
        
        {{-- MODAL --}}
        <div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content login-content">
              {{-- header and x Botton--}}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
               {{-- modal content --}}
              <div class="modal-body">
                {{-- Modal Image --}}
                <div class="body-content">
                  <img src="/image/Group 145@2x.png" id="tapsakay-modal-logo">
                </div>
                {{-- text --}}
                <div class="row login-modal-text"> 
                  <h5 id="welcome-to">Welcome to</h5> <h5 id="tap1">TAPSAKAY</h5>
                </div>
                {{-- Input type --}}

                <form action="{{Route('web-login')}}" method="post">
                  @csrf
                  @method('GET')

                  <div class="input-group">
                    <input class="form-control card" type="text" placeholder="Card Number" name="card_number">
                  </div>
                  <div class="input-group">
                    <input class="form-control pass" type="password" placeholder="Password" name="password">  
                  </div>
                  {{-- Buton --}}
                  <div class="row login-btn">
                    <button type="submit" class="btn btn-secondary login-btn" id="login-btn">Log in</button>
                  </div>
                </form>
                <h6 id="policy">By continuing, you agree to Tapsakay's Terms of Service, Privacy Policy</h6>
              </div>
              {{-- footer --}}
              <div class="modal-footer-login">
                <p id="reg-now"> Not on Tapsakay yet? Register Now!</p>
              </div>
            </div>
          </div>
        </div>
      </li>
      @if (session('login_status') == 'logged_in')
      <li class="nav-item" id="botton-register">
        <li class="nav-item" id="modal-login">
          <a type="button"  class="btn btn-primary button-modal-login"  href="{{route('transaction', ['carduser_id' => session('carduser_id')])}}" role="button">Account</a>
        </li>
      </li>
      @else
        <li class="nav-item" id="botton-register">
          <a type="button" class="btn btn-primary button-modal-register" href="{{route('web-registration')}}" >
            Register
          </a>
        </li>
      @endif
      
  </ul>
  </nav> 








 @yield('content')


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


        {{-- DROP DOWN Script --}}
<script>  
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
      
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
</script>


        {{-- MOBILE NAV Script --}}
<script>
  $(document).ready(function(){
      $('.menu').click(function(){
      $("ul").toggleClass("active");
    });
  });
  
  $(document).ready(function(){
    $('.menu2').click(function(){
    $("ul").toggleClass("active");
    });
  });
</script>

        {{-- Mobile view Changing Content --}}
<script>
    if ((screen.width < 769)){
      $("#m-nav-about").click(function(){
        $('.HOME').hide();
        $('.CONTACT').hide();
        $('.ABOUT').show();
        $("#WEBSITE").css("background-image", "none");
    });
      $("#m-nav-contact").click(function(){
        $('.HOME').hide();
        $('.CONTACT').show();
        $('.ABOUT').hide();
        $("#WEBSITE").css("background-image", "none");
    });
        
      $("#m-nav-home").click(function(){
        $('.HOME').show();
        $('.CONTACT').hide();
        $('.ABOUT').hide();
        $('#WEBSITE').css("background-image", "url(/image/tapsakay.jpg)");
    });
  }
</script>

        {{-- WEBSITE ACCOUNT FORM VALIDATION --}}
<script>
  $(document).ready(function(){
    $("#Change-password").click(function(){
        $("#my-profile").hide();
        $("#change-passowrd").show();
      });
    $("#My-profile").click(function(){
        $("#change-passowrd").hide();
        $("#my-profile").show();
      });
    });
          
    $(document).ready(function() {
      $('#newpassword').keyup(function() {
      $('#result').html(checkStrength($('#newpassword').val()))
    })
    
    function checkStrength(password) {
      var strength = 0
      if (password.length < 6) {
        $('#result').removeClass()
        $('#result').addClass('short')
        $('#result').css("color", "red");
        $("#col1").css("border-top", "red solid 3px");
        $("#col2").css("border-top", "#DCDCDC solid 3px");
        $("#col3").css("border-top", "#DCDCDC solid 3px");
        $("#col4").css("border-top", "#DCDCDC solid 3px");
        return 'Very Weak'
      }
          
      if (password.length > 7) strength += 1
          // If password contains both lower and uppercase characters, increase strength value.
    
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
          // If it has numbers and characters, increase strength value.
          
      if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
          // If it has one special character, increase strength value.
          
      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
          // If it has two special characters, increase strength value.
          
      if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
          // Calculated strength value, we can return messages
          
      // If value is less than 2
      if (strength < 2) {
        $('#result').removeClass()
        $('#result').addClass('weak')
        $('#result').css("color", "#FCDD13");
        $("#col1").css("border-top", "#FCDD13 solid 3px");
        $("#col2").css("border-top", "#FCDD13 solid 3px");
        $("#col3").css("border-top", "#DCDCDC solid 3px");
        $("#col4").css("border-top", "#DCDCDC solid 3px");
        return 'So-so'
      }

      else if (strength == 2) {
      $('#result').removeClass()
      $('#result').addClass('good')
      $('#result').css("color", "Green");
      $("#col1").css("border-top", "#14C900E3 solid 3px");
      $("#col2").css("border-top", "#14C900E3 solid 3px");
      $("#col3").css("border-top", "#14C900E3 solid 3px");
      $("#col4").css("border-top", "#DCDCDC solid 2px");
        return 'Good'
      } 
      
      else {
        $('#result').removeClass()
        $('#result').addClass('strong')
        $("#col1").css("border-top", "green solid 3px");
        $("#col2").css("border-top", "green solid 3px");
        $("#col3").css("border-top", "green solid 3px");
        $("#col4").css("border-top", "green solid 3px");
          return 'Great'
      }
    }
  });        
</script>

        {{-- REGISTER  SCRIPT WEB AND MOBILE VIEW--}}
<script>
  $(document).ready(function() {

  $(".next").click(function(e){
      e.preventDefault();
      if($("#cardnumber").val() == ''){
        $("#cardError").html('* Card Number is required.');
        return false;
      }
      else if($("#firstname").val() == ''){
        $("#firstnameError").html('* First name is required.');
        return false;
      }
      else if($("#lastname").val() == ''){
        $("#lastnameError").html('* Last name is required.');
        return false;
      }
      else if($("#middlename").val() == ''){
        $("#middlenameError").html('* Middle name is required.');
        return false;
      }
      else if($("#pass").val() == ''){
        $("#passError").html('* Password is required.');
        return false;
      }
      else if($("#confirmpass").val() == ''){
        $("#confirmpassError").html('* Confirm password is required.');
        return false;
      }
      else if($("#contactnum").val() == ''){
        $("#contactnumError").html('* Contact number is required.');
        return false;
      }
      else if($("#emailadd").val() == ''){
        $("#emailError").html('* Contact number is required.');
        return false;
      }

      var pass = $("#pass").val();
      var confpass = $("#confirmpass").val();
      // if( pass == confpass){
        $('#cardnumberf2').val($('#cardnumber').val());
        $('#firstnamef2').val($('#firstname').val());
        $('#lastnamef2').val($('#lastname').val());
        $('#middlenamef2').val($('#middlename').val());
        $('#passwordf2').val($('#pass').val());
        $('#contactnumf2').val($('#contactnum').val());
        $('#emailaddf2').val($('#emailadd').val());
    
        $(".form2").show();
        $(".form1").hide();
        $("#form2").css("background-color", "#F4C724");
      // }else{
      //   $("#confirmpassError").html('* Password and Confirm password Mismatch.');
      //   return false;
      // }
      
  
    });
    $(".previous").click(function(){
      $(".form2").hide();
      $(".form1").show();
      $("#form2").css("background-color", "#1A2E46");
    });
  });

  $(document).ready(function(){
    if ((screen.width < 769)) {
      $(".next").click(function(){
          if($("#cardnumber").val() == ''){
              $("#mobile-cnumberError").html('* Card Number is required.');
              return false;
          }
          else if($("#firstname").val() == ''){
              $("#mobile-fnameError").html('* First name is required.');
              return false;
          }
          else if($("#lastname").val() == ''){
              $("#mobile-lnameError").html('* Last name is required.');
              return false;
          }
          else if($("#middlename").val() == ''){
              $("#mobile-mnameError").html('* Middle name is required.');
              return false;
          }
          else if($("#pass").val() == ''){
              $("#mobile-passError").html('* Password is required.');
              return false;
          }
          else if($("#confirmpass").val() == ''){
              $("#mobile-confirmpassError").html('* Confirm password is required.');
              return false;
          }
          else if($("#contactnum").val() == ''){
              $("#mobile-contactnumError").html('* Contact number is required.');
              return false;
          }
          else if($("#emailadd").val() == ''){
              $("#mobile-emailaddError").html('* Contact number is required.');
              return false;
          }
      
        
      $(".form2").show();
      $(".form1").hide();

    });
      $(".cancel").click(function(){
        $(".form1").show();
        $(".form2").hide();
      });
    
    }
  });
</script>
        {{-- Web Check Balance Script --}}
<script>
  $(document).ready(function(){
      $(".check-balance").click(function(){
          
          if($("#cardbaltextbox").val() == ''){
            $("#checkbalance-error").html('Invalid/incorrect card number');
            return false;
          }
          
          // $(".balance-output").show();
          // $(".balance-input").hide();
          // $(".balance").hide();
      });
      
  });
  </script>


  <script>
  @if(session('bal_status') == "success")
  $(document).ready(function(){
     $('#staticBackdrop2').modal('show');
      
  });
  @endif

 

  </script>


</body>


{{-- FOOTER --}}
{{-- WEBSITE FOOTER --}}
<footer class="footer" id="website-footer">
  <div class="container">
      <p class="tap-footer"><strong>TapSakay<img src="/image/tap@2x.png" id="taplogo-footer"></strong></p>
      <p id="footer-text1">Cashless Fare Payment</p>
  </div>
  <div class="container">
      <div class="row">
          <div class="col-6" id="footer-about">
              <p id="footer-text2"><strong>About Us</strong></p>
              <p id="footer-text3">The TapSakay is a convenient fare payment system for E-Jeepneys public commuters. 
                  TapSakay Card will be used as a fare payment on public E-Jeepney transport.</p>
          </div>
          <div class="col-sm">
              <p id="footer-text4"><strong>Contact Us</strong></p>
              <img src="/image/contact.png" class="img-fluid float-left" alt="Responsive image" id="footer-contact-logo">
              <p id="footer-text5">(02) 779-31862</p>
              <img src="/image/message.png" class="img-fluid float-left" alt="Responsive image" id="footer-email-logo">
              <p id="footer-text6">cyberzen@gmail.com</p>
          </div>
          <div class="col-sm">
              <p id="footer-text7"><strong>Helpful Links</strong></p>
              <p id="footer-text8">Terms and Conditions</p>
              <p id="footer-text9">Privacy Policy</p>
          </div>
      </div>
  </div>
  <div class="container" id="cyberzen-copyright">
      <p id="footer-text10">2020 © Cyberzen. All rights reserved.</p>
  </div>
</footer>



{{-- Mobile Footer --}}
<footer id="mobile-footer">
    <div class="container">
      <p class="mobile-footer-text"><strong>TapSakay<img src="/image/tap@2x.png" id="mobile-taplogo-footer"></strong></p>
      <p id="mobile-footer-text2">Cashless Fare Payment</p>
    </div>
    <div class="container" id="mobile-about-contact">
      <h3 class="mobile-about">About Us</h3>
      <h3 class="mobile-contact">Contact Us</h3>
    </div>
    <div class="container" id="mobile-cyberzen-copyright">
      <p id="mobile-footer-text3">2020 © Cyberzen. All rights reserved.</p>
    </div>
</footer>

</html>
