<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Blog Posts</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="{{asset('public/css/blog.css')}}" rel="stylesheet">
    </head>

    <body>

        @include('layouts.layoutv1.nav')
        
        <div class="container">

            <div class="row">

                <div class="col-sm-8 blog-main">

                    @yield('content')
                    
                </div><!-- /.blog-main -->
                
                <div class="col-sm-3 offset-sm-1 blog-sidebar">
                    
                    @include('layouts.layoutv1.sidebar')
                    
                </div><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </div><!-- /.container -->
        
        @include('layouts.layoutv1.footer')
        
    </body>
</html>
