<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }

    public function store(CreateRoleRequest $request) {
        Role::create($request->validated());
        return redirect()->back()->with('success', 'Role created successfully.');
    }

    public function update(UpdateRoleRequest $request, Role $role) {
        $role->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role) {
        if ($role->name === 'Admin') {
            return redirect()->back()->with('error', 'Cannot delete the admin role.');
        }
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
