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
                    <p class="destaque-sub"><a href="#video">{{$curso->totalVideos()}} Vídeos</a> | <a
                                href="#atividades"> {{$curso->totalAtividades()}} Atividades Avaliativas</a> | <a
                                href="#material">{{$curso->totalMateriais()}} Materiais Didáticos</a>
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
                                    <div title="Clique para avaliar o Curso">
                                        <h2> Avaliação </h2>
                                        <p>Clique na estrela para Avaliar o Curso</p>
                                        <p>
                                            @for($j = 1; $j<=5;$j++)
                                                @if($j <= $curso->avaliacoes())
                                                    <a href="{{url('curso-avaliacao/'.$curso->id.'/'.$j)}}"> <span
                                                                class="glyphicon glyphicon-star"
                                                                aria-hidden="true" title="Nota: {{$j}}"></span></a>
                                                @else
                                                    <a href="{{url('curso-avaliacao/'.$curso->id.'/'.$j)}}"> <span
                                                                class="glyphicon glyphicon-star-empty"
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
                                        @if($aprovado)
                                            <a href="{{url('curso-certificado',$curso->id)}}" class="btn btn-info btn-half-block">Gerar Certificado</a>
                                        @else
                                            <button class="btn btn-block btn-half-block disabled">Gerar Certificado
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="notas">
        <div class="container ">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3>Quadro de Notas</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="table-responsive">
                                <table class="table table-condensed ">
                                    <thead>
                                    <tr>
                                        <th>Unidade</th>
                                        <th>Avaliação</th>
                                        <th>Nota</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notas as $nota)
                                        <tr>
                                            <td>{{$nota->descricao}}</td>
                                            <td>{{$nota->titulo}}</td>

                                            @if($nota->nota > 70)
                                                <td class="nota-aprovado">{{$nota->nota}}</td>
                                            @else
                                                <td class="nota-reprovado">{{$nota->nota ? $nota->nota : '-' }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <td> Porcentagem de Vídeos Assistidos:</td>
                                    <td></td>
                                    @if($nota->nota >= 100)
                                        <td class="nota-aprovado">{{$videosAssistido}}%</td>
                                    @else
                                        <td class="nota-reprovado">{{$videosAssistido}}%</td>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <p ><small>Aprovação: 70% de Acertos nas atividades e 100% dos vídeos assistidos</small></p>
                    @if($aprovado)
                        <p class="text-center nota-aprovado">Você já foi aprovado neste Curso</p>
                    @else
                        <p class="text-center nota-reprovado">Você ainda não foi aprovado neste Curso</p>
                    @endif

                </div>
            </div>
        </div>
        </div>
    </section>


    <section>
        <div class="container ">
            <div class="row">
                <div class="col-md-12 ">
                    <p class="destaque"><span>Unidades</span> do curso </p>
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
                                            <span class="glyphicon glyphicon-chevron-right"
                                                  aria-hidden="true"></span></a>
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
