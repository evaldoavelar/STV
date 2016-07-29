<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestao extends Model
{
    protected $table = 'user_questoes';

    public function questoes()
    {
        return $this->hasOne('App\Questao', 'id','questao_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}
