@extends('crm.company.layout')

@section('content')
    <!-- Widgets  -->
   
 
    <div class="row">

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                @foreach ($totalsales as $totalsale)
                                <div class="stat-text">Php {{ $totalsale->totalsales }}</div>
                                <div class="stat-heading">Total Sales Year {{$totalsale->year}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                @foreach ($totalcardusers as $totalcarduser)
                                <div class="stat-text">{{ $totalcarduser->totalcardusers }}</div>
                                @endforeach
                                <div class="stat-heading">Total Card Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>                    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Total Sales for the Past 12 Months</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="chartArea" style="width:100%; height:300px; border:darkblue solid 1px;"></canvas>
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <div class="row">
         <div class="col-md-6">
            <div class="card shadow mb-4">
               <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yearly Sales for the Past 5 Years</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="chartArea2" style="width:100%; height:300px; border:darkblue solid 1px;"></canvas>
                    </div>
                </div>
            </div>            
        </div>
    
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales per Customer Type</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="chartArea3" style="width:100%; height:300px; border:darkblue solid 1px;"></canvas>
                    </div>
                </div>
            </div>            
        </div>
    </div>
  

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        var monthyear = <?php echo $monthyear; ?>;
        var monthlysales =  <?php echo $monthlysales; ?>;
        
        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return 'rgb(' + r + ',' + g + ',' + b + ')';
        };
        
        // var span = document.querySelector(".stat-text");
        // console.log(span.style.left, parseFloat(span.style.left));
        // console.log(parseFloat(window.getComputedStyle(span).getPropertyValue("left")));

        $(document).ready(function(){
        var chartData = {
        labels: monthyear,
        datasets: 
                                
            [{
                label: 'Monthly Sales',
                backgroundColor: [
                    // 'rgba(77, 166, 255, 0.4)',
                    // 'rgba(0, 204, 0, 0.4)',
                    // 'rgba(255, 153, 153, 0.4)',
                    // 'rgba(204, 51, 255, 0.4)',
                    // 'rgba(255, 255, 51, 0.4)',
                    // 'rgba(255, 204, 102, 0.4)',
                    // 'rgba(0, 0, 128, 0.4)',
                    'rgba(0, 255, 128, 0.4)',
                    'rgba(204, 41, 0, 0.4)',
                    'rgba(179, 134, 0, 0.4)'     
                ],
                data: monthlysales
            }]
        };
                        
                        
        var ctx = document.getElementById("chartArea").getContext("2d");
        var bargraph = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                elements: {
                    line: {
                        borderWidth: 4,
                        borderColor: 'rgba(0, 0, 128, 0.75)'
                    },
                    point: {
                        backgroundColor: 'rgba(77, 0, 0, 1)',
                        radius: 4,
                        borderColor: 'rgba(77, 0, 0, 1)'
                    }
                },
                responsive: false,
                title: {
                    display: true,
                    text: 'Monthly Income'
                }
            }
        });

        var year = <?php echo $year; ?>;
        var yearlysales =  <?php echo $yearlysales; ?>;

        var chartData2 = {
            labels: year,
            datasets: 
                                    
            [{
                label: "Yearly Sales",
                backgroundColor: [
                    'rgba(77, 166, 255, 0.4)',
                    'rgba(0, 204, 0, 0.4)',
                    'rgba(255, 153, 153, 0.4)',
                    'rgba(204, 51, 255, 0.4)',
                    'rgba(255, 255, 51, 0.4)',
                    'rgba(255, 204, 102, 0.4)',
                    'rgba(0, 0, 128, 0.4)',
                    'rgba(0, 255, 128, 0.4)',
                    'rgba(204, 41, 0, 0.4)',
                    'rgba(179, 134, 0, 0.4)'
                ],
                data: yearlysales
            }]
        };
                        
                        
        var ctx2 = document.getElementById("chartArea2").getContext("2d");
        var bargraph = new Chart(ctx2, {
            type: 'bar',
            data: chartData2,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 4,
                        borderColor: 'rgb(41, 0, 102)'
                        
                    }
                },
                responsive: false,
                title: {
                    display: true,
                    text: 'Total Yearly Sales'
                }
            }
        });


        var cardtype = <?php echo $cardtype; ?>;
        var faresales =  <?php echo $faresales; ?>;   

        var chartData3 = {
            labels: cardtype,
            datasets: 
                                    
            [{
                label: "Sales per Customer Type",
                backgroundColor:  [
                    // 'rgba(77, 166, 255, 0.4)',
                    'rgba(0, 204, 0, 0.4)',
                    // 'rgba(255, 153, 153, 0.4)',
                    // 'rgba(204, 51, 255, 0.4)',
                    'rgba(255, 255, 51, 0.4)',
                    'rgba(255, 204, 102, 0.4)',
                    'rgba(0, 0, 128, 0.4)',
                    'rgba(0, 255, 128, 0.4)',
                    'rgba(204, 41, 0, 0.4)',
                    'rgba(179, 134, 0, 0.4)'
                ],
                data: faresales
            }]
        };
                        
                        
        var ctx3 = document.getElementById("chartArea3").getContext("2d");
        var bargraph = new Chart(ctx3, {
            type: 'pie',
            data: chartData3,
            options: {
                elements: {
                    pie: {
                        borderWidth: 4,
                        borderColor: 'rgb(41, 0, 102)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: false,
                title: {
                    display: true,
                    text: 'Customer (Regular/Discounted)'
                    }
                }
            });
        });
    </script>

@endsection