<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserAccessController extends Controller
{
    //
    public function index()
    {
        // $menu = config('modules.menu');

        // foreach($menu as $key => $m) {
        //     if(is_array($m)) {
        //         $this->createPermission($key);
        //         continue;
        //     }

        //     $this->createPermission($m);
        // }

        // $utilities = config('modules.utilities');

        // foreach($utilities as $key => $m) {
        //     if(is_array($m)) {
        //         $this->createPermission($key);
        //         continue;
        //     }

        //     $this->createPermission($m);
        // }

        $modules = Permission::groupBy('module')->pluck('module');
        return view('pages.user-access-control.index', compact('modules'));
    }

    function createPermission($module)
    {
        Permission::firstOrCreate(['name' => 'view-'.$module,'module' => \Str::title(str_replace("-"," ",$module))]);
        Permission::firstOrCreate(['name' => 'create-'.$module,'module' => \Str::title(str_replace("-"," ",$module))]);
        Permission::firstOrCreate(['name' => 'edit-'.$module,'module' => \Str::title(str_replace("-"," ",$module))]);
        Permission::firstOrCreate(['name' => 'delete-'.$module,'module' => \Str::title(str_replace("-"," ",$module))]);

        return response()->json(['message' => 'permissions created']);
    }
}
