<div class="tab-pane" id="viewer">
    <form class="form-horizontal">
        {{ csrf_field() }}
        <div class="box-body">

            <!-- Department Name -->
            <div class="form-group">
                <label for="inputfname" class="col-sm-2 control-label text-right">Department:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" class="form-control" name="name" placeholder="Department..."
                           value="{{$department->department}}" required autofocus  readonly="true">
                </div>
            </div>

            <!--Time In-->
            <div class="row">
                <div class="col-sm-2 text-right">
                    <label>Resumption:</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group bootstrap-timepicker pull-right">
                        <div class="input-group-addon">
                            <i id="setTimeButton" class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" name="resumption" class="form-control date-form"  value="{{$department->resumption}}" readonly="true">
                    </div>
                </div>
            </div><br>

            <!--Time Out-->
            <div class="row">
                <div class="col-sm-2 text-right">
                    <label>Closing:</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group bootstrap-timepicker pull-right">
                        <div class="input-group-addon">
                            <i id="setTimeButton" class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" name="closing" class="form-control date-form"  value="{{$department->closing}}" readonly="true">
                    </div>
                </div>
            </div><br>

            <!-- Status -->
            <div class="form-group">
                <label for="inputstatus" class="col-sm-2 control-label text-right">Status:</label>
                <div class="col-sm-10">
                    <input type="text" name="status" class="form-control" value="{{$department->status}}" required autofocus readonly="true">
                </div>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
<!-- /.tab-pane -->

@section('custom_js')
    <script>
        $('#resumption_timepicker').timepicker({
            defaultTime: '{{$department->resumption}}',
            showSeconds: true,
            showMeridian: false
        });
        $('#closing_timepicker').timepicker({
            defaultTime: '{{$department->closing}}',
            showSeconds: true,
            showMeridian: false
        });
    </script>
@endsection