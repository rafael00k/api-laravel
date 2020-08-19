<?php

use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuario')->insert([
            'nome'  =>  'Maria da Silva',
            'email' => 'mariasilva1830@gmail.com',
            'sexo' => 'Feminino',
            
       ]);
       DB::table('usuario')->insert([
            'nome'  =>  'Luiza da Silva',
            'email' => 'luizadasilva1930@gmail.com',
            'sexo' => 'Feminino',
       ]);
    }
}
