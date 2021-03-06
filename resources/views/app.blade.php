<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="Trabalho de Pós Graduação"/>
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">

    <!--css customizados-->
    <link href="{{ URL::asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ URL::asset('css/theme.min.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!--scripts-->
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <script src="{{ URL::asset('js/jquery-2.2.3.min.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>

</head>
<body>

<!-- Barra de Navegação -->

<div class="navbar navbar-default navbar-fixed-top ">
    <div class="container">

        <!-- Brand and toggle -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('home')}}">STV</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">


                @if(Auth::check() &&  Auth::user()->admin)

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Administração
                            <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right " aria-labelledby="download">
                            <li><a href="{{ url('usuario-lista') }}" target="_top">Usuários</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('curso-lista') }}" target="_top">Cursos</a></li>

                        </ul>
                    </li>

                @elseif( Auth::check() &&  !Auth::user()->admin)
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Cursos<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right " aria-labelledby="download">
                            @foreach(\App\Categoria::all() as $cat)
                                <li><a href="{{url('cursos-por-categoria',$cat->id)}}"
                                       target="_top">{{$cat->descricao}}</a></li>
                            @endforeach

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="" href=" {{url('meus-cursos')}}" id="download" aria-expanded="false">Meus Cursos
                            <span class="card"></span></a>
                    </li>
                @endif

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> 
                            @if( Auth::check())
                                <strong>{{Auth::user()->name }}</strong>
                            @else
                                <strong>Fazer login</strong>
                            @endif
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <span class="glyphicon glyphicon-user icon-size"></span>
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            @if( Auth::check())
                                                <p class="text-left"><strong>{{Auth::user()->name }}</strong></p>
                                                <p class="text-left small">{{Auth::user()->email }}</p>
                                                <p class="text-left">

                                                </p>

                                            @else
                                                <p class="text-left"><strong>Faça o Login abaixo</strong></p>
                                                <p class="text-left">
                                                    <a href="{{url('/login')}}"
                                                       class="fa fa-btn fa-sign-in btn btn-info btn-block btn-sm">Login</a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @if(Auth::check())
                                <li class="divider"></li>
                                <li>
                                    <div class="navbar-login navbar-login-session">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>
                                                    <a href="{{url('/logout')}}"
                                                       class="btn btn-danger btn-block">Sair</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</div>

<!-- Barra de Pesquisa -->


<div class="container ">

    <div class="row  espaco-70">
       <img class=" pull-left hidden-xs " src="{{url('images/logo.png')}}">


        <nav id="busca" class="nav-pesquisa pull-right">
            @if( (!Auth::check()) || (Auth::check() &&  !Auth::user()->admin))
                <form class="navbar-form navbar-left" role="search" action="{{url('curso-pesquisa')}}" method="get">

                    <div class="input-group">
                        <input type="text" name="valor" class="form-control pesquisa" placeholder="Pesquisar...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                          </span>
                    </div>

                </form>
            @endif
        </nav>
    </div>
</div>


<section>
    <div class="container ">
        @if(isset($erro))
            <section>
                <div class=" ">
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="alert-link">{{ $erro  }}</a>
                    </div>
                </div>
            </section>
        @endif

        @if(isset($msg))
            <section>
                <div class=" ">
                    <div class="alert alert-info" role="alert">
                        <a href="#" class="alert-link">{{ $msg  }}</a>
                    </div>
                </div>
            </section>
        @endif
    </div>
</section>

@yield('container')
@yield('scripts')
<!-- Rodapé -->

<footer class="site-footer style-2">

    <div class="container pad-lg-t pad-md-b pad-md-t-mobi pad-no-b-mobi">
        <div class="row">
            <div class="col-md-5 relative">
                <img src="{{url('images/logo4.png')}}" class="mascote-coala absolute">
            </div>

            <div class="col-md-5 relative site-footer-logo">
                <h4><span class="first-letter">S</span>istema de <span class="first-letter">T</span>reinamento em <span
                            class="first-letter">V</span>ídeo</h4>
                <p>
                    Este sistema de treinamento online, permite que você tenha em mãos uma poderosa ferramenta para
                    melhorar o desempenho de todos os colaboradores de sua empresa, através de uma plataforma online
                    personalizada de treinamento em vídeo.
                </p>
            </div>

        </div>
        <!-- end .produtos -->
    </div>

    <div class="container-fluid text-center site-footer-credito">
        <p>Desenvolvido por Evaldo Avelar Marques</p>
    </div>


</footer>

</body>
</html>