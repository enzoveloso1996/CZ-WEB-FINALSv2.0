<!doctype html>
<html>
    <head>
        <title>Admin</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link href="{{ asset('new/css/cs-skin-elastic.css') }}" rel="stylesheet">
        <link href="{{ asset('new/css/style.css') }}" rel="stylesheet">
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    
        <style>
            #weatherWidget .currentDesc {
                color: #ffffff!important;
            }
            .traffic-chart {
                min-height: 335px;
            }
            #flotPie1  {
                height: 150px;
            }
            #flotPie1 td {
                padding:3px;
            }
            #flotPie1 table {
                top: 20px!important;
                right: -10px!important;
            }
            .chart-container {
                display: table;
                min-width: 270px ;
                text-align: left;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            #flotLine5  {
                height: 105px;
            }
        
            #flotBarChart {
                height: 150px;
            }
            #cellPaiChart{
                height: 160px;
            }
            #logo-header {
                height:40px; 
                width:40px;
                -moz-transition: all .8s linear!important;
                -webkit-transition: all .8s linear!important;
                transition: all .8s linear!important;
            }
            .rotated-image2 {
                height:40px; 
                width:40px; 
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            .rotated-image {
                height:40px; 
                width:40px; 
                -webkit-transform: rotate(-360deg);
                transform: rotate(-360deg);
            }
        </style>
    </head>
    <body>
        {{$access_level = Request::get('access_level')}}
        
        <!-- Left Panel -->
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        @if(Request::url() == 'http://127.0.0.1:8000/cms/admin/dashboard/{{$user_id}}')
                            <li class="active" id="dashboard">
                                <a href="/cms/admin/dashboard/{{$user_id}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                            </li>
                        @else
                            <li id="dashboard">
                                <a href="/cms/admin/dashboard/{{$user_id}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                            </li>
                        @endif
                        <li class="menu-title" id="reports">Reports</li><!-- /.menu-title -->
                        @if(Request::url() == 'http://127.0.0.1:8000/cms/admin/cardtransaction/{{$user_id}}')
                            <li class="active" id="reports1">
                                <a href="/cms/admin/cardtransaction/{{$user_id}}"> <i class="menu-icon fa fa-suitcase"></i>Card Transactions</a>
                            </li>
                        @else
                            <li id="reports1">
                                <a href="/cms/admin/cardtransaction/{{$user_id}}"> <i class="menu-icon fa fa-suitcase"></i>Card Transactions</a>
                            </li>
                        @endif
                        @if(Request::url() == 'http://127.0.0.1:8000/cms/admin/jeeptransaction/{{$user_id}}')
                            <li class="active" id="reports2">
                                <a href="/cms/admin/jeeptransaction/{{$user_id}}"> <i class="menu-icon fa fa-user"></i>Jeep Transactions</a>
                            </li>
                        @else
                            <li id="reports2">
                                <a href="/cms/admin/jeeptransaction/{{$user_id}}"> <i class="menu-icon fa fa-user"></i>Jeep Transactions</a>
                            </li>
                        @endif
                        <li class="menu-title" id="ejeep">E-Jeep</li><!-- /.menu-title -->
                        @if(Request::url() == 'http://127.0.0.1:8000/jeeps/cms/admin/clientlist/{{$user_id}}')
                            <li class="active" id="ejeep1">
                                <a href="/jeeps/cms/admin/clientlist/{{$user_id}}"> <i class="menu-icon fa fa-suitcase"></i>Client Companies</a>
                            </li>
                        @else
                            <li id="ejeep1">
                                <a href="/jeeps/cms/admin/clientlist/{{$user_id}}"> <i class="menu-icon fa fa-suitcase"></i>Client Companies</a>
                            </li>
                        @endif
                        @if(Request::url() == 'http://127.0.0.1:8000/jeeps/cms/admin/clientusers/{{$user_id}}')
                            <li class="active" id="ejeep2">
                                <a href="/jeeps/cms/admin/clientusers/{{$user_id}}"> <i class="menu-icon fa fa-user"></i>Client User Accounts</a>
                            </li>
                        @else
                            <li id="ejeep2">
                                <a href="/jeeps/cms/admin/clientusers/{{$user_id}}"> <i class="menu-icon fa fa-user"></i>Client User Accounts</a>
                            </li>
                        @endif
                        @if(Request::url() == 'http://127.0.0.1:8000/jeeps/cms/admin/jeeplist/{{$user_id}}')
                            <li class="active" id="ejeep3">
                                <a href="/jeeps/cms/admin/jeeplist/{{$user_id}}"> <i class="menu-icon fa fa-bus"></i>E-Jeeps Registered</a>
                            </li>
                        @else 
                            <li id="ejeep3">
                                <a href="/jeeps/cms/admin/jeeplist/{{$user_id}}"> <i class="menu-icon fa fa-bus"></i>E-Jeeps Registered</a>
                            </li>
                        @endif
                        @if(Request::url() == 'http://127.0.0.1:8000/jeeps/cms/admin/driverlist/{{$user_id}}')
                            <li class="active" id="ejeep4">
                                <a href="/jeeps/cms/admin/driverlist/{{$user_id}}"> <i class="menu-icon fa fa-plus-square"></i>Client Personnels</a>
                            </li>
                        @else
                            <li id="ejeep4">
                                <a href="/jeeps/cms/admin/driverlist/{{$user_id}}"> <i class="menu-icon fa fa-plus-square"></i>Client Personnels</a>
                            </li>
                        @endif
                        <li class="menu-title" id="tapcard">Tap Cards</li><!-- /.menu-title -->
                        @if(Request::url() == "{{route('cardlist.index', ['user_id' => $user_id, 'access_level' => $access_level])}}")
                            <li class="active" id="tapcard1">
                                <a href="{{route('cardlist.index', ['user_id' => $user_id, 'access_level' => $access_level])}}"> <i class="menu-icon fa fa-credit-card"></i>Cards</a>
                            </li>
                        @else 
                            <li id="tapcard1">
                                <a href="{{route('cardlist.index', ['user_id' => $user_id, 'access_level' => $access_level])}}"> <i class="menu-icon fa fa-credit-card"></i>Cards</a>
                            </li>
                        @endif
                        @if(Request::url() == "{{route('reload', ['user_id' => $user_id, 'access_level' => $access_level])}}")
                            <li class="active" id="tapcard2">
                                <a href="{{route('reload', ['user_id' => $user_id, 'access_level' => $access_level])}}"> <i class="menu-icon fa fa-flash"></i>Load Cards</a>
                            </li>
                        @else
                            <li id="tapcard2">
                                <a href="{{route('reload', ['user_id' => $user_id, 'access_level' => $access_level])}}"><i class="menu-icon fa fa-flash"></i>Load Cards</a>
                            </li>
                        @endif
                        <li class="menu-title" id="accounts">Account</li><!-- /.menu-title -->
                        @if(Request::path() == '/widgets')
                            <li id="adduser">
                                <a href="{{Route('admin-register-index', ['user_id' => $user_id])}}"> <i class="menu-icon fa fa-cogs"></i>Add User</a>
                            </li>
                        @else 
                            <li id="adduser">
                                <a href="{{Route('admin-register-index', ['user_id' => $user_id])}}"> <i class="menu-icon fa fa-cogs"></i>Add User</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{Route('admin-logout-check', ['user_id' => $user_id])}}"> <i class="menu-icon fa fa-sign-in"></i>Logout</a>
                        </li>
                        @if(Request::path() == '/widgets')
                        <li>
                            <a href="{{Route('admin-logout-check', ['user_id' => $user_id])}}"> <i class="menu-icon fa fa-sign-in"></i>Logout</a>
                        </li>
                        @endif
                    </ul>
                    
                </div>
            </nav>
        </aside>
        <!-- /#left-panel -->

        <div id="right-panel" class="right-panel">
            
            <!-- Header-->
            <header id="header" class="header">
                <div class="top-left">
                    <div class="navbar-header">
                        <a class="menutoggle" id="menuToggle"><img id="logo-header" src="{{ asset('new/img/logo.png') }}" alt="Logo"></a>
                    </div>
                </div>
                <div class="top-right">
                    <div class="header-menu">
                        <div class="header-left">
                            <div class="form-inline">
                            </div>
    
                            <div class="dropdown for-notification">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="count bg-danger">3</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="notification">
                                    <p class="red">You have 3 Notification</p>
                                    <a class="dropdown-item media" href="#">
                                        <i class="fa fa-check"></i>
                                        <p>Server #1 overloaded.</p>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <i class="fa fa-info"></i>
                                        <p>Server #2 overloaded.</p>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <i class="fa fa-warning"></i>
                                        <p>Server #3 overloaded.</p>
                                    </a>
                                </div>
                            </div>
    
                            <div class="dropdown for-message">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                    <span class="count bg-primary">4</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="message">
                                    <p class="red">You have 4 Mails</p>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Jonathan Smith</span>
                                            <span class="time float-right">Just now</span>
                                            <p>Hello, this is an example msg</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Jack Sanders</span>
                                            <span class="time float-right">5 minutes ago</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Cheryl Wheeler</span>
                                            <span class="time float-right">10 minutes ago</span>
                                            <p>Hello, this is an example msg</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Rachel Santos</span>
                                            <span class="time float-right">15 minutes ago</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>
                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                            <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>-->
                </div>
            </div>
        </header>
        <!-- Header -->
 
        <!--Content-->
        <div class="clearfix">
            <div class="content">
                @yield('content')
            </div>
        </div>
        <!--Content-->

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script type="text/javascript" src="{{ asset('new/js/main.js') }}"></script>
        <!--  Chart js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

        <!--Chartist Chart-->
        <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
        <script type="text/javascript" src="{{ asset('new/js/init/weather-init.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
        <script type="text/javascript" src="{{ asset('new/js/init/fullcalendar-init.js') }}"></script>

        <script>
            $(document).ready(function(){
                var access_level = <?php echo $access_level; ?>

                if(access_level == 2){
                    $('#dashboard').hide();
                    $('#reports').hide();
                    $('#reports1').hide();
                    $('#reports2').hide();
                    $('#ejeep').hide();
                    $('#ejeep1').hide();
                    $('#ejeep2').hide();
                    $('#ejeep3').hide();
                    $('#ejeep4').hide();
                    // $('#tapcard').hide();
                    // $('#tapcard1').hide();
                    // $('#tapcard2').hide();
                    $('#adduser').hide();
                    
               }
                
            });
        </script>
    </body>
</html>