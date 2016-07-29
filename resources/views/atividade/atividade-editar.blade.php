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

                    <form id="frmAtividade" class="form-horizontal" role="form" action="{{url('atividade/atualizar')}}"
                          method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="id" value="{{$atividade->id ? $atividade->id : old('id')}}"/>

                        <div class="form-group">
                            <label for="titulo" class="col-sm-3 control-label">Título</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Título"
                                       value="{{$atividade->titulo ? $atividade->titulo : old('titulo')}}">
                                <p class="help-block">Título do Material</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                            <div class="col-sm-9">
                                        <textarea class="form-control"
                                                  id="descricao"
                                                  name="descricao"
                                                  rows="5"
                                                  placeholder="Descrição">{{$atividade->descricao ? $atividade->descricao : old('descricao')}}</textarea>
                                <p class="help-block">Descrição do Material</p>
                            </div>
                        </div>

                        <div id="questoes">
                            @foreach( $atividade->questoes as $indice => $questao)
                                {{-- Enunciado da pergunta --}}
                                <div class="questao" id="questao-{{$questao->id}}" data-questaoId="{{$questao->id}}">
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
                                            <input type="hidden" name="questao[{{$questao->id}}][status]" value="E">
                                            <textarea class="form-control"
                                                      name="questao[{{$questao->id}}][enunciado]]"
                                                      rows="5"
                                                      placeholder="Enunciado da Questão">{{ isset($questao)? $questao->enunciado: old('questao.*.enunciado')}}</textarea>
                                            <p class="help-block">Respostas</p>
                                        </div>
                                    </div>

                                    <div class="respostas" >
                                        @foreach( $questao->respostas as $resposta)
                                            {{-- resposta da atividade --}}
                                            <div class="form-group" id="resposta-{{$resposta->id}}" >
                                                <div class="col-xs-1 col-sm-3"></div>
                                                <div class="col-xs-1 col-sm-1">
                                                    <input type="radio" name="questao[{{$questao->id}}][correta]"
                                                           class="pull-right"
                                                           value="{{$resposta->id}}" {{$resposta->correta == true ? 'checked' : ''}}>
                                                </div>
                                                <div class="col-xs-7 col-sm-7">
                                                    <input type="hidden" name="questao[{{$questao->id}}][resposta][{{$resposta->id}}][status]" value="E">
                                                    <textarea type="text" class="form-control" id="resposta" rows="3"
                                                              name="questao[{{$questao->id}}][resposta][{{$resposta->id}}][enunciado]"
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
                                                <button type="button" class="btn btn-success resposta-adicionar">
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

    <script>
        $(function () {

            //id dos elementos
            var idResposta = 0;
            var idQuestao =  0;


            $.each($('.questao'), function (i, value) {

                //configurarAdicionarQuestao('.resposta-adicionar',value.dataset.questaoid);

                configurarExcluirQuestao('.questao-excluir');

                configurarExcluirResposta('.resposta-excluir');


                $(value).find('.resposta-adicionar').click(function () {
                    var root = this.parentNode.parentNode.parentNode.parentNode;
                    AdicionarResposta($(root).find('.respostas'), value.dataset.questaoid);
                });
            });

            $("#btnNovaQuestao").click(function (event) {

                idQuestao++;
                while ( $('questao-'+idQuestao).size() > 0 )idQuestao++;

                $.ajax({
                    url: "{{ url('/atividade-questao') }}/" + idQuestao,
                    success: function (result) {
                        console.log("Requisição Ajax completada com sucesso");
                        console.log("Adicionando resultado");

                        $("#questoes").append(result);

                        configurarAdicionarQuestao('.resposta-adicionar', idQuestao);

                        configurarExcluirQuestao('.questao-excluir');

                        configurarExcluirResposta('.resposta-excluir');

                        //adicionar respostas
                        for (i = 0; i < 4; i++) {
                            AdicionarResposta($("#questao-" + idQuestao).find('.respostas'), idQuestao);
                        }
                    },
                    error: function (event) {
                        console.log("Erro na Requisição Ajax ");
                    }
                });
            });

            function configurarAdicionarQuestao(classe, id) {
                console.log("Configurar o click do botão de adicionar resposta");
                $.each($(classe), function (i, value) {

                    //remover o onclick de dos botões criados anteriormente para não gerar conflito
                    $(value).attr('onclick', '').unbind('click');

                    //adicionar o novo click
                    $(value).click(function () {
                        var root = this.parentNode.parentNode.parentNode.parentNode;
                        AdicionarResposta($(root).find('.respostas'), id);
                    });
                });
            }


            function configurarExcluirResposta(classe) {
                console.log("Configurar o click do botão de remover resposta");
                $.each($(classe), function (i, value) {
                    console.log(value);

                    //remover o onclick de dos botões criados anteriormente para não gerar conflito
                    $(value).attr('onclick', '').unbind('click');

                    //adicionar o novo click
                    $(value).click(function () {
                        var root = this.parentNode.parentNode.parentNode;
                        if (root.childElementCount === 2) {
                            alert('A questão deve ter ao menos duas respostas!');
                        } else {
                            if (confirm('Excluir a resposta?')) {
                                //auto remover
                                $(this.parentNode.parentNode).find('input[type=hidden]')[0].value = 'X'
                                $(this.parentNode.parentNode).hide();
                            }
                        }
                    });

                });
            }

            function configurarExcluirQuestao(classe) {
                console.log("Configurar o click do botão de remover questão");
                $.each($(classe), function (i, value) {

                    //remover o onclick de dos botões criados anteriormente para não gerar conflito
                    $(value).attr('onclick', '').unbind('click');

                    //adicionar o novo click
                    $(value).click(function () {
                        if (confirm('Excluir a Questão?')) {
                            //auto remover
                            $e =         $(this.parentNode.parentNode).closest('.questao');
                            $e.find('input[type=hidden]')[0].value = 'X'
                            $e.hide();
                        }
                    });

                });
            }

            function AdicionarResposta(div, id) {

                idResposta++;
                while ( $('#resposta-'+idResposta).size() > 0 )idResposta++;

                $.ajax({
                    url: "{{ url('/atividade-resposta') }}/" + id + "/" + idResposta,
                    success: function (result) {
                        console.log("Requisição Ajax completada com sucesso");
                        console.log("Adicionando resultado");
                        $(div).append(result);
                        configurarExcluirResposta('.resposta-excluir');
                    },
                    error: function (event) {
                        console.log("Erro na Requisição Ajax ");
                    }
                });

            }

            $('#frmAtividade').submit(function (event) {
                var erros = 0;
                var semCorreta = 0;

                //validar respostas
                $.each($('.questao'), function (i, value) {
                    //verificar se as repostas estão preenchidas
                    $.each($(value).find('textarea'), function (i, item) {
                        if (item.value.trim() === '') {
                            item.parentElement.parentNode.classList.add('has-error');
                            erros++;
                            console.log(item);
                        } else {
                            item.parentElement.parentNode.classList.remove('has-error');
                        }
                    });

                    value.classList.remove('has-error');

                    //verficar se as questões tem a respotas correta selecionada
                    if( $(value).find('input[type=radio]:checked').size() === 0 ){
                        value.classList.add('has-error');
                        semCorreta++;
                    }
                });

                if (erros > 0){
                    alert('Informe os campos em destaque');
                    return false;
                } else if  (semCorreta > 0){
                    alert('Marque a respota correta de todas as questões');
                    return false;
                }

                return true;
            });
        });

    </script>
@stop
