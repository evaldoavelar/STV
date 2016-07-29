<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao','unidade_id', 'url');

    public function curso()
    {
        return $this->hasMany('App\Curso', 'unidade_id', 'id');
    }

    public function videosAssistidos()
    {
        return $this->hasMany('App\UserVideo', 'video_id', 'id');
    }
}
