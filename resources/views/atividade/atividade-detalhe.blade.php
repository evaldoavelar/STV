@extends('app')

@section('title')
    Editar Atividade
@stop

@section('container')



    <div class="container">

        <p><a href="{{url('unidade-detalhe',$atividade->unidade_id)}}"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a> </p>
        <div class="row">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h1>{{$atividade->titulo}}</h1>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">

                    <form id="frmAtividade" class="form-horizontal" role="form" action="{{url('realizar-atividade')}}"
                          method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="atividade_id" value="{{$atividade->id ? $atividade->id : old('id')}}"/>
                        <input type="hidden" name="unidade_id" value="{{$atividade->unidade_id}}"/>


                        <h4>{{$atividade->descricao}}</h4>

                        <div id="questoes">
                            @foreach( $atividade->questoes as $indice => $questao)
                                {{-- Enunciado da pergunta --}}
                                <div class="questao row" id="questao-{{$questao->id}}"
                                     data-questaoId="{{$questao->id}}">

                                    <div class="col-md-1 col-xs-2 contador">
                                        <p><span class="badge ">{{$indice + 1}}</span></p>
                                    </div>
                                    <div class="col-md-10 col-xs-9 questao-detalhe">

                                        <div class="form-group">
                                            <div class="col-xs-12 ">
                                                <p class="questao-detalhe-titulo">{{$questao->enunciado}}</p>
                                            </div>
                                        </div>

                                        <div class="respostas">
                                            @foreach( $questao->respostas as $resposta)
                                                {{-- resposta da atividade --}}
                                                <div class="form-group" id="resposta-{{$resposta->id}}">

                                                    <div class="col-xs-2 col-sm-1">
                                                        <input type="radio" name="questao[{{$questao->id}}][selecionada]"
                                                               class="pull-right"
                                                               value="{{$resposta->id}}">
                                                    </div>
                                                    <div class="col-xs-10 col-sm-7">
                                                        <p>{{$resposta->enunciado}}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <button type="submit" id="btnSalvar" class="btn btn-default ">Enviar</button>
                    </form>




                </div>
            </div>
        </div>

        <p><a href="{{url('unidade-detalhe',$atividade->unidade_id)}}"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a> </p>
    </div>
    </section>

@stop

@section('scripts')

    <script>
        $(function () {


            $('#frmAtividade').submit(function (event) {
                var erros = 0;
                var semCorreta = 0;

                //validar respostas
                $.each($('.questao'), function (i, value) {

                    //verficar se as questões tem a respotas correta selecionada
                    if ($(value).find('input[type=radio]:checked').size() === 0) {
                        value.classList.add('has-error');
                        semCorreta++;
                    }
                });

                if (semCorreta > 0) {
                    alert('Marque a respota correta de todas as questões');
                    return false;
                }

                return true;
            });
        });

    </script>
@stop
