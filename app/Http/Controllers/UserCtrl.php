<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Validator;

class UserCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    public function create(Request $request){

        $validator = \Validator::make($request->all(), [
            'mail'      => 'required|unique:users|max:255|email',
            'username'  => 'required|unique:users|max:255',
            'name'      => 'required|max:255',
            'password'  => 'required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        
        $request['password'] = app('hash')->make($request->input('password'));
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function read(Request $request, $id){
        $user  = User::find($id);
        return response()->json($user);
    }
 
    public function update(Request $request, $id){
        $user = User::find($id);
        $validator = \Validator::make($request->all(), [
            'mail'      => 'nullable|unique:users|max:255|email',
            'username'  => 'nullable|unique:users|max:255',
            'name'      => 'nullable|max:255',
            'password'  => 'nullable|min:5|max:255',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if($request->input('mail')) $user->mail = $request->input('mail'); 
        if($request->input('name')) $user->name = $request->input('name'); 
        if($request->input('username')) $user->username = $request->input('username');
        if($request->input('address_strg')) $user->address_strg = $request->input('address_strg');
        if($request->input('password')) $user->password = app('hash')->make($request->input('password'));  

        $user->save();
        return response()->json($user);
    }  

    public function delete($id){
        $user  = User::find($id);
        $user->delete();
        return response()->json('Removed successfully.');
    } 

    public function index(){
        $users  = User::all();
        return response()->json($users);
    }
}
