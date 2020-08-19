<?php

namespace App\Http\Requests;


use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

//validador para operações de atualização com o usuário
class UsuarioValidationOnUpdate {
    public function usuarioValidator( Request $request, Usuario $usuario) {
        $messages = [
            'nome.min' => 'O nome deve possuir no minimo 3 caracteres',
            'nome.max' => 'O nome deve possuir no máximo 150 caracteres',
            'email.email' => 'Formato inválido de e-mail',
            'email.unique' => 'Email já cadastrado',
            'sexo.in' => 'Valor inválido para o atributo sexo'
        ];

        $rules = [
            'nome' => 'min:3|max:150|',
            'email' => 'email|unique:usuario',
            'sexo' => Rule::in(['Masculino','Feminino','Outro','Prefiro Não Informar'])
            ];

        $data = $request->all();
        //verifica se o email da requisição existe e se é igual ao do usuário a ser alterado para evitar problema com a restrição unique 
        if(array_key_exists('email', $data) && $usuario->email == $data['email']) {
            unset($data['email']);
        }

       

        $validator = Validator::make($data,$rules,$messages);
        return $validator;

       
    }   
}
