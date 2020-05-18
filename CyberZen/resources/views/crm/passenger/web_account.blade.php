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
    .customer-container{
        margin-top: 20px;
        margin-bottom:20px;
    }
    #customer-profile{
    border-radius: 8px;
    background-color: #1A2E46;
    margin-left:auto;
    margin-right:auto;
    padding: 0px 30px 0px 30px;
    box-shadow: 0px 6px 9px #00000029;
    opacity: 1;
    }
    /* text color background etc */
    #customer-info{
        background: none;
        color: white;
        border:none;
        margin:0px;
    }
    #customer-card-balance{
        background:none;
        color: #F4C724;
        font-size: 40px;
        border:none;
        margin:0px;
        padding:0px;
    }
    /* Last load trans  background color font color*/
    #LLT{
        background: none;
        color: white;
        border:none;
        margin:0px;
        text-align:left;
        padding:0px;
    }
    /* Last trans  background color font color*/
    #LT{
        background: none;
        color: white;
        border:none;
        margin:0px;
        text-align: left;
        padding:0px;
    }
    #costumer-history{
        margin-right: 3%;
        margin-left: 3%;
    }
    /* TABLE MARGIN */
    .table{
        margin-left:auto;
        margin-right:auto;
    }
    #savebtn{
        border-radius: 8px;
        width: 50%;
        background-color: #1A2E46;
        margin-bottom:20px;
    }
    #savebtn2{
        border-radius: 8px;
        width: 50%;
        background-color: #1A2E46;
        margin-bottom:20px;
    }
    /* center botton */
    #save{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #save2{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #profile-password{
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 6px 9px #00000029;
        opacity: 1;
    }
    .table{
        background: #F6F6F6 0% 0% no-repeat padding-box;
        box-shadow: 0px 0px 4px #00000029;
        opacity: 1;
    }
    /* Validation */
    #result{
        float:right;
    }
    #passlenght{
        margin-top:5px;
        padding-left:20px;
        padding-right:20px;
    }
    #col1, #col2, #col3, #col4{
        background: #DCDCDC 0% 0% no-repeat padding-box;
        border: 1px solid #DCDCDC;
        opacity: 1;
        padding-left: 5px;
        padding-right:5px;
    }
    /* Mobile View Display none */
    .mobile-customer-container{
        display:none;
    }

    
    </style>
    {{-- WEBSITE VIEW --}}
    @if (session('login_status') == 'logged_in')
    <div class="container customer-container">
        
       
            
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
        <div class="row">
            <div class="col-sm">
                <div class="container" id="customer-profile">
                    @foreach ($data as $item)
                    <div class="alert alert-success" id="customer-info">
                        {{-- auth customer name --}}
                        <p>Hello {{$item->first_name}}, welcome back </p>
                    </div>
                    <div class="alert alert-success" id="customer-card-balance">
                        {{-- Auth Customer balance --}}
                        <strong>P {{$item->card_balance}}</strong>
                    </div>
                    @endforeach
                    <div class="row customer-transaction">
                        <div class="col-6"  id="last-load-trans">
                            <div class="alert alert-success" id="LLT">
                                <p>Last Load Transaction</p>
                                {{-- Auth Customer last load transaction --}}
                                @foreach ($latest_reload as $reload)
                                <p>P {{$reload->amount}}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-6" id="last-trans">
                            {{-- Auth Customer last transaction --}}
                            <div class="alert alert-success" id="LT">
                                <p>Last transaction</p>
                                @foreach ($latest_payment as $fare)
                                <p>P {{$fare->fare}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-5" id="profile-password">
                    <nav class="nav-tab p-3">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="My-profile" data-toggle="tab" href="#my-profile" role="tab" aria-controls="nav-home" aria-selected="true">My Profile</a>
                            <a class="nav-item nav-link" id="Change-password" data-toggle="tab" href="#change-passowrd" role="tab" aria-controls="nav-profile" aria-selected="false">Change Password</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="my-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                            
                            <form action="{{route('web-edit-profile')}}" method="POST">
                            @csrf
                            @method('PATCH')

                            @foreach ($data as $item)
                                
                            <input type="hidden" name="carduser_id" value="{{$item->carduser_id}}">

                            <div class="form-group mt-3">
                                <label for="PFname"><strong>First Name</strong></label>
                                <input type="text" class="form-control" id="PFname" name="PFname" value="{{$item->first_name}}">
                            </div>
                            <div class="form-group">
                                <label for="PMname"><strong>Middle Name</strong></label>
                                <input type="text" class="form-control" id="PMname" name="PMname" value="{{$item->middle_name}}">
                            </div>
                            <div class="form-group">
                                <label for="PLname"><strong>Last Name</strong></label>
                                <input type="text" class="form-control" id="PLname" name="PLname" value="{{$item->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="PEmail"><strong>Email</strong></label>
                                <input type="email" class="form-control" id="PEmail" name="PEmail" value="{{$item->email_address}}">
                            </div>
                            <div class="form-group">
                                <label for="PContact"><strong>Contact Number</strong></label>
                                <input type="text" class="form-control" id="PContact" name="PContact" value="{{$item->contact_number}}">
                            </div>
                            <div class="form-group" id="save">
                                <button type="submit" class="btn btn-secondary btn-sm save" id="savebtn">Save</button>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane fade" id="change-passowrd" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <p class="text mt-3">Enter your new password for Tapsakay account.</p>


                            <form action="{{route('web-edit-pw')}}" method="POST">
                                @csrf
                                @method('PATCH')
    
                            <div class="form-group">
                                <label for="currentpass"><strong>Current Password</strong></label>
                                <input type="password" class="form-control" id="currentpass" name="currentpass">
                            </div>

                            <input type="hidden" name="carduser_id" value="{{$item->carduser_id}}">

                            @endforeach

                            <div class="form-group">
                                <label for="currentpass"><strong>New Password</strong></label>
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
                                <label for="confirmpass"><strong>Confirm Password</strong></label>
                                <input type="password" class="form-control" id="confirmpass" name="confirmpass">
                            </div>
                            <div class="form-group" id="save2">
                                <input class="btn btn-primary" type="submit" value="Save" id="savebtn2">
                            </div>

                            </form>

                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-sm" id="customer-history">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            
                            <th scope="col">Date of Transaction</th>
                            <th scope="col">Distance Travelled</th>
                            <th scope="col">Fare</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result_fare as $rf)
                        
                        <tr>
                            
                            <td>{{date('M j, Y H:i', strtotime($rf->created_at))}}</td>
                            <td>{{$rf->totalKm}} Kilometers</td>
                            <td>{{$rf->fare}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{$result_fare->links()}}    
            </div>
        </div>
    </div>
    @else

    @endif
    






@endsection