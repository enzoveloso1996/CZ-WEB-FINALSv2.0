@extends('crm.passenger.layouts.app')

@section('content')

<style>
#success-content{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 1px solid #707070;
    border-radius: 8px;
    opacity: 1;
    margin:50px auto;
    width:600px;

}
#registration-text{
    text-align: left;
    font-family: 'Lato', sans-serif;
    font-weight:900;
    letter-spacing: 0;
    color: #03BF3C;
    opacity: 1;
}
#success-text-logo{
    display: flex;
    align-items: center;
    justify-content: center;
}
#success-text-logo{
    padding-top:40px;
}
#card-text{
    margin-right:10px;
}
#card-text{
    padding-left:150px;
    opacity: 0.7;
    font-family: 'Rubik', sans-serif;
    letter-spacing: 0;
    color: #0A0A0A;


}
#cnumber-text{
    font-family: 'Rubik', sans-serif;
    letter-spacing: 0;
    color: #0A0A0A;
    opacity: 1;
    font-weight: 600;
}
#image-done{
    height: 220px;
    width: 280px;
}
#done-login{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom:50px;
}
#here{
    color:#F4C724;
}

</style>

<div class="container" id="web-success-container">
    <div class="container" id="success-content">
        <div class="container" id="success-text-logo">
            <h4 id="registration-text"> <img src="/image/circle_ok.png" id="check"> You're registration is successful!</h4>
        </div>
        <div class="col" id="registration-success">
            <div class="row">
                <p id="card-text">Card Number :</p>
                <p id="cnumber-text">{{$card_number}}</p>
            </div>
            <div class="row">
                <p id="card-text">Card Type :</p>
                <p id="cnumber-text">
                    @if ($card_type == 1)
                        Regular
                    @elseif($card_type == 2)
                        Discounted
                    @endif
                </p>
            </div>
        </div>
        <div class="container" id="image-done">
            <img src="/image/undraw_done_a34v@2x.png" class="img-fluid" alt="Responsive image">
        </div>
        <div class="container" id="done-login">
            <h6>Login to your Account! <a  data-toggle="modal" data-target="#loginModal" href="#" role="button">Here</a></h6>
        </div>
    </div>
</div>


@endsection