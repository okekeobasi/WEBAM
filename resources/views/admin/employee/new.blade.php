@extends('layouts.table')

@include('layouts.register_css')

@section('title','Create New Record')

@section('headerTitle','Enter Employee Details')

@section('parent','Employee')

@section('current','New')

@section('box-title','Register')

@section('box-warning')
  @if ($errors)
    {{--$errors->first('message')--}}
    @foreach ($errors->all() as $error)
      <p class="text-warning" style="color: red; float: right;">{{ $error }}</p><br/>
    @endforeach
  @endif
@endsection

@section('box-mods')
<div class="row">
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <!-- <div class="box-header with-border">
        <h3 class="box-title">Horizontal Form</h3>
      </div> -->
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{route('employee.register')}}"
            method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body col-md-6 col-md-offset-2">
          <!-- First name -->
          <div class="form-group">
            <label for="inputfname" class="col-sm-2 control-label">First name</label>
            <div class="col-sm-10">
              <input type="text" id="fname" class="form-control" name="firstname" placeholder="First name..." required autofocus>
            </div>
          </div>
          <!-- Last name -->
          <div class="form-group">
            <label for="inputlname" class="col-sm-2 control-label">Last name</label>
            <div class="col-sm-10">
              <input type="text" id="lname" class="form-control" name="lastname" placeholder="Last name..." required autofocus>
            </div>
          </div>
          <!-- Username -->
          <div class="form-group">
            <label for="inputlname" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" id="uname" class="form-control" name="username" placeholder="Username..." required autofocus>
            </div>
          </div>
          <!-- Email -->
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <div class="input-group">
                <input type="text" id="email" class="form-control" name="email" placeholder="Email..." required autofocus>
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
              <input type="number" id="number" name="number" class="form-control" placeholder="Phone No..." required autofocus>
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
        <div class="box-footer col-md-6 col-md-offset-2">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn form-control btn-info pull-right">Register</button>
          </div>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
  {{--Where file input will be placed--}}
</div>
@endsection
