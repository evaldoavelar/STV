@extends('app')

@section('title')
    Editar Atividade
@stop

@section('container')


    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="">Atividades</a></li>
        </ul>
    </div>



    <div class="container">

        <div class="row">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h1>Atividades do Curso</h1>
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

                    <form id="frmAtividade" class="form-horizontal" role="form" action="{{url('atividade/salvar')}}"
                          method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="id" value="{{$atividade->id ? $atividade->id : old('id')}}"/>
                        <input type="hidden" name="unidade_id"
                               value="{{$atividade->unidade_id ? $atividade->unidade_id : old('unidade_id')}}"/>

                        <div class="form-group">
                            <label for="titulo" class="col-sm-3 control-label">Título</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Título" value="{{old('titulo')}}">
                                <p class="help-block">Título do Material</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                            <div class="col-sm-9">
                                        <textarea class="form-control" id="descricao" name="descricao"
                                                  placeholder="Descrição">{{old('descricao')}}</textarea>
                                <p class="help-block">Descrição do Material</p>
                            </div>
                        </div>

                        <div id="questoes">
                            @foreach( $atividade->questoes as $indice => $questao)
                                {{-- Enunciado da pergunta --}}
                                <div class="questao" id="questao-{{$indice}}">
                                    <div class="form-group">
                                        <div class="col-sm-3 "></div>
                                        <div class="col-sm-9">
                                            <div class=" btn-group btn-group-xs pull-right" role="group"
                                                 aria-label="...">
                                                <button type="button" class="btn btn-primary questao-excluir">
                                                    <span class="glyphicon  glyphicon-ban-circle"></span>&nbsp;Excluir
                                                    Questão
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="titulo" class="col-sm-3 control-label">Enunciado</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control"
                                                      name="questao[{{$indice}}][enunciado]" rows="5"
                                                      placeholder="Enunciado da Questão">{{ isset($questao)? $questao->enunciado: old('questao.*.enunciado')}}</textarea>
                                            <p class="help-block">Respostas</p>
                                        </div>
                                    </div>

                                    <div class="respostas">
                                        @foreach( $questao->respostas as $resposta)
                                            {{-- resposta da atividade --}}
                                            <div class="form-group">
                                                <div class="col-xs-1 col-sm-3"></div>
                                                <div class="col-xs-1 col-sm-1">
                                                    <input type="radio" name="questao[{{$indice}}][correta]"
                                                           class="pull-right"
                                                           value="{{$resposta->id}}" {{$resposta->correta == true ? 'checked' : ''}}>
                                                </div>
                                                <div class="col-xs-7 col-sm-7">
                                                    <textarea type="text" class="form-control" id="resposta" rows="3"
                                                              name="questao[{{$indice}}][resposta][{{$resposta->id}}]"
                                                              placeholder="Resposta">{{$resposta->enunciado}}</textarea>
                                                </div>
                                                <div class="col-xs-1 col-sm-1">
                                                    {{-- excluir a resposta --}}
                                                    <span class="glyphicon glyphicon-ban-circle resposta-excluir"
                                                          title="Remover Opção"></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Botão de adicionar novas respostas--}}
                                    <div class="form-group ">
                                        <div class="col-sm-3 "></div>
                                        <div class="col-sm-9">
                                            <div class=" btn-group btn-group-xs " role="group" aria-label="...">
                                                <button type="button" class="btn btn-success questao-adicionar">
                                                    <span class="glyphicon  glyphicon-plus"></span>Adicionar Resposta
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <legend></legend>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group ">
                            <div class="col-sm-3 "></div>
                            <div class="col-sm-9">
                                <div class=" btn-group btn-group-sm " role="group" aria-label="...">
                                    <button id="btnNovaQuestao" type="button" class="btn btn-primary">Nova Questão
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="btnSalvar" class="btn btn-default ">Salvar Atividade</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    </section>

@stop

@section('scripts')
    @include('atividade.partial.atividade-script')

@stop
