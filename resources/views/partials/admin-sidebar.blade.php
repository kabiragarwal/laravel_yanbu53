
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                {{Html::image(asset('upload/users/'.((Auth::user()->image)?Auth::user()->image:'default.jpg')), null, ['class'=>"img-circle"])}}
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->first_name}}</p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <!--<li class="header">MAIN NAVIGATION</li>-->
			<li class="header"></li>
            <li class="{{Request::is('*/dashboard')?'active':''}} treeview">
                <a href="{{ url('admin/dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
			<li class="{{(Request::is('*/users') || Request::is('*/user/*'))?'active':''}} treeview">
                <a href="{{ url('admin/users')}}">
                    <i class="fa fa-user"></i> <span>Users</span>
                </a>
            </li>
            <li class="{{(Request::is('*/ads') || Request::is('*/ad/*'))?'active':''}} treeview">
                <a href="{{ url('admin/ads')}}">
                    <i class="fa fa-th"></i> <span>Ads</span>
                </a>
            </li>
            <li class="{{(Request::is('*/categories') || Request::is('*/category/*'))?'active':''}} treeview">
                <a href="{{ url('admin/categories')}}">
                    <i class="fa fa-user"></i> <span>Categories</span>
                </a>
            </li>
            <li class="{{(Request::is('*/subcategories') || Request::is('*/subcategory/*'))?'active':''}} treeview">
                <a href="{{ url('admin/subcategories')}}">
                    <i class="fa fa-th"></i> <span>Sub Categories</span>
                </a>
            </li>
            <li class="{{(Request::is('*/countries') || Request::is('*/country/*'))?'active':''}} treeview">
                <a href="{{ url('admin/countries')}}">
                    <i class="fa fa-user"></i> <span>Countries</span>
                </a>
            </li>
            <li class="{{(Request::is('*/states') || Request::is('*/state/*'))?'active':''}} treeview">
                <a href="{{ url('admin/states')}}">
                    <i class="fa fa-th"></i> <span>States</span>
                </a>
            </li>
            <li class="{{(Request::is('*/cities') || Request::is('*/city/*'))?'active':''}} treeview">
                <a href="{{ url('admin/cities')}}">
                    <i class="fa fa-user"></i> <span>Cities</span>
                </a>
            </li>
            <li class="{{(Request::is('*/pages') || Request::is('*/page/*'))?'active':''}} treeview">
                <a href="{{ url('admin/pages')}}">
                    <i class="fa fa-th"></i> <span>Pages</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
