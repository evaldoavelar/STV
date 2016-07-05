<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiais';

    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao', 'arquivo');

    public function materiais()
    {
        return $this->hasMany('App\Curso', 'curso_id', 'id');
    }
}
