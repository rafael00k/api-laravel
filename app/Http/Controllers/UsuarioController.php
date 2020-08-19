<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Http\Requests\UsuarioValidationOnCreate;
use App\Http\Requests\UsuarioValidationOnUpdate;

class UsuarioController extends Controller
{
    //
     
        public function index()
        {   
            $usuarios = Usuario::all();

            if(!$usuarios) {
                return  response()->json(['message'=> 'Não existem registros de usuários'], 404);
            } 
            
                return  response()->json($usuarios);
            
        }
     
        public function show($id)
        {   

            $usuario = Usuario::find($id);

            if(!$usuario) {
                return  response()->json(['message'=> 'Registro de usuário não encontrado'], 404);  
            }

            return  response()->json($usuario);

        }
    
        public function store( Request $request)
        {   
            $validation = new UsuarioValidationOnCreate;
            $validator = $validation->usuarioValidator($request);
           

           if($validator->fails()) {
            return response()->json([
                'message'   => 'Não foi possível Realizar a operação',
                'errors'        => $validator->errors()
            ], 422);
        }
            return Usuario::create($request->all());
        }
    
        public function update(Request $request, $id)
        {   

            $validation = new UsuarioValidationOnUpdate();
            $usuario = Usuario::find($id);

            if(!$usuario) {
                return  response()->json(['message'=> 'Registro de usuário não encontrado'], 404);  
            }
            $validator = $validation->usuarioValidator($request,$usuario);

            
            if($validator->fails()) {
                return response()->json([
                    'message'   => 'Não foi possível Realizar a operação',
                    'errors'        => $validator->errors()
                ], 422);
            }

            $usuario->update($request->all());
            return $usuario;
        }
    
        public function delete(Request $request, $id)
        {
            $usuario = Usuario::find($id);

            if(!$usuario) {
                return  response()->json(['message'=> 'Registro de usuário não encontrado'], 404);  
            }

            return response()->json($usuario->delete(), 204);
    
            
        }

        public function usuariosOrdenados() {
            $usuarios = Usuario::orderBy('nome', 'ASC')->get();

            if(!$usuarios) {
                return  response()->json(['message'=> 'Não existem registros de usuários'], 404);
            } 
            
                return  response()->json($usuarios);
            
        }

      
    }

