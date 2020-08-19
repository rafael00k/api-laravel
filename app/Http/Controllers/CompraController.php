<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\Usuario;
use App\Http\Requests\CompraValidationOnCreate;
use App\Http\Requests\CompraValidationOnUpdate;
use Illuminate\Support\Facades\DB;


//Controller para operações envolvendo entidade compra
class CompraController extends Controller
{    
     
        public function index() {

            $compras = Compra::all();

            if(!$compras) {
                return  response()->json(['message'=> 'Não existem registros de compras'], 404);
            } 
            
                return  response()->json($compras);
            
        }
     
        public function show($id)  {   

            $compra = Compra::find($id);

            if(!$compra) {
                return  response()->json(['message'=> 'Registro de compra não encontrado'], 404);  
            }

            return  response()->json($compra);

        }
    
        public function store( Request $request) {

            $validation = new CompraValidationOnCreate();
            
            $usuario = Usuario::find($request['usuario_id']);

            if(!$usuario) {
                return  response()->json(['message'=> 'Registro de Usuário não encontrado'], 404); 
            }

            $validator = $validation->usuarioValidator($request);
           

           if($validator->fails()) {
            return response()->json([
                'message'   => 'Não foi possível Realizar a operação',
                'errors'        => $validator->errors()
            ], 422);
        }
            return Compra::create($request->all());
            
        }
    
        public function update(Request $request, $id)  {   

            $validation = new CompraValidationOnUpdate();
            $compra = Compra::find($id);

            if(!$compra) {
                return  response()->json(['message'=> 'Registro de compra não encontrado'], 404);  
            }

            //Verifica se o usuário da requisição é valido
            if(array_key_exists('usuario_id', $request->all()) && $request['usuario_id'] > 0) {
                $usuario = Usuario::find($request['usuario_id']);
                if(!$usuario) {
                    return  response()->json(['message'=> 'Registro de Usuário não encontrado'], 404); 
                }
            }

            
            $validator = $validation->usuarioValidator($request);

            
            if($validator->fails()) {
                return response()->json([
                    'message'   => 'Não foi possível Realizar a operação',
                    'errors'        => $validator->errors()
                ], 422);
            }
            
            $compra->update($request->all());
            return $compra;
        }
    
        public function delete(Request $request, $id) {
            $compra = Compra::find($id);

            if(!$compra) {
                return  response()->json(['message'=> 'Registro de Usuário não encontrado'], 404);  
            }

            return response()->json($compra->delete(), 204);
    
            
        }

        //Método para verificar o somatório de um determinado mês
        public function somatorioComprasMes($mes){
            
            $somatorio = DB::table('compras')
            ->select(DB::raw('sum(valor) as soma'))
            ->whereRaw('EXTRACT(MONTH from created_at) = ?',[$mes])
            ->get();
            if(!$somatorio) {
                return  response()->json(['message'=> 'Não existem registros de compras para o mês informado'], 404);
            }

            return response()->json($somatorio);
        }

      
    }



