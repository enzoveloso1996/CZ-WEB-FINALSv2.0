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
        <!-- Left Panel -->
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        
                        @if(Request::url() == 'http://127.0.0.1:8000/cms/admin/clientdashboard/{{$user_id}}')
                            <li class="active">
                                <a href="/company/crm/company/clientdashboard/{{$user_id}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                            </li>
                        @else
                            <li>
                                <a href="/company/crm/company/clientdashboard/{{$user_id}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                            </li>
                        @endif
                        <li class="menu-title">E-Jeep</li><!-- /.menu-title -->
                        
                        @if(Request::url() == 'http://127.0.0.1:8000/company/crm/company/clientuseraccount/{{$user_id}}')
                            <li class="active">
                                <a href="/company/crm/company/clientuseraccount/{{$user_id}}"> <i class="menu-icon fa fa-user"></i>User Accounts</a>
                            </li>
                        @else
                            <li>
                                <a href="/company/crm/company/clientuseraccount/{{$user_id}}"> <i class="menu-icon fa fa-user"></i>User Accounts</a>
                            </li>
                        @endif
                        @if(Request::url() == 'http://127.0.0.1:8000/company/crm/company/clientjeeplist/{{$user_id}}')
                            <li class="active">
                                <a href="/company/crm/company/clientjeeplist/{{$user_id}}"> <i class="menu-icon fa fa-bus"></i>E-Jeeps Lists</a>
                            </li>
                        @else 
                            <li>
                                <a href="/company/crm/company/clientjeeplist/{{$user_id}}"> <i class="menu-icon fa fa-bus"></i>E-Jeeps Lists</a>
                            </li>
                        @endif
                        @if(Request::url() == 'http://127.0.0.1:8000/company/crm/company/clientpersonnel/{{$user_id}}')
                            <li class="active">
                                <a href="/company/crm/company/clientpersonnel/{{$user_id}}"> <i class="menu-icon fa fa-plus-square"></i>Personnels Lists</a>
                            </li>
                        @else
                            <li>
                                <a href="/company/crm/company/clientpersonnel/{{$user_id}}"> <i class="menu-icon fa fa-plus-square"></i>Personnels Lists</a>
                            </li>
                        @endif
                        
                        <li class="menu-title">Account</li><!-- /.menu-title -->
                        @if(Request::path() == '/widgets')
                            <li>
                                <a href="widgets.html"> <i class="menu-icon fa fa-cogs"></i>Settings</a>
                            </li>
                        @else 
                            <li>
                                <a href="widgets.html"> <i class="menu-icon fa fa-cogs"></i>Settings</a>
                            </li>
                        @endif 
                        
                        <li>
                            <a href="{{Route('client-logout-check', ['user_id' => $user_id])}}"> <i class="menu-icon fa fa-sign-in"></i>Logout</a>
                        </li>
                        @if(Request::path() == '/widgets')
                        <li>
                            <a href="{{Route('client-logout-check', ['user_id' => $user_id])}}"> <i class="menu-icon fa fa-sign-in"></i>Logout</a>
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
                <h2 style="display:inline;">{{$client_name}}</h2>
                <div class="top-right">
                    <div class="header-menu">
                        <div class="header-left">
                            <div class="form-inline">
                            </div>
    
                            {{-- <div class="dropdown for-notification">
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
                            </div> --}}
    
                            {{-- <div class="dropdown for-message">
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
                            </div> --}}
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
    </body>
</html>