@extends('layouts.table')

@section('title', 'Employee Records')

@section('parent','Employee')

@section('current','Records')

@section('box-title', 'Employee Records')

@section('table-content')
    <thead>
      <tr>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @php($d_id = $user->departmentId)
      <tr onclick="foo({{$user->staffId}})">
        <td>{{$user->username}}</td>
        <td>{{$user->firstname}}</td>
        <td>{{$user->lastname}}</td>
        <td>{{$user->email}}</td>
        <td>{{App\Department::find($d_id)->department}}</td>
        <td>{{$user->phone}}</td>
        <td>{{App\Role::find($user->roleId)->role_name}}</td>
        <td>
          @if(strtolower($user->status) == "active")
            <span class="label label-success">{{$user->status}}</span>
          @else
            <span class="label label-danger">{{$user->status}}</span>
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Status</th>
      </tr>
    </tfoot>
@endsection

@section('js')
  <script type="text/javascript">
    function foo(num) {
        var url = 'screen/' + num;
        window.open(url,'_self');
    }
  </script>
@endsection