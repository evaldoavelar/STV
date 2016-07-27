<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    
    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao', 'instrutor', 'categoria_id','palavras_chaves');

    public function unidades()
    {
        return $this->hasMany('App\Unidade', 'curso_id', 'id');
    }

    public function categoria()
    {
        return $this->hasOne('App\Categoria', 'categoria_id', 'id');
    }

    public function inscritos()
    {
        return $this->hasMany('App\Inscrito', 'curso_id', 'id');
    }

/*    public function curso()
    {
        return $this->hasMany('App\Curso', 'curso_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany('App\Video', 'curso_id', 'id');
    }*/
}
