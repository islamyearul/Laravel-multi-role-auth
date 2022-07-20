<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::all();
        return view('backend.user.user', compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Roles = Role::all();
        return view('backend.user.create', compact('Roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
         
        $this->validate($request, [
            'name' => 'required|unique:users|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
        ], [
            'name.required' => 'Name is required',
            'name.unique' => 'Name is already exists',
            'name.max' => 'Name is too long',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already exists',
            'email.max' => 'Email is too long',
            'password.required' => 'Password is required',
            'password.min' => 'Password is too short',
            'roles.required' => 'Role is required',
        ]);
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->save();
        if($request->roles ) {
            $User->assignRole($request->roles);
        }
        return redirect()->route('admin-user.index')->with('success', 'User created successfully');
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
        $User = User::findOrFail($id);
        $Roles = Role::all();
        return view('backend.user.edit', compact('User','Roles'));
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
            'email' => 'required|max:100',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Name is required',
            'name.max' => 'Name is too long',
            'email.required' => 'Email is required',
            'email.max' => 'Email is too long',
            'password.min' => 'Password is too short',
            'roles.required' => 'Role is required',
        ]);
        $User = User::findOrFail($id);
        $User->name = $request->name;
        $User->email = $request->email;
        if (!empty($request->password)) {
            $User->password = Hash::make($request->password);
        }
        $User->save();
       
        $User->roles()->detach();

        if($request->roles ) {
            $User->assignRole($request->roles);
        }
        return redirect()->route('admin-user.index')->with('success', 'User Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::findOrFail($id);
         $User->delete();
         return redirect()->route('admin-user.index')->with('success', 'User deleted successfully');
    }
}
