<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap -->
        <link href="{{url('public/gentelella')}}/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{url('public/gentelella')}}/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{url('public/gentelella')}}/plugins/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{url('public/gentelella')}}/plugins/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="{{url('public/gentelella')}}/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{url('public/gentelella')}}/plugins/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{url('public/gentelella')}}/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="{{url('public/gentelella')}}/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="{{url('public/gentelella')}}/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="{{url('public/gentelella')}}/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="{{url('public/gentelella')}}/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="{{url('public/gentelella')}}/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- notifIt -->
        <link href="{{url('public')}}/jquery-plugins/notifIt/notifIt.css" rel="stylesheet">
        <!-- sweetalert2 -->
        <link href="{{url('public')}}/jquery-plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{url('public/gentelella')}}/build/css/custom.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="{{url('public/gentelella')}}/plugins/jquery/dist/jquery.min.js"></script>
        <!-- CKEditor -->
        <script src="{{url('')}}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        
    </head>
    
    <body class="nav-md">
        
        @include('layouts.dashboard.messages')
        
        <div class="container body">
            <div class="main_container"> 
                @if(!Request::is('login') && !Request::is('register') && !Request::is('password/reset'))
                    @include('layouts.dashboard.sidebar')
                @endif
                
                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{url('public/images')}}/img.jpg" alt="">John Doe
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="javascript:;"> Profile</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out pull-right"></i> Log Out
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->
                
                @yield('content')
                
                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        TQBlog - Laravel Admin Panel by <a href="http://tahirafridi.com">Tahir Afridi</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
                
            </div>
        </div>
        
        <!-- Latest compiled and minified JavaScript -->
        <!-- Bootstrap -->
        <script src="{{url('public/gentelella')}}/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="{{url('public/gentelella')}}/plugins/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="{{url('public/gentelella')}}/plugins/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="{{url('public/gentelella')}}/plugins/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="{{url('public/gentelella')}}/plugins/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{url('public/gentelella')}}/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="{{url('public/gentelella')}}/plugins/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="{{url('public/gentelella')}}/plugins/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="{{url('public/gentelella')}}/plugins/Flot/jquery.flot.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/Flot/jquery.flot.pie.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/Flot/jquery.flot.time.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/Flot/jquery.flot.stack.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="{{url('public/gentelella')}}/plugins/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="{{url('public/gentelella')}}/plugins/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="{{url('public/gentelella')}}/plugins/jqvmap/dist/jquery.vmap.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{url('public/gentelella')}}/plugins/moment/min/moment.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- Datatables -->
        <script src="{{url('public/gentelella')}}/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/jszip/dist/jszip.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{url('public/gentelella')}}/plugins/pdfmake/build/vfs_fonts.js"></script>
        <!-- notifIt -->
        <script src="{{url('public')}}/jquery-plugins/notifIt/notifIt.min.js"></script>
        <!-- sweetalert2 -->
        <script src="{{url('public')}}/jquery-plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{url('public/gentelella')}}/build/js/custom.min.js"></script>
        
        <script>
            function messageNotif(msg, type, position){
                var label = "";
                if(type === 'success')
                    label = "<strong><i class='fa fa-check-circle'></i> Success!</strong><br>";
                if(type === 'error')
                    label = "<strong><i class='fa fa-times-circle'></i> Error!</strong><br>";
                if(type === 'warning')
                    label = "<strong><i class='fa fa-warning'></i> Warning!</strong><br>";
                if(type === 'info')
                    label = "<strong><i class='fa fa-info-circle'></i> Info!</strong><br>";
                notif({
                    msg: label+msg,
                    type: type,
                    position: position,
                    multiline: true,
                    opacity: '0.8',
                    fade: false,
                    clickable: false
                });
            }
        </script>
        
    </body>
</html>
