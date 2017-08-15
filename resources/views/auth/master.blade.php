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
        <link href="{{url('gentelella')}}/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{url('gentelella')}}/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{url('gentelella')}}/plugins/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
<!--        <link href="{{url('gentelella')}}/plugins/animate.css/animate.min.css" rel="stylesheet">-->
        
        <link href="{{url('')}}/jquery-plugins/notifIt/notifIt.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{url('gentelella')}}/build/css/custom.min.css" rel="stylesheet">
        
        <!-- jQuery -->
        <script src="{{url('gentelella')}}/plugins/jquery/dist/jquery.min.js"></script>
        <script src="{{url('')}}/jquery-plugins/notifIt/notifIt.min.js"></script>
        
    </head>
    
    <body class="login">
        
        @include('layouts.dashboard.messages')
        
        @yield('content')
        
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
