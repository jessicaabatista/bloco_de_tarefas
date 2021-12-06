<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    use HasFactory;

    public $table = "Anotacao";
    public $timestamps = false;
    protected $primaryKey = "AnotacaoID";   

    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'UsuarioIDFK');
    }
}
