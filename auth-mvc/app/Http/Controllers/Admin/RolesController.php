<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function index() {
        Gate::authorize('viewAny', Role::class);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles', compact('roles', 'permissions'));
    }

    public function store(CreateRoleRequest $request) {
        Gate::authorize('create', Role::class);
        Role::create($request->validated());
        return redirect()->back()->with('success', 'Role created successfully.');
    }

    public function update(UpdateRoleRequest $request, Role $role) {
        Gate::authorize('update', $role);
        $role->update(['name' => $request->name]);
        $role->permissions()->sync($request->permissions ?? []); 
        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role) {
        Gate::authorize('delete', $role);
        if ($role->name === 'Admin') {
            return redirect()->back()->with('error', 'Cannot delete the admin role.');
        }
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
