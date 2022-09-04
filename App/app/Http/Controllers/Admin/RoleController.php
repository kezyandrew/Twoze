<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::with(['permissions'])->get();
        $permissions = Permission::get();
        return view('admin.role.roleTable', compact('roles','permissions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required',
        ]);

        $role = new Role();
        $role->title = $request->title;
        $role->save();
        
        $role->permissions()->sync($request->input('permission', []));
        return response()->json(['success' => true,'data' => $role, 'msg' => 'Role created successfully..!!'], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role = Role::find($id);

        $data['role'] = $role->load('permissions');
        $data['permissions'] = Permission::get();
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'bail|required',
        ]);

        $role = Role::find($id);
        $role->title = $request->title;
        $role->save();
        
        $role->permissions()->sync($request->input('permission', []));
        return response()->json(['success' => true,'data' => $role, 'msg' => 'Role edited successfully..!!'], 200);
    }

    public function destroy($id)
    {
        //
    }
}
