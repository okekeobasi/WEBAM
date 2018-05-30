<div class="tab-pane" id="manage">
    <form class="form-horizontal" action="{{route('employee.update',$user->staffId)}}"
          method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
            <!-- Department Name -->
            <div class="form-group">
                <label for="inputfname" class="col-sm-2 control-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" id="fname" class="form-control" name="firstname" placeholder="First name..." required autofocus>
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