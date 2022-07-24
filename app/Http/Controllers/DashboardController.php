<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
   /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function userlogin()
        {
            return view('backend.layouts.ad-login');
        }
    
        public function userloginsubmit(Request $request)
        {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ], [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',

            ]);
            $email = $request->email;
            $password = Hash::make($request->password);
            $access = User::where('email' , $email )->orWhere('password', $password);
            if( $access){

                return redirect()->route('dashboard');
            } else{
                return view('backend.layouts.ad-login')->with('success', 'You Are not Registerd');
            }
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function createuser()
        {
            return view('backend.layouts.register');
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function userstore(Request $request)
        {
            // dd($request->all());
             
            $this->validate($request, [
                'name' => 'required|unique:users|max:100',
                'email' => 'required|unique:users|max:100',
                'password' => 'required|min:6|confirmed',
            ], [
                'name.required' => 'Name is required',
                'name.unique' => 'Name is already exists',
                'name.max' => 'Name is too long',
                'email.required' => 'Email is required',
                'email.unique' => 'Email is already exists',
                'email.max' => 'Email is too long',
                'password.required' => 'Password is required',
                'password.min' => 'Password is too short',
            ]);
            $User = new User();
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);
            $User->save();
                $User->assignRole('user');

            return redirect()->route('admin-user-login')->with('success', 'Registration successfully');
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
          
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            
        }
    }
    