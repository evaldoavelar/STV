<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="Trabalho de Pós Graduação"/>

    <!--css customizados-->
    <link href="{{ URL::asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ URL::asset('css/theme.min.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>

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

<div class="navbar navbar-default navbar-static-top ">
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
            <a class="navbar-brand" href="home">STV</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Cursos<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right " aria-labelledby="download">
                        <li><a href="categorias/1" target="_top">Matémática</a></li>
                        <li class="divider"></li>
                        <li><a href="categorias/1" target="_top">Portugês</a></li>
                        <li class="divider"></li>
                        <li><a href="categorias/1" target="_top">História</a></li>
                        <li class="divider"></li>
                        <li><a href="categorias" target="_top">Todas</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Administração <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right " aria-labelledby="download">
                        <li><a href="usuario-lista" target="_top">Usuários</a></li>
                        <li class="divider"></li>
                        <li><a href="curso-lista" target="_top">Cursos</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a class="" href="meus-cursos" id="download" aria-expanded="false">Meus Cursos
                        <span class="card"></span></a>
                </li>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> 
                            <strong>Usuário</strong>
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
                                             <p class="text-left"><strong>Usuário</strong></p>
                                            <p class="text-left small">correoElectronico@email.com</p>
                                            <p class="text-left">
                                                <a href="#" class="btn btn-info btn-block btn-sm">Perfil</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="#" class="btn btn-danger btn-block">Sair</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</div>

<!-- Barra de Pesquisa -->

<div class="container espaco-30">

    <img class=" pull-left hidden-xs " src="images/logo.png">

    <nav id="busca" class=" pull-right">
        <form class="navbar-form navbar-left" role="search">

            <div class="input-group">
                <input type="text" class="form-control pesquisa" placeholder="Pesquisar...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                          </span>
            </div>

        </form>
    </nav>
</div>

@yield('container')

<!-- Rodapé -->

<footer class="site-footer style-2">
    <div class="vc_empty_space" style="height: 30px"><span
                class="vc_empty_space_inner"></span></div>
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-xs-12">
                <ul>
                    <li id="anpsimages-1" class="widget-container widget_anpsimages">
                        <h3 class="widget-title"></h3>
                        <img alt="Logo" class="img-rounded" src="images/logo3.png"/>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 col-xs-12">
                <ul>
                    <li id="nav_menu-1" class="widget-container widget_nav_menu">
                        <h3 class="widget-title">Navegação</h3>
                        <div class="menu-main-menu-container">
                            <ul id="menu-main-menu-1" class="menu">
                                <li class="">
                                    <a href="index  ">Início</a>
                                </li>
                                <li class="">
                                    <a href="servicos">Serviços</a>
                                </li>
                                <li class="">
                                    <a href="orcamento">Orçamento</a>
                                </li>
                                <li class=" ">
                                    <a href="sobre">Sobre</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>

            </div>

        </div>
    </div>
    <div class="container-fluid text-center site-footer-credito">
        <p>Desenvolvido por Evaldo Avelar Marques</p>
    </div>

    @yield('scripts')
</footer>

</body>
</html>