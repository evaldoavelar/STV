<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoAvaliacao extends Model
{
    protected $table = 'curso_avalicao';

    public function curso()
    {
        return $this->hasOne('App\Curso', 'id','curso_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}
