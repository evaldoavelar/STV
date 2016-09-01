<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Curso extends Model
{
    protected $table = 'cursos';

    private $media = 0;

    //campos que seram recuperados no request
    protected $fillable = array('titulo', 'descricao', 'instrutor', 'categoria_id', 'palavras_chaves');

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
        return $this->hasMany('App\UserCurso', 'curso_id', 'id');
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

    public function mediaAvaliacao()
    {
        $media = DB::table('curso_avalicao')
            ->join('cursos', function ($join) {
                $join->on('cursos.id', '=', 'curso_avalicao.curso_id')
                    ->where('cursos.id', '=', $this->id);
            })
            ->avg('avaliacao');

        return $media;
    }


    public function avaliacoes()
    {
        if ($this->media == 0 || $this->media == null)
            $this->media = $this->mediaAvaliacao($this->id);

        return $this->media;
    }

    public function aprovado($user_id)
    {
        $notas = $this->RetornaNotaUsuarioCurso($user_id);

        $aprovado = true;

        //verificar se o aluno tem nota superior a 70%
        foreach ($notas as $nota) {
            if ($nota->nota < 70) {
                $aprovado = false;
                break;
            }
        }

        //verificar se o aluno assistiu a todos os cursos 
        $videosAssitidos = $this->RetornaUsuarioVideosVisualizados($user_id);
        foreach ($videosAssitidos as $videos) {
            if ($videos->assitido == 0) {
                $aprovado = false;
                break;
            }
        }


        return $aprovado;
    }

    public function  RetornaPorcentagemVideosAssistidos($user_id)
    {
        $videosVisualizados = $this->RetornaUsuarioVideosVisualizados($user_id);

        $visualizado = 0;
        $naoVisualizado = 0;

        foreach (  $videosVisualizados as $video ){
            if ($video->assitido > 0)
                $visualizado++;
            else
                $naoVisualizado++;
        }

        if (count($videosVisualizados) == 0 ) return 0;

        return ($visualizado * 100) /  count($videosVisualizados);
    }

    /*Nota usuario*/
    public function RetornaUsuarioVideosVisualizados($user_id)
    {
        $sql = "";
        $sql .= " SELECT videos.titulo, ";
        $sql .= "       Count(user_videos.video_id) assitido ";
        $sql .= " FROM   videos ";
        $sql .= "       LEFT JOIN unidades ";
        $sql .= "              ON unidades.id = videos. unidade_id ";
        $sql .= "       LEFT JOIN user_videos ";
        $sql .= "              ON videos.id = user_videos.video_id ";
        $sql .= " WHERE  ( user_videos.user_id = " . $user_id;
        $sql .= "          OR user_videos.user_id IS NULL ) ";
        $sql .= "       AND unidades.curso_id = " . $this->id;
        $sql .= " GROUP  BY videos.id ";
        $sql .= " ORDER  BY videos.id";

        // dd($sql);

        return DB::select($sql);
    }


    /*Nota usuario*/
    public function RetornaNotaUsuarioCurso($user_id)
    {

        $sql = "";
        $sql .= " SELECT unidades.descricao, ";
        $sql .= "       COALESCE(atividades.titulo, '')       titulo, ";
        $sql .= "       Max(user_atividade.nota) nota ";
        $sql .= " FROM   unidades ";
        $sql .= "       LEFT JOIN atividades ";
        $sql .= "              ON atividades.unidade_id = unidades. id ";
        $sql .= "       LEFT JOIN user_atividade ";
        $sql .= "              ON atividades.id = user_atividade.atividade_id ";
        $sql .= " WHERE  ( user_atividade.user_id = " . $user_id;
        $sql .= "          OR user_atividade.user_id IS NULL ) ";
        $sql .= "       AND curso_id = " . $this->id;
        $sql .= " GROUP  BY unidades.id, ";
        $sql .= "          unidades.curso_id, ";
        $sql .= "          atividades.id  ";
        $sql .= " ORDER  BY unidades.id ";

        // dd($sql);

        return DB::select($sql);
    }
}
