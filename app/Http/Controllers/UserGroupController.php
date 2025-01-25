<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkGroupToUserRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('groups')
            ->latest()
            ->paginate();

        $groups = Group::all();

        return view('users.index', compact(['users', 'groups']));
    }

    /**
     * Assign groups
     */
    public function store(LinkGroupToUserRequest $request, User $user)
    {
        $groupId = $request->validated()['group_id'];

        if ($user->groups->contains($groupId)) {
            session()->flash('error', 'User already belongs to this group.');

            return to_route('user-groups.index');
        }

        $user->groups()->attach($groupId);

        session()->flash('success', 'Group successfully linked to user!');

        return to_route('user-groups.index');
    }

    /**
     * group reset for user
     */
    public function reset(Request $request, User $user)
    {
        $user->groups()->detach();

        session()->flash('success', 'Groups reset successfully!');

        return to_route('user-groups.index');
    }
}
