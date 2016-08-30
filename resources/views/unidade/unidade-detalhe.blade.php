@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')


    <section>
        <div class="container ">
            <p><a href="{{url('curso-detalhes\\'.$unidade->curso_id.'#unidades')}}"> <span
                            class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a></p>

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

    <section id="video">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Vídeos</h4>

                        </div>
                        @if($unidade->videos->count() > 0)
                            <div class="panel-body">
                                <div class="row-fluid">
                                    @forelse($unidade->videos as $i => $video)
                                        <div class="col-lg-12 contador">
                                            <p><span class="badge ">{{$i +1 }}</span>{{$video->titulo}}</p>
                                            <p>
                                                @if ( $video->videosAssistidos()->where('user_id',Auth::user()->id)->count() > 0)
                                                    <a class="pull-right" href="{{url('video-detalhe',$video->id)}}">
                                                <span class="glyphicon glyphicon-ok"
                                                      aria-hidden="true"></span> Vídeo Assitido</a>
                                                @else
                                                    <a class="pull-right" href="{{url('video-detalhe',$video->id)}}">
                                                <span class="glyphicon glyphicon-record"
                                                      aria-hidden="true"></span>Assistir</a>
                                                @endif
                                            </p>
                                        </div>
                                    @empty
                                        <p>Nenhum Vídeo Cadastrado</p>
                                    @endforelse

                                </div>
                            </div>
                        @endif
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

                                        @if ( $realizado = $atividade->UserNota()->where('user_id',Auth::user()->id )->orderBy('id', 'DESC')->get())@endif


                                        @if($realizado->count() > 0)
                                            <p><span class="glyphicon glyphicon-list"></span> Nota: <strong>{{$atividade->UserNota()->where('user_id',Auth::user()->id )->max('nota')}}%</strong></p>
                                            <p><span class="glyphicon glyphicon-indent-left"></span> Ultima tentativa - Acertos: {{$realizado[0]->acertos}} de {{$realizado[0]->total_questoes}}
                                                - {{$realizado[0]->nota}}%</p>

                                            <p>
                                                <a class="pull-right"
                                                   href="{{url('atividade-detalhe',$atividade->id)}}">
                                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                    Concluído</a>
                                            </p>
                                        @else
                                            <p>
                                                <a class="pull-right"
                                                   href="{{url('atividade-detalhe',$atividade->id)}}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    Realizar Atividade</a>
                                            </p>
                                        @endif
                                    </div>
                                @empty
                                    <p>Nenhuma Atividade Cadastrada</p>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <p><a href="{{url('curso-detalhes\\'.$unidade->curso_id.'#unidades')}}"> <span
                                    class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a></p>
                </div>
            </div>
        </div>
    </section>




@stop
