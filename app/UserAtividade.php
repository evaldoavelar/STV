<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAtividade extends Model
{
    protected $table = 'user_atividade';

    public function questoes()
    {
        return $this->hasOne('App\Atividade', 'id','atividade_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}
