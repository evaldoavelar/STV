@extends('app')

@section('title')
    Cadastro de Cursos
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
            <div class="">
                <nav class="navbar navbar-default">

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="navbar-header">
                            <span class="navbar-brand" href="">Curso</span>
                        </div>
                        <ul class="nav navbar-nav">

                            <li>
                                <a href="{{ url('curso-editar', $curso->id)   }}" class=""><span
                                            class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Editar</a>
                            </li>
                            <li>
                                <a href="{{ url('curso-excluir', $curso->id)   }}" class="">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Excluir
                                </a>
                            </li>

                            <li>
                                @if($curso->publicado)
                                    <a href="{{ url('curso-despublicar', $curso->id)   }}" class=""><span
                                                class="glyphicon glyphicon-pushpin"
                                                aria-hidden="true"></span>&nbsp;Despublicar</a>
                                @else
                                    <a href="{{ url('curso-publicar', $curso->id)   }}" class=""><span
                                                class="glyphicon glyphicon-pushpin"
                                                aria-hidden="true"></span>&nbsp;Publicar</a>
                                @endif

                            </li>


                        </ul>

                    </div><!-- /.navbar-collapse -->

                </nav>
            </div>
        </div>
    </section>

    <div class="container espaco-20">

        <a class="btn btn-danger" href="{{url('unidade-novo',$curso->id)}}">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar uma
            Unidade</a>

    </div>

    @forelse( $curso->unidades()->get() as $unidade)

        <section name="unidade">
            <div class="container espaco-20">
                <div class="panel panel-default" title="Clique para expandir">

                    <a data-toggle="collapse" href="#unidade-{{$unidade->id}}"
                       {{$unidade_expande == $unidade->id ?'aria-expanded="true" ' :'aria-expanded="false"' }}
                       aria-controls="unidade-{{$unidade->id}}"
                       class="{{ $unidade_expande == $unidade->id ?'collapsed ' :'' }}"
                    >

                        <div class="panel-heading ">
                            <h4>

                                <span class="pdd glyphicon glyphicon-list-alt"
                                      aria-hidden="true"></span> {{$unidade->descricao}}

                                <span class="right fa fa-caret-square-o-down"
                                      aria-hidden="true"></span>
                            </h4>
                            <div>
                                <a href="{{url('unidade-editar',$unidade->id)}}">
                                    <span class="pdd glyphicon glyphicon-edit" aria-hidden="true"></span>Editar</a>
                                <a href="{{url('unidade-excluir',$unidade->id)}}">
                                    <span class="pdd glyphicon glyphicon-trash" aria-hidden="true"></span>Excluir</a>

                            </div>
                        </div>
                    </a>
                    <div id="unidade-{{$unidade->id}}"
                         class="panel-body {{-- $unidade_expande == $unidade->id ?'collapse in ' :'collapse' --}}"
                            {{--$unidade_expande == $unidade->id ?'aria-expanded="true" ' :'' --}}>

                        <section name="material">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <h4><span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                                        Material Didático
                                    </h4>
                                    <p><a href="{{url('material-novo',$unidade->id)}}"><span
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

                                    @foreach( $unidade->materiais as $material)
                                        <tr>
                                            <td>{{  $material->titulo }}</td>
                                            <td>{{  $material->descricao }}</td>
                                            <td>
                                                <a href="{{url('material-download',$material->id)}}">Download</a>
                                            </td>
                                            <td>
                                                <a href="{{url('material-editar',$material->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('material-excluir',$material->id)}}">
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
                                    <p><a href="{{url('video-novo',$unidade->id)}}"><span
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
                                    @foreach( $unidade->videos as $video)
                                        <tr>
                                            <td>{{  $video->titulo }}</td>
                                            <td><input type="text" value="{{$video->url}}"></td>
                                            <td>
                                                <a href="{{url('video-editar',$video->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('video-excluir',$video->id)}}">
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
                                    <p><a href="{{url('/atividade-novo',$unidade->id)}}"><span
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
                                    @foreach( $unidade->atividades as $atividade)
                                        <tr>
                                            <td>{{  $atividade->titulo }}</td>
                                            <td>
                                                <a href="{{url('atividade-editar',$atividade->id)}}">
                                                            <span class="glyphicon glyphicon-edit"
                                                                  aria-hidden="true"></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('atividade-excluir',$atividade->id)}}">
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

                    </div>
                </div>
            </div>
        </section>


    @empty


    @endforelse

    <div class="container espaco-20">

        <a class="btn btn-danger" href="{{url('unidade-novo',$curso->id)}}">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar uma
            Unidade</a>

    </div>

@stop

@section('scripts')

    <script>
        $(document).ready(function () {

            $(window).load(function () {
                //Posicionar a página sobre a unidade que está sendo manipulada
                $('html, body').animate({scrollTop: $('#unidade-{{ $unidade_expande }}').offset().top - 100}, 1000);

            });


            $(".glyphicon-trash").parent().click(function (event) {

                if (confirm("Deseja realmente excluir?") === false)
                    event.preventDefault();
            });

        });

    </script>

@stop