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

    <div class="container pb-3">
        <p class="text mt-3"><strong>Lost this card? You can hold this card and transfer
                your balance to your new card.</strong></p>
        @if (session('card_status') == 0)
        <button class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal"
            type="button">Hold</button>                                
        @endif
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="exampleModalLabel">Are you sure?</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('mob-hold-card')}}" method="post">
                    @csrf
                    @method('PATCH')
                    
                    <input type="hidden" name="carduser_id" value="{{$item->carduser_id}}">

                    <div class="container p-5">
                        <div class="alert alert-danger">
                            <span class="text-danger">Are you sure you want to hold this card? This action cannot be undone.
                                This will permanently hold your card.</span><br>
                        </div>
                        <span>To continue please enter this code <span id="random"></span></span>
                        <input type="hidden" name="code" value="" id="random_input">
                        <input type="text" name="code_input" class="form-control" id="code">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>    
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function send() {
        const sendto = document.getElementById("card-number").value;
        const amounts = document.getElementById("amounts")

        if (sendto.length == 10) {
            amounts.style.display = "block";
        } else {
            amounts.style.display = "none";
        }
    }




    function random_item(items) {
        return items[Math.floor(Math.random() * items.length)];
    }

    var items = [254, 45, 212, 365, 254, 123, 849, 578, 345, 111];
    var rand = random_item(items);

    $("#random").append(rand);
    $("#random_input").val(rand);
</script>

@endsection 