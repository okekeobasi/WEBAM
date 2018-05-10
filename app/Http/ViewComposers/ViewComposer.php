<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 06/03/2018
 * Time: 12:49
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Department;


class ViewComposer
{
    public function compose(View $view) {

        $id = session()->get('staffId');
        $clients = User::find($id);
        $users = User::all();

        $view->with(['clients'=> $clients, 'Storage'=>Storage::class, 'users'=>$users]);
    }
}