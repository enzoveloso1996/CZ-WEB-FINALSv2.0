@extends('crm.passenger.layouts.app')

@section('content')
<style>
    #mobile-profile{
        padding:10px;
        margin-bottom:40px;
    }
    #m-profile{
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #00000029;
        border: 0.5px solid #D8D8D8;
        border-radius: 5px;
        opacity: 1;
    }
    .profile-text{
        font-family: 'Lato', sans-serif;
        font-size:15px;
        font-weight: 900;
    }
    #savebtn{
        background: #1A2E46 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #00000033;
        border: 0.5px solid #707070;
        opacity: 1;
        width: 100%;
        height: 40px;
        font-family: 'Rubik', sans-serif;
        font: Bold 20px/24px Rubik;
    }
    .m-PFname, .m-PMname, .m-PLname, .m-PEmail, .m-PContact{
        letter-spacing: 0px;
        color: #1A2E46;
        opacity: 1;
        font-family: 'Rubik', sans-serif;
       
    }

</style>

<div class="container" id="mobile-profile">
    <p class="profile-text">My Profile</p>
    <div class="container" id="m-profile">

        <form action="{{route('mob-profile-change')}}">
        @csrf
        @method('GET')

        @foreach ($data as $item)
            
        <input type="hidden" name="carduser_id" value="{{$item->carduser_id}}">
        <div class="form-group mt-3">
            <label class="m-PFname"><strong>First Name</strong></label>
            <input type="text" class="form-control" id="PFname" name="PFname" value="{{$item->first_name}}">
        </div>
        <div class="form-group">
            <label class="m-PMname"><strong>Middle Name</strong></label>
            <input type="text" class="form-control" id="PMname" name="PMname" value="{{$item->middle_name}}">
        </div>
        <div class="form-group">
            <label class="m-PLname"><strong>Last Name</strong></label>
            <input type="text" class="form-control" id="PLname" name="PLname" value="{{$item->last_name}}">
        </div>
        <div class="form-group">
            <label class="m-PEmail"><strong>Email</strong></label>
            <input type="email" class="form-control" id="PEmail" name="PEmail" value="{{$item->email_address}}">
        </div>
        <div class="form-group">
            <label class="m-PContact"><strong>Contact Number</strong></label>
            <input type="text" class="form-control" id="PContact" name="PContact" value="{{$item->contact_number}}">
        </div>
        <div class="form-group" id="save">
            <button type="submit" class="btn btn-secondary btn-sm save" id="savebtn">Save</button>
        </div>

        @endforeach

        </form>

    </div>

</div>

@endsection