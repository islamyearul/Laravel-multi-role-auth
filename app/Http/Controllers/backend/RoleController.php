<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.role.role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PermissionsAll = Permission::all();
        $Permission_Groups = User::getPermissionGroupName();
        return view('backend.role.create', compact('PermissionsAll', 'Permission_Groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $this->validate($request, [
            'name' => 'required|unique:roles|max:100',
            'permission' => 'required',
        ], [
            'name.required' => 'Role name is required',
            'name.unique' => 'Role name is already exists',
            'name.max' => 'Role name is too long',
            'permission.required' => 'Permission is required',
        ]);

        $role = Role::create(['name' => $request->name]);
        $Permissions = $request->input('permission');
        if( !empty($Permissions) ) {
            $role->syncPermissions($Permissions);
        }
        return redirect()->route('admin-role.index')->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Role = Role::findOrFail($id);
        $permissions = Permission::all();
        $Permission_Groups = User::getPermissionGroupName();
        return view('backend.role.edit', compact('Role','permissions', 'Permission_Groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'name' => 'required|max:100',
            'permission' => 'required',
        ], [
            'name.required' => 'Role name is required',          
            'name.max' => 'Role name is too long',
            'permission.required' => 'Permission is required',
        ]);

        $Role = Role::findOrFail($id);
        $Permissions = $request->input('permission');
        if( !empty($Permissions) ) {
            $Role->syncPermissions($Permissions);
        }
        $Role->name = $request->name;
        $Role->update();
        return redirect()->route('admin-role.index')->with('success', 'Role Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $role = Role::findOrFail($id);
         $role->delete();
            return redirect()->route('admin-role.index')->with('success', 'Role deleted successfully');

         
    }
}
