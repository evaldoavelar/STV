<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades';

    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao','unidade_id');

    public function unidade()
    {
        return $this->hasMany('App\Unidade', 'id','unidade_id')->get();
    }

    

}
