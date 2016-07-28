@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')


    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque"><span>{{$unidade->descricao}}</span></p>
                </div>
            </div>
        </div>
    </section>



    <section id="material">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Material Didático
                            </h4>

                        </div>
                        <div class="panel-body">
                            @forelse($unidade->materiais as $material)
                                <p>
                                    <a href="{{url('material-download',$material->id)}}">
                                        <span class="glyphicon glyphicon-download"></span> {{$material->descricao}}
                                    </a>
                                </p>
                            @empty
                                <p>Nenhum Material Cadastrado</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="atividades">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Atividades</h4>

                        </div>

                        <div class="panel-body">
                            <div class="row-fluid">
                                @forelse($unidade->atividades as $i => $atividade)
                                    <div class="col-lg-12 contador">
                                        <p><span class="badge ">{{$i + 1}}</span> {{$atividade->titulo}}</p>
                                        <p><a class="pull-right" href=""><span class="glyphicon glyphicon-ok"
                                                                               aria-hidden="true"></span> Concluído</a>
                                        </p>
                                    </div>
                                @empty
                                    <p>Nenhuma Atividade Cadastrada</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="video">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Vídeos</h4>

                        </div>
                        <div class="panel-body">
                            <div class="row-fluid">
                                @forelse($unidade->videos as $i => $video)
                                    <div class="col-lg-12 contador">
                                        <p><span class="badge ">{{$i +1 }}</span>{{$video->titulo}}</p>
                                        <p><a class="pull-right" href="{{url('video-detalhe',$video->id)}}">
                                                <span class="glyphicon glyphicon-ok"
                                                      aria-hidden="true"></span> Vídeo Assitido</a>
                                        </p>
                                    </div>
                                @empty
                                    <p>Nenhum Vídeo Cadastrado</p>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
