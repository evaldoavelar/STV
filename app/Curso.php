<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function totalVideos()
    {

        $videos = DB::table('videos')
            ->join('unidades', 'unidades.id', '=', 'videos.unidade_id')
            ->join('cursos', function ($join) {
                $join->on('cursos.id', '=', 'unidades.curso_id')
                    ->where('cursos.id', '=', $this->id);
            })
            ->count();

        return $videos;
    }

    public function totalAtividades()
    {

        $videos = DB::table('atividades')
            ->join('unidades', 'unidades.id', '=', 'atividades.unidade_id')
            ->join('cursos', function ($join) {
                $join->on('cursos.id', '=', 'unidades.curso_id')
                    ->where('cursos.id', '=', $this->id);
            })
            ->count();

        return $videos;
    }

    public function totalMateriais()
    {

        $videos = DB::table('materiais')
            ->join('unidades', 'unidades.id', '=', 'materiais.unidade_id')
            ->join('cursos', function ($join) {
                $join->on('cursos.id', '=', 'unidades.curso_id')
                    ->where('cursos.id', '=', $this->id);
            })
            ->count();

        return $videos;
    }

    public function totalUnidades()
    {

        $videos = DB::table('unidades')
            ->join('cursos', function ($join) {
                $join->on('cursos.id', '=', 'unidades.curso_id')
                    ->where('cursos.id', '=', $this->id);
            })
            ->count();

        return $videos;
    }
}
