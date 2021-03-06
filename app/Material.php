<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiais';

    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao','unidade_id', 'arquivo');

    public function unidade()
    {
        return $this->hasMany('App\Unidade', 'id','unidade_id')->get();
    }
}
