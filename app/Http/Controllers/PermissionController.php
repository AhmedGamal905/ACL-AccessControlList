<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use App\Services\ControllerMethodService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $controllerMethods = ControllerMethodService::get();

        $groups = Group::with('permissions')->get();

        return view('permissions.index', compact('controllerMethods', 'groups'));
    }

    public function linkToGroups(Request $request)
    {
        $permissionName = $request->permission;

        $permission = Permission::firstOrCreate(['name' => $permissionName]);

        $permission->groups()->sync($request->groups);

        session()->flash('success', 'Permission successfully linked to selected groups!');

        return to_route('permissions.index');
    }

    public function linkToUsers(Request $request)
    {
        $request->validate([
            'permission_name' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $permission = Permission::firstOrCreate(['name' => $request->permission_name]);

        $user = User::findOrFail($request->user_id);

        $user->permissions()->syncWithoutDetaching([$permission->id]);

        session()->flash('success', 'Permission successfully linked to the user!');

        return to_route('permissions.index');
    }
}
