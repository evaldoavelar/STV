<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','ativo','admin',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function inscricoes()
    {
        return $this->hasMany('App\UserCurso', 'user_id', 'id');
    }

    public function videosAssistidos()
    {
        return $this->hasMany('App\UserVideo', 'user_id', 'id');
    }

    public function respostaQuestoes()
    {
        return $this->hasMany('App\UserQuestao', 'user_id', 'id');
    }


    public function cursos()
    {

      /*  $cursos = DB::table('cursos')
            ->join('user_cursos', 'user_cursos.curso_id', '=', 'cursos.id')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'user_cursos.user_id')
                    ->where('users.id', '=', $this->id);
            });  */

        return $this->belongsToMany('App\Curso','user_cursos')->withPivot('curso_id', 'user_id');

        /*return $this->hasManyThrough(
            'App\Curso', 'App\User',
            'curso_id', 'user_id', 'id'
        );*/

        return $cursos;
    }
}
