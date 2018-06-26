<div class="tab-pane" id="manage">
    <form class="form-horizontal" action="{{route('employee.update',$user->staffId)}}"
          method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
            <!-- First name -->
            <div class="form-group">
                <label for="inputfname" class="col-sm-2 control-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" id="fname" class="form-control" name="firstname" placeholder="First name..."
                           value="{{$user->firstname}}" required autofocus>
                </div>
            </div>
            <!-- Last name -->
            <div class="form-group">
                <label for="inputlname" class="col-sm-2 control-label">Last name</label>
                <div class="col-sm-10">
                    <input type="text" id="lname" class="form-control" name="lastname" placeholder="Last name..."
                           value="{{$user->lastname}}" required autofocus>
                </div>
            </div>
            <!-- Username -->
            <div class="form-group">
                <label for="inputlname" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" id="uname" class="form-control" name="username" placeholder="Username..."
                           value="{{$user->username}}" required autofocus>
                </div>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" id="email" class="form-control" name="email" placeholder="Email..."
                               value="{{$user->email}}" required autofocus>
                        <span class="input-group-addon">@activedgetechnologies.com</span>
                    </div>
                </div>
            </div>
            <!-- Department -->
            <div class="form-group">
                <label for="inputDepart" class="col-sm-2 control-label">Department</label>
                <div class="col-sm-10">
                    <select name="department" class="form-control" required autofocus>
                        <option>Technology</option>
                        <option>Security</option>
                    </select>
                </div>
            </div>
            <!-- Phone Number -->
            <div class="form-group">
                <label for="inputphone" class="col-sm-2 control-label">Phone No.</label>
                <div class="col-sm-10">
                    <input type="number" id="number" name="number" class="form-control" placeholder="Phone No..."
                           value="{{$user->phone}}" required autofocus>
                </div>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="inputpassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="Password" id="password" name="password" class="form-control" placeholder="Password..." required autofocus>
                </div>
            </div>
            <!-- ReEnter Password -->
            <div class="form-group">
                <label for="inputpassword" class="col-sm-2 control-label" style="font-size: 10px">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="Password" id="password_2" name="password2" class="form-control" placeholder="Password..." required autofocus>
                </div>
            </div>
            <!-- Status -->
            <div class="form-group">
                <label for="inputstatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control" required autofocus>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
            <!-- Role -->
            <div class="form-group">
                <label for="inputRole" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
                    <select name="role" class="form-control" required autofocus>
                        @foreach ($roles as $role)
                            <option>{{$role->role_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--Picture-->
            <div class="form-group">
                <label for="inputfile" class="col-sm-2 control-label">Passport</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="pic" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn form-control btn-info pull-right">Update</button>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
<!-- /.tab-pane -->