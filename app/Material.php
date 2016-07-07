<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiais';

    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao','curso_id', 'arquivo');

    public function curso()
    {
        return $this->hasMany('App\Curso', 'curso_id', 'id');
    }
}
