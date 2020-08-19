<?php

namespace App\Http\Requests;



use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

//validador da entidade usuário para operações de create
class UsuarioValidationOnCreate {
    public function usuarioValidator($request) {
        $messages = [
            'nome.required' => 'Nome não informado.',
            'nome.min' => 'O nome deve possuir no minimo 3 caracteres',
            'nome.max' => 'O nome deve possuir no máximo 150 caracteres',
            'email.required' => 'Email não informado',
            'email.email' => 'Formato inválido de e-mail',
            'email.unique' => 'Email já cadastrado',
            'sexo.required' => 'Sexo não informado',
            'sexo.in' => 'Valor inválido para o atributo sexo'
        ];

        $rules = [
            'nome' => 'required|string|min:3|max:150',
            'email' => 'required|email|unique:usuario',
            'sexo' => ['required',Rule::in(['Masculino','Feminino','Outro','Prefiro Não Informar'])]
        ];

       

        $validator = Validator::make($request->all(),$rules,$messages);
        return $validator;

       
    }   
}
