@extends('crm.passenger.layouts.app')

@section('content')

<style>
#m-content{
    padding-top:20px;
}
.form{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 0.5px solid #D8D8D8;
    border-radius: 5px;
    opacity: 1;
    margin-bottom:50px;
}
/* Text Formats */
#m-change-pass{
    font-family: 'Lato', sans-serif;
    letter-spacing: 0px;
    color: #1A2E46;
    opacity: 1;
    font-size:16px;
    font-weight:800;
}
#m-change-text{
    font-family: 'Rubik', sans-serif;
    font-size: 13px;
    letter-spacing: 0px;
    color: #1A2E46;
    opacity: 1;
    
}
#m-currentpass, #m-newpass, #m-confirmpass {
    font-family: 'Lato', sans-serif;
    letter-spacing: 0px;
    color: #1A2E46;
    opacity: 1;

}
/* Button */
#savebtn2{
    background: #1A2E46 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000033;
    border: 0.5px solid #707070;
    opacity: 1;
    width: 100%;
    height: 40px;
    font-family: 'Rubik', sans-serif;
    font: Bold 20px/24px Rubik;
    font-weight: 700;
    
}
#passlenght{
    padding-right:25px;
    padding-left:25px;
    padding-top:5px;
}
#result{
    float:right;
}

</style>
    

<div class="container" id="m-content">
    <h6 id="m-change-pass">Change Password</h6>
    <p id="m-change-text">Enter your new password for Tapsakay account.</p>
    @if (session('msg_value') == 1)
    <p class=" text-success">
        {{session('password_msg')}}
    </p>
    @elseif(session('msg_value') == 0)
    <p class=" text-warning">
        {{session('password_msg')}}
    </p>
    @else
    
    @endif
    
    <div class="container form">
    <p id="m-change-pass-text"></p>

    <form action="{{route('mob-change-pass')}}">
    @csrf
    @method('GET')
    
        @foreach ($data as $item)                        
        <input type="hidden" name="carduser_id" value="{{$item->carduser_id}}">
        @endforeach

        <div class="form-group">
            <label id="m-currentpass"><strong>Current Password</strong></label>
            <input type="password" class="form-control" id="currentpass" name="currentpass">
        </div>
        <div class="form-group">
            <label id="m-newpass"><strong>New Password</strong></label>
            <input type="password" class="form-control" id="newpassword" name="newpassword">
            <div class="row" id="passlenght">
                <div class="col" id="col1"></div>
                <div class="col" id="col2"></div>
                <div class="col" id="col3"></div>
                <div class="col" id="col4"></div>
            </div>
            <span id="result"></span>
        </div>
        <div class="form-group">
            <label id="m-confirmpass"><strong>Confirm Password</strong></label>
            <input type="password" class="form-control" id="confirmpass" name="confirmpass">
        </div>
        <div class="form-group" id="save2">
            <input class="btn btn-primary" type="submit" value="SAVE" id="savebtn2">
        </div>
        
        </form>
    </div>  

    </div>

</div>
@endsection 