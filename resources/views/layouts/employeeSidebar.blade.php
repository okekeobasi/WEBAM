<!-- Sidebar user panel (optional) -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="{{asset('dist/img/usericon.png')}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{$clients->firstname}}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>

<!-- search form (Optional) -->
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Employee Search...">
        <span class="input-group-btn">
      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
      </button>
    </span>
    </div>
</form>
<!-- /.search form -->

<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Employee</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
    <li class=" treeview">
        <a href="#"><i class="fa fa-user"></i> <span>{{$clients->firstname}}</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="{{route('employee.dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </li>

    <li class=" treeview">
        <a href="#"><i class="fa fa-gears"></i> <span>Settings</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{$department}}"><a href="#">Personal Information</a></li>
        </ul>
    </li>
</ul>
<!-- /.sidebar-menu -->