<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('dashboard')}}" class="site_title"><b class="fa fa-caret-left"></b> <span>TQBlog</span> <b class="fa fa-caret-right"></b></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{url('public/images')}}/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Tahir Afridi</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
                    <li class="<?php echo isset($controller) && $controller === 'categories' ? 'current-page' : ''; ?>">
                        <a href="{{url('dashboard/categories')}}"><i class="fa fa-list-ul"></i> Categories</a>
                    </li>
                    <li class="<?php echo isset($controller) && $controller === 'posts' ? 'current-page' : ''; ?>">
                        <a href="{{url('dashboard/posts')}}"><i class="fa fa-leaf"></i> Posts</a>
                    </li>
                    <li class="<?php echo isset($controller) && $controller === 'users' ? 'current-page' : ''; ?>">
                        <a href="{{url('dashboard/users')}}"><i class="fa fa-user"></i> Users</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>