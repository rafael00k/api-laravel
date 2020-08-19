<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

//Validador para operações de create na entidade Compras
class CompraValidationOnCreate {
    public function usuarioValidator($request) {
        $messages = [
            'titulo.required' => 'Titulo não informado.',
            'titulo.string' => 'Formato do titulo inválido',
            'titulo.max' => 'O titulo deve possuir no máximo 250 caracteres',
            'valor.required' => 'Valor não informado',
            'valor.numeric' => 'Formato do valor inválido',
            'valor.gt' => 'Valor deve ser maior que 0',
            'valor.regex' => 'Valor deve possuir no máximo duas casas decimais',
            'usuario_id.required' => 'Usuario da compra não informado',
            'usuario_id.numeric' => 'Formato do id_usuario inválido',
            'usuario_id.gt' => 'id_usuario deve ser maior que 0'
        ];

        $rules = [
            'titulo' => 'required|string|max:250',
            'valor' => 'required|numeric|gt:0|regex:/^\d*(\.\d{2})?$/',
            'usuario_id' => 'required|numeric|gt:0'
            
        ];

       

        $validator = Validator::make($request->all(),$rules,$messages);
        return $validator;

       
    }   
}
