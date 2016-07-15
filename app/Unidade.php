<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{

    protected $table = 'unidades';

    //campos que seram recuperados no request
    protected $fillable = array('descricao','curso_id');

    public function curso()
    {
        return $this->hasMany('App\Curso', 'curso_id', 'id')->get();
    }

    public function materiais()
    {
        return $this->hasMany('App\Material', 'unidade_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany('App\Video', 'unidade_id', 'id');
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade', 'unidade_id', 'id');
    }
}
