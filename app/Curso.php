<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    
    //campos que seram recuperados no request
    protected $fillable = array('titulo','descricao', 'instrutor', 'categoria_id','palavras_chaves');
}
