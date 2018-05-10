<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Employee
        View::share('employee', '');
        View::share('employee_rec', '');
        View::share('employee_bio', '');
        View::share('employee_cre', '');

        //Attendance
        View::share('attendance', '');
        View::share('attendance_rec', '');
        View::share('attendance_man', '');

        //Report
        View::share('report', '');
        View::share('report_emp', '');
        View::share('report_att', '');

        //Config
        View::share('config', '');
        View::share('department', '');

        //Share the Logged in users info with all the views
        view()->composer('*',"App\Http\ViewComposers\ViewComposer");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
