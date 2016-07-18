<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    protected $table = 'questoes';

    public function respostas()
    {
        return $this->hasMany('App\Questao', 'questao_id', 'id');
    }
}
