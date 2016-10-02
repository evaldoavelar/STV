@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque">Inscrito em <span>{{$inscrito}} Cursos</span></p>
                </div>
            </div>
        </div>
    </section>


    @forelse($cursos as $i => $curso)
        <section id="video">
            <div class="container espaco-40">
                <div class="row-fluid">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row-fluid">


                                    <div class="row">
                                        <div class="col-lg-9 contador">
                                            <h2>{{$curso->titulo}}</h2>
                                            <p><span class="badge ">{{$i+1}}</span> {{$curso->descricao}}
                                            </p>
                                            <p class="pull-left"><strong>Autor</strong> : {{$curso->instrutor}}</p>
                                        </div>
                                        <div class="col-lg-3 avaliacao avaliacao-direita">
                                            <div title="Clique para avaliar o Curso ">
                                                <h2> Avaliação</h2>
                                                <p>
                                                    @for($j = 1; $j<=5;$j++)
                                                        @if($j <= $curso->avaliacao)
                                                            <span class="glyphicon glyphicon-star"
                                                                  aria-hidden="true"></span>
                                                        @else
                                                            <span class="glyphicon glyphicon-star-empty"
                                                                  aria-hidden="true"></span>
                                                        @endif
                                                    @endfor
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row-fluid ">
                                            <div class="col-lg-12 ">
                                                <p><a class="pull-right" href="{{url('curso-detalhes',$curso->id)}}">Acessar&nbsp;&nbsp;<span
                                                                class="glyphicon glyphicon  glyphicon-chevron-right"
                                                                aria-hidden="true"></span> </a>
                                                </p>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @empty
        <h2 class="text-center ">Você ainda não está inscrito em nenhum Curso.</h2>
    @endforelse
@stop
