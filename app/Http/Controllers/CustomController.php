<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\Usuario;
use Illuminate\Support\Facades\DB;

//Controller para operações envolvendo mais de uma entidade
class CustomController extends Controller
{
    //

    public function emailESoma(){
        $resposta = DB::table('usuario')
        ->join('compras','compras.usuario_id','=','usuario.id')                
        ->select(DB::raw('usuario.email as email,sum(compras.valor) as soma'))->groupByRaw('usuario.email')
        ->get();

        return response()->json($resposta);
    }
}
