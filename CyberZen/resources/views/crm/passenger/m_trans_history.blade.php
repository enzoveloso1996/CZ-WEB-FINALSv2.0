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
                    <p id="M.Welcome">Hello {{$item->fullname}}, welcome back </p>
                </div>
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
 
    <div class="row mobile-customer-transaction">
        <div class="col-6"  id="m-last-load-trans">
            <div class="alert alert-success" id="mobile-LLT">
                <p class="mLLT-Amount">P {{$latest_reload}}</p>
                <p class="mLLT-Text">Last Load Transaction</p>
                    {{-- Auth Customer last load transaction --}}
            </div>
        </div>
        <div class="col-6" id="m-last-trans">
                {{-- Auth Customer last transaction --}}
            <div class="alert alert-success" id="mobile-LT">
                <p class="mLT-Amount">P {{$latest_payment}}</p>
                <p class="mLT-Text">Last transaction</p>
            </div>
        </div>
    </div>
 
    <div class="container-fluid" id="mobile-transaction-history">
        <p class="m-transaction-Text">Transaction</p>

        <table class="table table-bordered">
            <tbody class="transaction-table">
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
            </tbody>
          </table>
          <p> December 2019 </p>
          <table class="table table-bordered">
            <tbody class="transaction-table">
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
              <tr>
                <td> 
                    {{-- Icon ????? --}}
                </td>
                <td> 
                    <p class="m-L-T">Distance Traveled</p> 
                    <p class="m-D-T">30 January 2020</p> 
                </td>
                <td> 
                    <p class="m-L-T">P 30.00</p>
                    <p class="m-D-T">28 kilometers</p>
                </td>
              </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
