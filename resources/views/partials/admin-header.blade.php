
	<header class="main-header">
                <!-- Logo -->
                <a href="{{ url('admin/dashboard')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">Admin</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">Yanbu: Admin Panel</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								{{Html::image(asset('upload/users/'.((Auth::user()->image)?Auth::user()->image:'default.jpg')), null, ['class'=>"user-image"])}}

                                    <span class="hidden-xs">{{Auth::user()->first_name .' '. Auth::user()->last_name}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                       {{Html::image(asset('upload/users/'.((Auth::user()->image)?Auth::user()->image:'default.jpg')), null, ['class'=>"img-circle"])}}

                                        <p>
                                            {{Auth::user()->first_name .' '. Auth::user()->last_name}}
                                            <small>Member since {{Auth::user()->created_at->diffForHumans()}}</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ url('admin/user/edit/'.Auth::id())}}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('admin/admin_logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->

                        </ul>
                    </div>
                </nav>
            </header>
