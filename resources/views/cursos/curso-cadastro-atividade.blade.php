@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    @include('cursos.partial.curso-tabs',array( "indice" => "atividade"  ))



    <div class="container">

        <div class="row">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h1>Atividades do Curso</h1>
                </div>
                <div class="panel-body">

                    @if( ! isset( $novo ))

                        <form class="form-horizontal" role="form" action="{{url('atividade/salvar')}}" method="post">

                            <div class="form-group">
                                <label for="titulo" class="col-sm-3 control-label">Título</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                           placeholder="Título">
                                    <p class="help-block">Título do Material</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                                <div class="col-sm-9">
                                        <textarea class="form-control" id="descricao" name="descricao"
                                                  placeholder="Descrição"></textarea>
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

                            <button type="submit" class="btn btn-default ">Salvar Atividade</button>
                        </form>

                    @else

                        <div class="container">

                            <p><a href="" class="btn btn-default">Novo</a></p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Slides de Apoio Arquivo
                                    </td>
                                    <td><span class="glyphicon glyphicon-edit"></span></td>
                                    <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                                <tr>
                                    <td>Especificações de Requisitos de Exemplo Arquivo</td>
                                    <td><span class="glyphicon glyphicon-edit"></span></td>
                                    <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                                <tr>
                                    <td>Complementar - Relacionamento Entre Casos de Uso Arquivo</td>
                                    <td><span class="glyphicon glyphicon-edit"></span></td>
                                    <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    </section>

@stop

@section('scripts')
    <script>
        $(function () {

            $("#btnNovaQuestao").click(function (event) {
                $.ajax({
                    url: "{{ url('/atividade-questao') }}",
                    success: function (result) {
                        console.log("Requisição Ajax completada com sucesso");
                        console.log("Adicionando resultado");

                        $("#questoes").append(result);

                        configurarAdicionarQuestao('.questao-adicionar');

                        configurarExcluirQuestao('.questao-excluir');

                        configurarExcluirResposta('.resposta-excluir');
                    },
                    error: function (event) {
                        console.log("Erro na Requisição Ajax ");
                    }
                });
            });

            function configurarAdicionarQuestao(classe) {
                console.log("Configurar o click do botão de adicionar resposta");
                $.each($(classe), function (i, value) {

                    //remover o onclick de dos botões criados anteriormente para não gerar conflito
                    $(value).attr('onclick', '').unbind('click');

                    //adicionar o novo click
                    $(value).click(function () {
                        var root = this.parentNode.parentNode.parentNode.parentNode;
                        AdicionarResposta($(root).find('.respostas'));
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
                        if (root.childElementCount === 1) {
                            alert('A questão deve ter ao menos uma resposta!');
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

            function AdicionarResposta(div) {

                //obter o numero de elementos
                var count = div.children().size() ;

                $.ajax({
                    url: "{{ url('/atividade-resposta') }}/"+count,
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


        })
        ;
    </script>
@stop
