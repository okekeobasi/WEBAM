<div class="tab-pane" id="viewer">
    <ul class="list-group list-group-unbordered container-fluid">
        <li class="list-group-item">
            <b>Firstname: </b> <a class="pull-right" style="font-size: smaller">{{$user->firstname}}</a>
        </li>
        <li class="list-group-item">
            <b>Lastname</b> <a class="pull-right" style="font-size: smaller">{{$user->lastname}}</a>
        </li>
        <li class="list-group-item">
            <b>Username</b> <a class="pull-right" style="font-size: smaller">{{$user->username}}</a>
        </li>
        <li class="list-group-item">
            <b>Email</b> <a class="pull-right" style="font-size: smaller">{{$user->email}}</a>
        </li>
        <li class="list-group-item">
            <b>Department</b> <a class="pull-right">
                {{App\Department::find($user->departmentId)->department}}
            </a>
        </li>
        <li class="list-group-item">
            <b>Phone number:</b> <a class="pull-right" style="font-size: smaller">{{$user->phone}}</a>
        </li>
        <li class="list-group-item">
            <b>Role:</b> <a class="pull-right" style="font-size: smaller">
                {{App\Role::find($user->roleId)->role_name}}
            </a>
        </li>
        <li class="list-group-item">
            <b>Status</b><a class="pull-right">
                @if(strtolower($user->status) == "active")
                    <span class="label label-success">{{$user->status}}</span>
                @else
                    <span class="label label-danger">{{$user->status}}</span>
                @endif
            </a>
        </li>
    </ul>
</div>
<!-- /.tab-pane -->