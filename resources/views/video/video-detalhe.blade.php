@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')


    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque"><span>{{$video->descricao}}</span></p>
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
                            <h4><span class="glyphicon glyphicon-facetime-video"
                                      aria-hidden="true"></span> {{$video->titulo}}</h4>

                        </div>
                        <div class="panel-body">
                            <div class="row-fluid">
                                {!! $video->url !!}
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a class="btn btn-info "><span class="glyphicon glyphicon-ok"
                                                           aria-hidden="true"></span>   Marca Como Assistido</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop
