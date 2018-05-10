@extends('layouts.table')

@section('title', 'Biometrics')

@section('parent','Employee')

@section('current','Biometrics')

@section('box-title', 'Employee Biometrics')

@section('table-content')
  <thead>
  <tr>
    <th>Username</th>
    <th>First name</th>
    <th>Last name</th>
    <th>Email</th>
    <th>Department</th>
    <th>Biometrics</th>
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
        <td>
          @if(strtolower($user->biometrics) == "available")
            <span class="label label-success">{{$user->biometrics}}</span>
          @else
            <span class="label label-danger">{{$user->biometrics}}</span>
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
    <th>Biometrics</th>
  </tr>
  </tfoot>
@endsection