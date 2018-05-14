<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <title>@yield('title')</title>
    @include('layouts.js')
    @include('layouts.css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header" style="position: fixed">
        @include('layouts.header')
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="position: fixed">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @if($clients->roleId == 1)
                @include('layouts.sidebar')
            @else
                @include('layouts.employeeSidebar')
            @endif
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"  style="margin-top: 3%">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('headerTitle')
                <!-- <small>Optional description</small> -->
            </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fa fa-dashboard"></i>Home
                        </a>
                    </li>
                    {{--@yield('breadcrumb')--}}
                    <li>
                        <a onclick="window.history.back()">
                            <i class="fa fa-dashboard"></i>@yield('parent')
                        </a>
                    </li>
                    <li class="active">
                        <i class="fa fa-dashboard"></i>@yield('current')
                    </li>
                </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <section class="content">
                @section('content')
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">@yield('box-title')</h3>
                                    @yield('box-warning')
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    @yield('box-mods')
                                    <div class="table_mod">
                                        <table id="example" class="table table-bordered table-striped table-hover js-exportable">
                                            @yield('table-content')
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                @show
            </section>
            <!-- /.content -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.footer')
</div>
<!-- ./wrapper -->

{{--@include('layouts.js')--}}
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

@yield('modal')
@yield('custom_js')
</body>
</html>