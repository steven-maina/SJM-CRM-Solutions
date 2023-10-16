<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class AccessRoles extends Controller
{
  public function index1()
  {
    return view('content.apps.app-access-roles');
  }

  public function index()
  {
   // abort_if(Gate::denies('role-index'), redirect()->route('unauthorized'));
    $roles = Role::all()->where('deleted_at', null);

    return view('content.apps.app-access-roles', compact('roles'));
  }

  public function create()
  {
    abort_if(Gate::denies('role-add'), redirect()->route('unauthorized'));

    return view('roles.create');
  }

  public function store(StoreRoleRequest $request)
  {
    $roles= Role::create($request->all());
    return redirect()->route('roles.index', compact('roles'));
  }

  public function edit(Role $role)
  {
    abort_if(Gate::denies('role-edit'), redirect()->route('unauthorized'));

    $permissions = Permission::all()->pluck('name', 'id');

    $role->load('permissions');

    return view('roles.edit', compact('permissions', 'role'));
  }

  public function update(UpdateRoleRequest $request, Role $role)
  {
    $role->update($request->all());
//        $role->permissions()->sync($request->input('permissions', []));

    return redirect()->route('roles.index');
  }

  public function show(Role $role)
  {
    abort_if(Gate::denies('role-index'), redirect()->route('unauthorized'));

    $role->load('permissions');

    return view('roles.show', compact('role'));
  }

  public function destroy(Role $role)
  {
    abort_if(Gate::denies('role-delete'), redirect()->route('unauthorized'));

    $role->delete();

    return back();
  }

  public function massDestroy(MassDestroyRoleRequest $request)
  {
    Role::whereIn('id', request('ids'))->delete();

    return response(null, Response::HTTP_NO_CONTENT);
  }
  public function permission($id)
  {
    $lims_role_data = Role::find($id); // Find the role by ID

    if ($lims_role_data) {
      $permissions = Role::where('name', $lims_role_data->name)->first()->permissions;

      foreach ($permissions as $permission)
        $all_permission[] = $permission->name;
      if (empty($all_permission))
        $all_permission[] = 'No Permission(s) Found';
      return view('app.roles.permission', compact('lims_role_data', 'all_permission'));
    }
    else
      return redirect()->back()->with("error", "Could not found the role or permissions");
  }
  public function setPermission(Request $request)
  {
    $role = Role::firstOrCreate(['id' => $request['role_id']]);
    $permissionsToSync = collect($request->except(['_token', 'role_id']))
      ->filter(function ($value, $key) {
        return $value === '1';
      })
      ->keys()
      ->toArray();
    $role->syncPermissions($permissionsToSync);

    return redirect('roles')->with('message', 'Permissions updated successfully');
  }
}
