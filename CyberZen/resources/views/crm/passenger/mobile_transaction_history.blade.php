@extends('crm.passenger.layouts.app')

@section('content')

<style>
.mobile-customer-container{
    display:block;
    margin-left:0px!important;
    margin-right:0px!important;
    padding:0px!important;
}
#mobile-customer-profile{
    background: #1A2E46 0% 0% no-repeat padding-box;
    opacity: 1;
    margin-right:0px;
    margin-left:0px;
}
#mobile-customer-info{
    background: none;
    border:none;
    margin:0px;
    text-align: left;
    font: Regular 13px/15px Rubik;
    letter-spacing: 0px;
    color: #FFFFFF;
    opacity: 1;
    padding-left:5px;
}
#mobile-customer-card-balance{
    background:none;
    color: #F4C724;
    font-size: 40px;
    border:none;
    margin:0px;
    padding:0px;
}
.currentbalance-label{
    font-family: 'Lato', sans-serif;
    font-size: calc(30px - 10px) ;
    letter-spacing: 0px;
    color: #FFFFFF;
    opacity: 1;
    text-align: center;
    margin-bottom:0px;
}
/* Text */
.m-customerbalance{
    font-family: 'Lato', sans-serif;
    text-align: center;
    letter-spacing: 0px;
    color: #F4C724;
    opacity: 1;
    font-weight: 900;
}
#mobile-LLT{
    background: #F4C724 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border-radius: 5px;
    opacity: 1;
    margin-bottom:0px!important;
    padding-right:0px!important;
    padding-left:0px!important;
    
}
#mobile-LT{
    background: #F4C724 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border-radius: 5px;
    opacity: 1;
    margin-bottom:0px!important;
    padding-right:0px!important;
    padding-left:0px!important;
}
#m-last-load-trans{
    padding-right:0px!important;
    margin-bottom:0px!important;
    padding-left:0px!important;
    
}
#m-last-trans{
    padding-left:0px!important;
    margin-bottom:0px!important;
    padding-right:0px!important;
    
}
/* Text Formats */
.mLLT-Amount, .mLT-Amount{
    text-align: center;
    color:#000000;
    font-family: 'Rubik', sans-serif;
    font-size:  16px;
    font-weight: 600;
    
}
.mLLT-Text, .mLT-Text{
    color:#545454;
    font-family: 'Rubik', sans-serif;
    text-align: center;
    font-size: 12px;
    font-weight: 500;
}
.mobile-customer-transaction{
    padding-left:0px;
    padding-right:0px;
    margin-left:10px;
    margin-right:10px;
    margin-top:-50px;
}
#mobile-transaction-history{
    margin-left:0px!important;
    margin-right:0px!important;
}
.m-transaction-Text{
    font-family: 'Rubik', sans-serif;
    letter-spacing: 0px;
    color: #1A2E46FC;
    opacity: 1;
    padding-top:5px;
    font-weight: 500;
}
.m-L-T{
    font-family: 'Rubik', sans-serif;
    letter-spacing: 0px;
    color: #1A2E46FC;
    opacity: 1;
    font-size: 15px;
    font-weight: 600;
    margin-bottom:0px!important;
}
.m-D-T{
    letter-spacing: 0px;
    color: #1A2E46FC;
    opacity: 1;
    font-family: 'Rubik', sans-serif;
    font-size: 12px;
    margin-bottom:0px!important;
}

.img-thumbnail-mobile{
    width: 40px;
    height: 40px;
    margin-left: auto;
    margin-right: auto;
    padding: 0px;
    text-align: center;
}

.transaction-table{
    background-color:#FFFFFF;
}
#M.Welcome{
    font-family: 'Rubik', sans-serif;

}

</style>

<div class="container-fluid mobile-customer-container">
    <div class="row">
        <div class="col-sm">
            @foreach ($data as $item)
                
            
            <div class="container-fluid" id="mobile-customer-profile">
                <div class="alert alert-success" id="mobile-customer-info">
                    {{-- auth customer name --}}
                    <p id="M.Welcome">Hello {{$item->first_name}}, welcome back </p>
                </div>
                @if (session('card_status') == 1)
                <span class="text-danger">
                    Your Card is currently on-hold, Please update your new Card Number
                    <a class="text-danger font-weight-bolder" href="javascript:viod{0}" data-toggle="modal"
                        data-target="#change-card-number" type="button">
                        here.
                    </a>
                </span>
                @endif
                <div class="alert alert-success" id="mobile-customer-card-balance">
                    <p class="currentbalance-label">CURRENT BALANCE</p>
                    {{-- Auth Customer balance --}}
                    <p class="m-customerbalance">P {{$item->card_balance}}</p>
                </div>
            <br>
            <br>
            <br>
            </div>  
            @endforeach
        </div>
       
    </div>
 
    <div class="modal fade" id="change-card-number" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="exampleModalLabel">Change card number</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('web-change-cardnumber')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="container p-5">
                        <input type="hidden" name="carduser_id" value="{{$item->carduser_id}}">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Old card number:</label>
                            <input type="number" class="form-control" placeholder="xxxxxxxxxx" required name="old_card_number">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">New card number:</label>
                            <input type="number" class="form-control" placeholder="xxxxxxxxxx" required name="new_card_number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mobile-customer-transaction">
        <div class="col-6"  id="m-last-load-trans">
            <div class="alert alert-success" id="mobile-LLT">
               
                <p class="mLLT-Amount">P 
                    @foreach ($latest_reload as $reload)
                    {{$reload->amount}}
                    @endforeach
                </p>

                <p class="mLLT-Text">Last Load Transaction</p>
                    {{-- Auth Customer last load transaction --}}
            </div>
        </div>
        <div class="col-6" id="m-last-trans">
                {{-- Auth Customer last transaction --}}
            <div class="alert alert-success" id="mobile-LT">
                
                <p class="mLT-Amount">P 
                    @foreach ($latest_payment as $payment)
                    {{$payment->fare}}
                    @endforeach
                </p>
                
                <p class="mLT-Text">Last Fare transaction</p>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="mobile-transaction-history">
        <p class="m-transaction-Text">Transaction</p>

        

        <br/>

        <table class="table table-bordered">            
            <tbody class="transaction-table">
            @foreach ($result_union as $ru)
            
              <tr>
                <td style="width: 10%;"> 
                    {{-- Icon ????? --}}
                    @if (data_get($ru, 'type') == 1)
                    <img src="/image/load.png" class="float-right img-thumbnail-mobile" id="mobile-transaction-icon">

                    @else
                    <img src="/image/fare.png" class="float-right img-thumbnail-mobile" id="mobile-transaction-icon">

                    @endif
                </td>
                <td style="width: 40%;"> 
                    <p class="m-L-T">
                    @if (data_get($ru, 'type') == 1)
                        E-Load
                    @else
                        Distance Travelled
                    @endif
                    </p> 
                    <p class="m-D-T">{{date('M j, Y H:i', strtotime(data_get($ru,'created_at')))}}</p> 
                </td>
                <td style="width: 40%;"> 
                    <p class="m-L-T">P {{data_get($ru,'amount')}}</p>
                @if (data_get($ru, 'type') == 1)
                    
                @else
                    <p class="m-D-T">{{data_get($ru, 'totalKm') }} Kilometers</p> 
                @endif
                </td>
              </tr>
            @endforeach
            </tbody>
        </table>
        {{-- {{$result_load->links()}}  --}}

    </div>
</div>
@endsection
