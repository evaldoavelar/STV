@extends('app')

@section('title')
    Editar Atividade
@stop

@section('container')


    <section>
        <div class="container jumbotron espaco-40">
            <div class="row">
                <div class="col-md-12 ">
                    <h1 class="destaque">Total: <span>{{$userAtividade->nota}}%</span></h1>
                    <p class="destaque-sub">Você acertou {{$userAtividade->acertos}} de {{$userAtividade->total_questoes}} respostas</p>
                    <p><a href="{{url('unidade-detalhe',$unidade_id)}}"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a> </p>
                </div>
            </div>
        </div>
    </section>



@stop

@section('scripts')


@stop
