@extends('cms.layout')
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
</style>
@section('content')
 
 <!-- Breadcrumbs-->
 <div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Client Personnel List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="/dashboard">DASHBOARD</a></li>
                            <li><a href="#">E-JEEP</a></li>
                            <li class="active">Client Personnels</li>
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
                                <div class="stat-text"><?php echo trim($drivercount,"[]"); ?></div>
                                <div class="stat-heading">Registered Personnels</div>
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
                <h4>Personnels</h4>
            </div>
            <div class="card-header">

                <div class="float-left p-3">
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="search-employee-name" placeholder="Search Employee Name.." aria-label="search" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="float-right p-3">
                    <select name="company-list" id="companylist" class="form-control">
                        <option value="">All</option>
                        @foreach ($companylist as $list)
                            <option id="{{$list->client_name}}" value="{{$list->client_id}}">{{$list->client_name}}</option>
                        @endforeach    
                    </select>
                </div>
            
            </div>
            <div class="card-body">
                <div class="custom-tab">

                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="custom-nav-active" role="tabpanel" aria-labelledby="custom-nav-active-tab">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center"></th>
                                        <th class="center">RFID Number</th>
                                        <th class="center">Full Name</th>
                                        <th class="center">Company</th>
                                        <th class="center">Position</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($driverlists as $driverlist)
                                                                        
                                    <tr>
                                        <td class="center" id="ref"></td>
                                        <td class="center">{{$driverlist->rfid_number}}</td>
                                        <td class="left">{{$driverlist->fullname}}</td>
                                        <td class="left">{{$driverlist->client_name}}</td>
                                        <td class="left">{{$driverlist->position}}</td>
                                 
                                    </tr>
                                    @endforeach
                                </tbody>
                                {{$driverlists->links()}}
                            </table>
                            {{-- {{$driverlists->links()}} --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#companylist").change(function(){
            var client = $(this).children(":selected").attr("id");
            console.log(client);
            $.ajax({
                type: 'get',
                url: '{{URL::to('jeeps/combo-search-driver')}}',
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
    $('#search-employee-name').on('keyup',function(){
            $value = $(this).val();
            $client_name = $('#companylist').children(':selected').attr('id');
            console.log($client_name);
            console.log($value);
            $.ajax({
                type : 'get',
                url : '{{URL::to('jeeps/search-driver')}}',
                data:{  'search':$value,
                        'client_name':$client_name
                        },
                success:function(data){
                    $('tbody').html(data);
                },
                error: function(data) {console.log("error!!");}
            });
        });
    
</script>
<script>
    
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection