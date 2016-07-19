@extends('app')

@section('title')
    STV Treinamento em Vídeos
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
            var idQuestao = 0;

            $("#btnNovaQuestao").click(function (event) {

                idQuestao++;

                $.ajax({
                    url: "{{ url('/atividade-questao') }}/" + idQuestao,
                    success: function (result) {
                        console.log("Requisição Ajax completada com sucesso");
                        console.log("Adicionando resultado");

                        $("#questoes").append(result);

                        configurarAdicionarQuestao('.questao-adicionar', idQuestao);

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
                                $(this.parentNode.parentNode).remove();
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
                            $(this.parentNode.parentNode).closest('.questao').remove();
                        }
                    });

                });
            }

            function AdicionarResposta(div, id) {

                idResposta++;

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
                $.each($('.respostas'), function (i, value) {
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


            $("#btnNovaQuestao").click();

        })
        ;
    </script>
@stop
