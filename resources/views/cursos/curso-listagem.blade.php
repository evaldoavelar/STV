@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque">Listagem de <span>Cursos</span></p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="curso-novo" class="">Novo</a></li>
                                <li><a href="" class=""></a></li>
                            </ul>
                            <form class="navbar-form navbar-left " role="search">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="nome">Título</option>
                                        <option value="email">Instrutor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Pesquisar">
                                </div>
                                <button type="submit" class="btn btn-default">Filtrar</button>
                            </form>

                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Cursos
                        </h4>
                    </div>
                    <div class="">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Instrutor</th>
                                <th>Vizualizar</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($cursos as $c)
                                <tr>
                                    <td>{{$c->titulo}}</td>
                                    <td>{{$c->instrutor}}</td>
                                    <td><a href="{{ url('/curso-admin-detalhes',$c->id)  }}"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a> </td>
                                    <td>
                                        <a href="{{url('curso-editar',$c->id)}}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('curso-excluir',$c->id)}}">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
