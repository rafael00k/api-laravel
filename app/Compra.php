<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    //
    use SoftDeletes;

    
    protected $table = 'compras';
    protected $fillable = ['titulo','valor','usuario_id'];
    public $timestamps = true;
    protected $dates = ['created_at'];

    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }
    
    
}
