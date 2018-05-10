	  <!-- Logo -->
	  <a href="{{route('admin.dashboard')}}" class="logo">
	    <!-- mini logo for sidebar mini 50x50 pixels -->
	    <span class="logo-mini"><b>W</b>AM</span>
	    <!-- logo for regular state and mobile devices -->
	    <span class="logo-lg"><b>WEB</b>AM</span>
	  </a>

	  <!-- Header Navbar -->
	  <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation">
	    <!-- Sidebar toggle button-->
	    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	      <span class="sr-only">Toggle navigation</span>
	    </a>
	    <!-- Navbar Right Menu -->
	    <div class="navbar-custom-menu">
	      <ul class="nav navbar-nav">
	      <li class="dropdown user user-menu">
	        <!-- Menu Toggle Button -->
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	          <!-- The user image in the navbar-->
	          {{--<img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
				<img src="{{Storage::url($clients->file_path)}}" class="user-image" alt="User Image">
	          <!-- hidden-xs hides the username on small devices so only the image appears. -->
	          <span class="hidden-xs">{{$clients->firstname}}</span>
	        </a>
	        <ul class="dropdown-menu">
	          <!-- The user image in the menu -->
	          <li class="user-header">
	            {{--<img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
				  <img src="{{Storage::url($clients->file_path)}}" class="img-circle" alt="User Image">
	            <p style="color: white">
					{{$clients->firstname}}
	              <small>{{$clients->email}}</small>
	            </p>
	          </li>
	          <!-- Menu Body -->
	          <li class="user-body">
	            {{----}}
	          </li>
	          <!-- Menu Footer-->
	          <li class="user-footer">
	            <div class="">
	              <a href="{{route('admin.logout')}}" style="width: 100%;" class="btn btn-default btn-flat">Sign out</a>
	            </div>
	          </li>
	        </ul>
	      </li>
	      <!-- Control Sidebar Toggle Button -->
	      <!-- <li>
	        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
	      </li> -->
	    </ul>
	  </div>
	</nav>
