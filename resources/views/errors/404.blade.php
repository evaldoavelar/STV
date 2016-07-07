@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="hero-unit center">
                    <h1>Não encontrado <small><font face="Tahoma" color="red">Error 404</font></small></h1>
                    <p>O recurso que você solicitou não foi encontrado</p>
                    <p><b>Tente novamente</b></p>
                    <a href= "{{url('/')}}" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Página Incial</a>
                </div>
            </div>
        </div>
    </div>
@stop