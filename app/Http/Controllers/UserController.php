<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\User;
use App\Models\Office;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=',  \Auth::id())->get();

        return view('pages.user.index', compact('users'));

    }

    public function create()
    {
        $offices = Office::all();
        return view('pages.user.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->office_id = $request->office_id;
        $user->password = bcrypt('password');
        $user->save();

        return redirect()->route('user.show', $user->id)->with('message', 'User successfuly saved.');

    }

    public function show($id)
    {
        // locally called, no need to verify
        // $host = request()->getHttpHost() .'/api/user/'. $id;
        // $response = Http::withOptions(['verify' => false])->get($host)->json();
        // $user = (object) $response['data']


        $user = User::findOrFail($id);

        $modules = Permission::groupBy('module')->pluck('module');

        $user_modules = [];
        foreach($modules as $key => $value) {
            $user_modules[$key]['name'] = $value;

            $permissions = $this->getPermissions($value);
            $user_modules[$key]['view'] = ['name' => $permissions[0]->name, 'value' => $user->hasPermissionTo($permissions[0]->name)];
            $user_modules[$key]['create'] = ['name' => $permissions[1]->name, 'value' => $user->hasPermissionTo($permissions[1]->name)];
            $user_modules[$key]['edit'] = ['name' => $permissions[2]->name, 'value' => $user->hasPermissionTo($permissions[2]->name)];
            $user_modules[$key]['delete'] = ['name' => $permissions[3]->name, 'value' => $user->hasPermissionTo($permissions[3]->name)];
        }


        $roles = Role::all();

        return view('pages.user.show', compact('user','user_modules', 'roles'));
    }

    public function edit(User $user)
    {
        // $user = $user->load('office');
        $offices = Office::all();

        return view('pages.user.edit', compact('user', 'offices'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->office_id = $request->office_id;
        $user->save();

        return redirect()->route('user.show', $user->id)->with('message', 'User successfuly updated.');
    }

    public function resetPassword(Request $request, $id)
    {
        $password = \Str::random(8);

        $user = User::findOrFail($id);
        $user->password = bcrypt($password);
        $user->save();

        return redirect()->route('user.show', $user->id)->with('message', 'Password successfuly reset. New Password is: '. $password);

    }

    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $values = $request->except(['_token','_method']);

        $permissions = [];
        foreach ($values['permissions'] as $key => $value) {
            $permissions[] = $key;
        }

        $user->syncPermissions($permissions);

        return redirect()->route('user.show', $user->id)->with('message', 'Permssions successfully updated');

    }

    function getPermissions($module) {
        return \DB::table('permissions')->where('module', $module)->get('name');
    }
}
