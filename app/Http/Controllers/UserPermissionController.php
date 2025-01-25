<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Services\ControllerMethodService;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index()
    {
        $users = User::with('permissions')->paginate();

        $controllerMethods = ControllerMethodService::get();

        return view('permissions.users', compact('users', 'controllerMethods'));
    }

    public function linkToUser(Request $request, User $user)
    {
        $permissions = ControllerMethodService::get();

        $request->validate([
            'permission_name' => [
                'required',
                'string',
                function (string $attribute, mixed $value, \Closure $fail) use ($permissions) {
                    [$controller, $method] = str($value)->explode('.')->toArray();

                    if (! in_array($controller, array_keys($permissions)) && ! in_array($method, $permissions[$controller])) {
                        $fail("The {$attribute} is invalid.");
                    }
                },
            ],
        ]);

        $permission = Permission::firstOrCreate(['name' => $request->permission_name]);

        $user->permissions()->syncWithoutDetaching([$permission->id]);

        session()->flash('success', 'Permission successfully linked to the user!');

        return redirect()->route('user-permissions.index');
    }

    public function reset(User $user)
    {
        $user->permissions()->detach();

        session()->flash('success', 'All permissions have been removed from the user.');

        return redirect()->route('user-permissions.index');
    }
}
