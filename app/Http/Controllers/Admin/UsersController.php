<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangeUserRoleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    public function changeRole(ChangeUserRoleRequest $request, User $user)
    {
        $user->roles()->sync($request->role_ids);
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
