<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangeUserRoleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', User::class);
        $users = User::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    public function changeRole(ChangeUserRoleRequest $request, User $user)
    {
        Gate::authorize('changeRole', $user);
        $user->roles()->sync($request->role_ids);
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
