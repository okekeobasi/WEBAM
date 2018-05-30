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
    <li class="{{$employee}} treeview">
      <a href="#"><i class="fa fa-user"></i> <span>Employees</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{$employee_rec}}"><a href="{{route('employee.rec')}}">Records</a></li>
        <li class="{{$employee_bio}}"><a href="{{route('employee.bio')}}">Biometrics</a></li>
        <li class="{{$employee_cre}}"><a href="{{route('employee.cre')}}">Create New</a></li>
      </ul>
    </li>

    <li class="{{$attendance}} treeview">
      <a href="#"><i class="fa fa-calendar"></i> <span>Attendance</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{$attendance_rec}}"><a href="{{route('attendance.rec')}}">Records</a></li>
        <li class="{{$attendance_man}}"><a href="{{route('attendance.man')}}">Manage</a></li>
      </ul>
    </li>

    <li class="{{$report}} treeview">
      <a href="#"><i class="fa fa-book"></i> <span>Report</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{$report_emp}}"><a href="{{route('report.emp')}}">Employee</a></li>
        {{--<li class="{{$report_att}}"><a href="{{route('report.att')}}">Attendance</a></li>--}}
      </ul>
    </li>

    <li class="{{$config}} treeview">
      <a href="#"><i class="fa fa-gear"></i> <span>Config</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{$department}}"><a href="{{route('config.department')}}">Department</a></li>
      </ul>
    </li>
  </ul>
  <!-- /.sidebar-menu -->