@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')


    <section xmlns="http://www.w3.org/1999/html">
        <div class="container espaco-40">
            <div class="row">
                <div class="col-md-12 ">
                    <p class="destaque">Detalhes Curso <span>{{$curso->titulo}}</span></p>
                    <p class="destaque-sub">{{$curso->descricao}} </p>
                    <p class="destaque-sub">Instrutor - <span>{{$curso->instrutor}}</span></p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container ">
            <div class="row">
                <nav class="navbar navbar-default">

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ url('curso-novo')  }} " class=""><span class="glyphicon glyphicon-plus"
                                                                                   aria-hidden="true"></span>&nbsp;Novo</a>
                            </li>
                            <li>
                                <a href="{{ url('curso-editar', $curso->id)   }}" class=""><span
                                            class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Editar</a>
                            </li>

                        </ul>

                    </div><!-- /.navbar-collapse -->

                </nav>
            </div>
        </div>
    </section>


    <section name="unidade">
        <div class="container espaco-20">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <h4>
                        <a data-toggle="collapse" href="#unidade-1" aria-expanded="false" aria-controls="unidade-1">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Unidade 1 - Estudo da
                        Matématica</a>
                    </h4>
                    <p>
                        <a href="{{url('unidade-novo',$curso->id)}}">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a>
                    </p>
                </div>
                <div id="unidade-1" class="panel-body collapse">

                    <section name="material">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <h4><span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                                        Material Didático
                                    </h4>
                                    <p><a href="{{url('novo-material',$curso->id)}}"><span
                                                    class="glyphicon glyphicon-plus"
                                                    aria-hidden="true"></span> Novo</a>
                                    </p>


                                </div>
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Descrição</th>
                                        <th>Link</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach( $curso->materiais as $material)
                                        <tr>
                                            <td>{{  $material->titulo }}</td>
                                            <td>{{  $material->descricao }}</td>
                                            <td>
                                                <a href="{{url('download-material',$material->id)}}">Download</a>
                                            </td>
                                            <td>
                                                <a href="{{url('editar-material',$material->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('excluir-material',$material->id)}}">
                                                            <span class="glyphicon glyphicon-trash"
                                                                  aria-hidden="true"></span>
                                                </a>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </section>


                    <section name="video">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <h4><span class="glyphicon glyphicon-facetime-video"
                                              aria-hidden="true"></span> Vídeos</h4>
                                    <p><a href="{{url('novo-video',$curso->id)}}"><span
                                                    class="glyphicon glyphicon-plus"
                                                    aria-hidden="true"></span> Novo</a></p>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Url</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $curso->videos as $video)
                                        <tr>
                                            <td>{{  $video->titulo }}</td>
                                            <td><input type="text" value="{{$video->url}}"></td>
                                            <td>
                                                <a href="{{url('editar-video',$video->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('excluir-video',$video->id)}}">
                                                            <span class="glyphicon glyphicon-trash"
                                                                  aria-hidden="true"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </section>

                    <section name="atividades">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                                        Atividades</h4>
                                    <p><a href="{{url('curso-cadastro-material',$curso->id)}}"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                            Novo</a></p>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Atividade 1</td>
                                        <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </td>
                                        <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Atividade 2</td>
                                        <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </td>
                                        <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                    </section>

                </div>
            </div>
        </div>
    </section>


    <section name="unidade">
        <div class="container espaco-20">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <h4>
                        <a data-toggle="collapse" href="#unidade-2" aria-expanded="false" aria-controls="unidade-2">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Unidade 2 - Estudo da
                            Matématica na vida Moderna</a>
                    </h4>
                    <p>
                        <a href="{{url('novo-material',$curso->id)}}">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a>
                    </p>
                </div>
                <div id="unidade-2" class="panel-body collapse">

                    <section name="material">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                <h4><span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                                    Material Didático
                                </h4>
                                <p><a href="{{url('novo-material',$curso->id)}}"><span
                                                class="glyphicon glyphicon-plus"
                                                aria-hidden="true"></span> Novo</a>
                                </p>


                            </div>
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Descrição</th>
                                    <th>Link</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach( $curso->materiais as $material)
                                    <tr>
                                        <td>{{  $material->titulo }}</td>
                                        <td>{{  $material->descricao }}</td>
                                        <td>
                                            <a href="{{url('download-material',$material->id)}}">Download</a>
                                        </td>
                                        <td>
                                            <a href="{{url('editar-material',$material->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('excluir-material',$material->id)}}">
                                                            <span class="glyphicon glyphicon-trash"
                                                                  aria-hidden="true"></span>
                                            </a>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>


                    <section name="video">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                <h4><span class="glyphicon glyphicon-facetime-video"
                                          aria-hidden="true"></span> Vídeos</h4>
                                <p><a href="{{url('novo-video',$curso->id)}}"><span
                                                class="glyphicon glyphicon-plus"
                                                aria-hidden="true"></span> Novo</a></p>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Url</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $curso->videos as $video)
                                    <tr>
                                        <td>{{  $video->titulo }}</td>
                                        <td><input type="text" value="{{$video->url}}"></td>
                                        <td>
                                            <a href="{{url('editar-video',$video->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('excluir-video',$video->id)}}">
                                                            <span class="glyphicon glyphicon-trash"
                                                                  aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section name="atividades">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                <h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                                    Atividades</h4>
                                <p><a href="{{url('curso-cadastro-material',$curso->id)}}"><span
                                                class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        Novo</a></p>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Atividade 1</td>
                                    <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </td>
                                    <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Atividade 2</td>
                                    <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </td>
                                    <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </section>

                </div>
            </div>
        </div>
    </section>

@stop
