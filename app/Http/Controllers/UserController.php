<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }


    public function index()
    {
        return view('user');
    } 

    public function getAll()
    {
        $result = User::all();
        return $result;

    }
    
    public function store(Request $request)
    {  
       
        $this->validate($request,[
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required']            
        ],[
            'name.required' => 'O campo name não pode ser vazio',
            'email.required' => 'O campo email não pode ser vazio',
            'password.required' => 'O campo senha não pode ser vazio'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        //User::create($request->all());       
        return "success";        

    }

    public function show(User $user)
    {       
       return $user;
    } 

    public function update(Request $request)
    {
                
        $student = User::find($request->id)->update($request->all());
        return "success";

    }

    public function destroy($id)
    {
        $student = User::find($id)->delete();
        return "success";
    }    
    
    
}
