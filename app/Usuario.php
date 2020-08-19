<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
//Entidade usuário
class Usuario extends Model {
    //
    use SoftDeletes;

    
    protected $table = 'usuario';
    protected $fillable = ['nome','email','sexo'];
    public $timestamps = FALSE;

    //relação muitos para um com compras
    public function compras() {
        return $this -> hasMany('App\Compra');
    }
    
}
