<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao','curso_id', 'url');

    public function curso()
    {
        return $this->hasMany('App\Curso', 'curso_id', 'id');
    }
}
