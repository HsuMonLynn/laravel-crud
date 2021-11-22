<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
    
        return view('users.index',compact('users'));
            
    }
    public function create()
    {
       return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $user = User::create(
            [
                'name' => $request->name, 
                'email' => $request->email,                
                'password' => "password"
            ]); 
     
        return redirect()->route('users.index')
                        ->with('success','User created successfully.');
    }
    public function update(Request $request,User $user){
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $user->update([
                'name' => $request->name, 
                'email' => $request->email,                
                'password' => "password"
        ]);

        return redirect()->route('users.index')
                        ->with('success','User updated suceessfully.');

    }
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }
    

    
}