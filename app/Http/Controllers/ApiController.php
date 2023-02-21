<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    private $baseUrl;

    public function index()
    {
        $result = User::all();               
        return    response()->json($result, 200);
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
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);  

        return  response()->json(["mensaje"=>"Success", "data"=> $user], 200);
      
    }

    public function show($id)
    {       
       $user =User::find($id);
       if(is_null($user)){

            return response()->json(["mensaje"=>"Registro não encontrado"], 200);

       }
       return response()->json(["mensaje"=>"Success", "data"=> $user], 200);
    } 

    public function update(Request $request, $id)
    {
       
       $user =User::find($id);
       if(is_null($user)){

            return response()->json(["mensaje"=>"Registro não encontrado"], 200);

       }
        
        $reult = $user->update($request->all());
        return response(["mensaje"=>"Success", "data"=> $reult], 200);

    }

    public function destroy($id)
    {
       $user =User::find($id);
       if(is_null($user)){

            return response()->json(["mensaje"=>"Registro não encontrado"], 200);

       }
        $user->delete();
        return response()->json(["mensaje"=>"Usuário removido com sucesso"], 200);;
    }

    
}
