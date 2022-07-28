<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Permissions = Permission::all();
        return view('backend.role.permission.permission', compact('Permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $Permissions = Permission::all();
        $permission_groups = DB::table('permissions')->select('group_name as name')->groupBy('group_name')->get();
        return view('backend.role.permission.create', compact('Permissions', 'permission_groups'));
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
            'name' => 'required|unique:permissions|max:100',
            'group_name' => 'required',
        ], [
            'name.required' => 'Permission name is required',
            'name.unique' => 'Permission name is already exists',
            'name.max' => 'Permission name is too long',
            'group_name.required' => 'Permission group is required',
        ]);

            $Permission = Permission::create(['name' => $request->name, 'group_name' => $request->group_name, 'guard_name' => $request->guard_name]);
            return redirect()->route('admin-permission.index')->with('success', 'Permission created successfully');
            // return redirect()->route('admin-permission.index')->session()->flash('success', 'Permission created successfully');
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
        $Permission = Permission::findOrFail($id);
        $permission_groups = DB::table('permissions')->select('group_name as name')->groupBy('group_name')->get();
        return view('backend.role.permission.edit', compact('Permission', 'permission_groups'));
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
            'name' => 'required|unique:permissions|max:100',
            'group_name' => 'required',
        ], [
            'name.required' => 'Permission name is required',
            'name.unique' => 'Permission name is already exists',
            'name.max' => 'Permission name is too long',
            'group_name.required' => 'Permission group is required',
        ]);

            $Permission = Permission::findOrFail($id);
            $Permission->name = $request->name;
            $Permission->group_name = $request->group_name;
            $Permission->save();
          

            return redirect()->route('admin-permission.index')->with('success', 'Permission Update successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Permission = Permission::findOrFail($id);
        $Permission->delete();
        return redirect()->route('admin-permission.index')->with('success', 'permission deleted successfully');

    }
}
