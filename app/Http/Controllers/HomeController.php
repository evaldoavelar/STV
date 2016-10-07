<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserCurso;
use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Curso;
use App\Inscrito;
use App\User;
use App\CursoAvaliacao;
use Auth;
use App\Library\Util;
use App\Http\Requests\CursoRequest;
use DB;
use App;

use App\Http\Requests;

class HomeController extends Controller
{
    function home(){

        if(Auth::check() && Auth::user()->admin){
            $cursos = Curso::all()->count();
            $usuarios = User::all()->count();

            return view('home/admin')->with(['cursos'=>$cursos,'usuarios'=>$usuarios]);
        }else{
            $cursos = Curso::orderBy('id', 'DESC')->take(3)->get();

            return view('home/home')->with(['cursos'=>$cursos]);
        }
    }
}
