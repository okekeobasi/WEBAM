<?php

use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','AdminLoginController@showLoginForm');
Route::prefix('/api')->group(function() {
    Route::get('/dashboard', 'Api\AdminAPIController@testDate')->name('api.test');

    Route::prefix('/report')->group(function() {
        Route::get('/employee', 'Api\AdminAPIController@employeeReport')->name('api.employee.report');
        Route::get('/attendance', 'Api\AdminAPIController@attendanceReport')->name('api.attendance.report');
    });

    Route::prefix('/config')->group(function () {
        Route::get('/department', 'Api\AdminAPIController@getDepartmentDate')->name('api.config.department');
    });
});

Route::prefix('/admin')->group(function(){
    Route::get('/login','AdminLoginController@showLoginForm')->name('admin.showLogin');
    Route::post('/login','AdminLoginController@login')->name('admin.login');
    Route::get('/logout','AdminLoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['adminSession']], function() {
        Route::get('/','AdminController@home')->name('admin.dashboard');
        Route::get('/api/{date?}', 'Api\AdminAPIController@dashboardDate')->name('api.dashboard');
        Route::get('/{staffId}/in','LogController@ClockIn')->name('admin.clockIn');
        Route::get('/{staffId}/out','LogController@ClockOut')->name('admin.clockOut');

        Route::prefix('/employee')->group(function () {
            Route::get('/records', 'AdminController@showEmployeeRecords')->name('employee.rec');
            Route::get('/biometrics', 'AdminController@showEmployeeBiometrics')->name('employee.bio');
            Route::get('/create', 'AdminController@createEmployeeRecord')->name('employee.cre');
            Route::get('/screen/{staffId}', 'AdminController@showEmployeeScreen')->name('employee.scr');
            Route::post('/screen/{staffId}', 'UpdateController@Update')->name('employee.update');
            Route::post('/register', 'RegisterController@Register')->name('employee.register');
        });

        Route::prefix('/attendance')->group(function () {
            Route::post('/records', 'AdminController@fetchAttendanceRecords')->name('attendance.fetch');
            Route::post('/manage', 'AdminController@fetchManageAttendanceRecords')->name('attendance.manage.fetch');
            Route::post('/edit/{date}', 'AdminController@editAttendanceRecords')->name('attendance.edit');
            Route::post('/delete/{date}', 'AdminController@deleteAttendanceRecords')->name('attendance.del');
            Route::post('/editTime/', 'AdminController@editTimeAttendanceRecords')->name('attendance.editTime');
            Route::get('/records', 'AdminController@showAttendanceRecords')->name('attendance.rec');
            Route::get('/manage', 'AdminController@manageAttendanceRecords')->name('attendance.man');
        });

        Route::prefix('/report')->group(function () {
            Route::get('/employee', 'AdminController@showEmployeeReport')->name('report.emp');
            Route::get('/attendance', 'AdminController@showAttendanceReport')->name('report.att');
        });

        Route::prefix('/config')->group(function () {
            Route::get('/department', 'AdminController@showConfigDepartment')->name('config.department');
            Route::get('/department/screen/{staffId}', 'AdminController@showDepartmentScreen')->name('config.department.scr');
            Route::post('department/screen/{id}', 'UpdateController@departmentUpdate')->name('department.update');
        });
    });
});

Route::prefix('/employee')->group(function(){
    Route::group(['middleware' => ['employeeSession']], function() {
        Route::get('/','EmployeeController@home')->name('employee.dashboard');
        Route::get('/{staffId}/in','LogController@ClockIn')->name('employee.clockIn');
        Route::get('/{staffId}/out','LogController@ClockOut')->name('employee.clockOut');
    });
});