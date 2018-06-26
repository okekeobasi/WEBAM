<div class="modal fade" tabindex="-1" role="dialog" id="create" aria-labelledby="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Department</h4>
                @if ($errors)
                    {{--$errors->first('message')--}}
                    @foreach ($errors->all() as $error)
                        <p class="text-warning" style="color: red; float: right;">{{ $error }}</p><br/>
                    @endforeach
                @endif
            </div>
            <div class="modal-body" style="padding-bottom: 15%;">
                <form class="form-horizontal" action="{{route('department.create')}}"
                      method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <!-- Department Name -->
                        <div class="form-group">
                            <label for="inputfname" class="col-sm-2 control-label text-right">Department:</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" name="department" placeholder="Department..." required autofocus>
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
                                    <input type="text" name="resumption" class="form-control date-form bootstrap-timepicker" id="resumption_timepicker">
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
                                    <input type="text" name="closing" class="form-control date-form bootstrap-timepicker" id="closing_timepicker">
                                </div>
                            </div>
                        </div><br>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="inputstatus" class="col-sm-2 control-label text-right">Status:</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control" required autofocus>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn form-control btn-info pull-right">Create</button>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.tab-pane -->