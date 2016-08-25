@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container jumbotron espaco-40">
            <div class="row">
                <div class="col-md-12 ">
                    <h1 class="destaque"><span>{{$curso->titulo}}</span></h1>
                    <p class="destaque-sub"><a href="#unidades">{{$curso->totalUnidades()}} Unidades</a></p>
                    <p class="destaque-sub"><a href="#video">{{$curso->totalVideos()}} Vídeos</a> | <a href="#atividades"> {{$curso->totalAtividades()}} Atividades  Avaliativas</a> | <a href="#material">{{$curso->totalMateriais()}} Materiais Didáticos</a>
                           </p>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container espaco-40">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="panel panel-default avaliacao">
                        <div class="panel-body">
                            <div class="row-fluid">
                                <div class="col-lg-12">
                                    <p>{{$curso->descricao}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div title="Clique para avaliar o Curso" >
                                        <h2> Avaliação </h2>
                                        <p>Clique na estrela para Avaliar o Curso</p>
                                        <p>
                                            @for($j = 1; $j<=5;$j++)
                                                @if($j <= $curso->avaliacoes())
                                                   <a href="{{url('curso-avaliacao/'.$curso->id.'/'.$j)}}"> <span class="glyphicon glyphicon-star"
                                                          aria-hidden="true" title="Nota: {{$j}}"></span></a>
                                                @else
                                                    <a href="{{url('curso-avaliacao/'.$curso->id.'/'.$j)}}"> <span class="glyphicon glyphicon-star-empty"
                                                          aria-hidden="true" title="Nota: {{$j}}"></span></a>
                                                @endif
                                            @endfor
                                        </p>
                                    </div>
                                    <p class="pull-left"><strong>Instrutor</strong> : {{$curso->instrutor}}</p>

                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12 espaco-10">

                                    </div>
                                    <div class="col-md-12 espaco-10 ">
                                        <a class="btn btn-info btn-half-block">Gerar Certificado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container ">
            <div class="row">
                <div class="col-md-12 ">
                    <p class="destaque"><span>Conteúdo</span> do curso </p>
                </div>
            </div>
        </div>
    </section>





        <section id="unidades">
            <div class="container espaco-40">
                <div class="row">
                    <div class="col-md-12 ">
                        @foreach( $curso->unidades()->get() as $i => $unidade)
                        <div class="panel panel-default" id="unidade{{$unidade->id}}">

                            <div class="panel-body">


                                    <div class="col-lg-12 contador">
                                        <p><span class="badge ">{{$i+1}}</span>{{$unidade->descricao}}</p>
                                        <p><a class="pull-right" href="{{url('unidade-detalhe',$unidade->id)}}">Acessar
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                                        </p>
                                    </div>


                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>



@stop
