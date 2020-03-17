@extends('.cms.layout')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<style>
    table {
        counter-reset: rowNumber;
    }
    #ref {
        counter-increment: rowNumber;
    }
    #ref::before {
        content: counter(rowNumber);
        min-width: 1em;
        margin-right: 0.5em;
    }
    #result{
        display: none;
    }
</style>
@section('content')
@foreach ($cardsales as $cardsale)

@endforeach 
 <!-- Breadcrumbs-->
 <div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">TAP CARDS</a></li>
                            <li class="active">Cards</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.breadcrumbs-->

    <div class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><?php echo trim($activecards,"[]"); ?></div>
                                <div class="stat-heading">Card Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-3">
                            <i class="pe-7s-browser"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">Php {{$cardsale->total}}</div>
                                <div class="stat-heading">Total Card Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="animated fadeIn">

        <div class="card">
            <div class="card-header">
                <h4>Cards</h4>
            </div>
            <div class="card-body">
                <div class="custom-tab">
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                         
                        <div class="tab-pane fade show active" id="custom-nav-inactive" role="tabpanel" aria-labelledby="custom-nav-inactive-tab">
                            <div class="float-left p-3">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="searchInactive" placeholder="RFID.." aria-label="search" aria-describedby="basic-addon1" autofocus>
                                </div>
                            </div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center">RFID Number</th>
                                        <th class="center">Card Balance</th>
                                        <th class="center">Full Name</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="result">
                                <div class="jumbotron text-center">
                                    <h4>No available data</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

    <!-- Modals -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit details</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" novalidate="novalidate">
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Full Name</label>
                        <input id="cc-payment" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    </div>
                    <div class="form-group">
                        <label for="cc-number" class="control-label mb-1">Card Balance</label>
                        <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number">
                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label for="cc-number" class="control-label mb-1">RFID Number</label>
                        <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number">
                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Card Type</label>
                                <select class="form-control cc-exp">
                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Security code</label>
                            <div class="input-group">
                                <select class="form-control cc-exp">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Hold-->
    <div class="modal" tabindex="-1" id="holdcardModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Warning</h5>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to hold this card?</p>
        </div>
        <div class="modal-footer">
        <form method="post" action="{{ route('hold-card')}}">
            @method('PATCH') 
            @csrf
            <input type="text" class="form-control" name="hold" id="hold" value=0 hidden>
            <button type="submit" class="btn btn-danger">Confirm</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
        </div>
        </div>
    </div>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>-->
<script type="text/javascript">
    $('#searchInactive').on('keyup',function(){
        $('tbody').empty();
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('cards/searchInactive')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            },
        });
            if($('#searchInactive').val().length === 0) {
                $('#result').css('display', 'block');
            } else {
                $('#result').css('display', 'none');
            }
    });
</script>
<script>
    $(document).ready(function(){
        $("#cardtype").change(function(){
            var client = $(this).children(":selected").attr("id");
            console.log(client);
            $.ajax({
                type: 'get',
                url: '{{URL::to('cards/combo-sort')}}',
                data:{'combosearch':client},
                success: function(data){
                    console.log(client);
                    $('tbody').html(data);
                },
                error: function(data){
                    console.log(data);
                    console.log($.ajax());
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection