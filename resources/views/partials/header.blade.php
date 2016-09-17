<div class="header">
    <nav class="navbar   navbar-site navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a href="{{url('home')}}" class="navbar-brand logo logo-title">

                    <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> Yanbu </span> </a> </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::check())
                    <li><a href="{{url('signin')}}">Signin</a></li>
                    <li><a href="{{url('signup')}}">Signup</a></li>
                    @else
                    <li><a href="{{url('logout')}}">Signout <i class="glyphicon glyphicon-off"></i> </a></li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>{{$user->first_name. ' '.$user->last_name}}</span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>
                        <ul class="dropdown-menu user-menu">
                            <li class={{(Request::is('profile')==1)?"active":"inactive"}}><a href="{{ url('profile') }}"><i class="icon-home"></i> Personal Home </a></li>
                            <li class={{(Request::is('myads')==1)?"active":"inactive"}}><a href="{{ url('myads') }}"><i class="icon-th-thumb"></i> My ads </a></li>
                            <li class={{(Request::is('password_update')==1)?"active":"inactive"}}><a href="{{url('/password_update')}}"><i class="icon-cog"></i> Settings </a></li>
                            <li class={{(Request::is('favourite-ads')==1)?"active":"inactive"}}><a href="{{ url('favourite-ads') }}"><i class="icon-heart"></i> Favourite ads </a></li>
                            <li class={{(Request::is('saved-search')==1)?"active":"inactive"}}><a href="{{ url('saved-search') }}"><i class="icon-star-circled"></i> Saved search </a></li>
                            <li class={{(Request::is('archived-ads')==1)?"active":"inactive"}}><a href="{{ url('archived-ads') }}"><i class="icon-folder-close"></i> Archived ads </a></li>
                            <li class={{(Request::is('pending-approval-ads')==1)?"active":"inactive"}}><a href="{{ url('pending-approval-ads') }}"><i class="icon-hourglass"></i> Pending approval </a></li>
                            <li class={{(Request::is('account-close')==1)?"active":"inactive"}}><a href="{{url('/account-close')}}"><i class=" icon-cancel-circled "></i> Close account </a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger" href="{{url('ad/post')}}">Post Free Add</a></li>
                </ul>
            </div>

        </div>

    </nav>
</div>
