@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="hero-unit center">
                    <h1>Acesso Negado <small><font face="Tahoma" color="red">Error 403</font></small></h1>
                    <p>O recurso que você solicitou não pode ser acessado</p>
                    <p class="has-error"><b>{{ $exception->getMessage() }}</b></p>
                    <a href= "{{url('/')}}" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Página Incial</a>
                </div>
            </div>
        </div>
    </div>
@stop