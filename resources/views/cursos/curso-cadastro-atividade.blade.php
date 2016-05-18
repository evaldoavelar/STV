@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    @include('cursos.partial.curso-tabs',array( "indice" => "atividade"  ))

    <div>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1>Atividades do Curso</h1>
                    </div>
                    <div class="panel-body">

                        @if( ! isset( $novo ))



                            <form class="form-horizontal" role="form">

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
                                        <textarea  class="form-control" id="descricao" name="descricao"
                                               placeholder="Descrição"></textarea>
                                        <p class="help-block">Descrição do Material</p>
                                    </div>
                                </div>

                                <div id="questoes">
                                    <legend>Questões</legend>

                                    <div id="questao1" class="questao">



                                        <div class="form-group">
                                            <label for="titulo" class="col-sm-3 control-label">Enunciado</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="pergunta1" name="pergunta1"
                                                       placeholder="Enuciado da Questão"></textarea>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-1 col-sm-3"></div>
                                            <div class="col-xs-1 col-sm-1">
                                                <input type="radio" name="correta" class="pull-right" value="1">
                                            </div>
                                            <div class="col-xs-7 col-sm-7">
                                                <input type="text" class="form-control" id="resposta" name="resposta"
                                                       placeholder="Resposta">
                                            </div>
                                            <div class="col-xs-1 col-sm-1">
                                                <span class="glyphicon glyphicon-ban-circle questao-excluir"
                                                      title="Remover Opção"></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-1 col-sm-3"></div>
                                            <div class="col-xs-1 col-sm-1">
                                                <input type="radio" name="correta" class="pull-right" value="1">
                                            </div>
                                            <div class="col-xs-7 col-sm-7">
                                                <input type="text" class="form-control" id="resposta" name="resposta"
                                                       placeholder="Resposta">
                                            </div>
                                            <div class="col-xs-1 col-sm-1">
                                                <span class="glyphicon glyphicon-ban-circle questao-excluir"
                                                      title="Remover Opção"></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-1 col-sm-3"></div>
                                            <div class="col-xs-1 col-sm-1">
                                                <input type="radio" name="correta" class="pull-right" value="1">
                                            </div>
                                            <div class="col-xs-7 col-sm-7">
                                                <input type="text" class="form-control" id="resposta" name="resposta"
                                                       placeholder="Resposta">
                                            </div>
                                            <div class="col-xs-1 col-sm-1">
                                                <span class="glyphicon glyphicon-ban-circle questao-excluir"
                                                      title="Remover Opção"></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-1 col-sm-3"></div>
                                            <div class="col-xs-1 col-sm-1">
                                                <input type="radio" name="correta" class="pull-right" value="1">
                                            </div>
                                            <div class="col-xs-7 col-sm-7">
                                                <input type="text" class="form-control" id="resposta" name="resposta"
                                                       placeholder="Resposta">
                                            </div>
                                            <div class="col-xs-1 col-sm-1">
                                                <span class="glyphicon glyphicon-ban-circle questao-excluir"
                                                      title="Remover Opção"></span>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-sm-3 "></div>
                                            <div class="col-sm-9">
                                                <div class=" btn-group btn-group-xs " role="group" aria-label="...">
                                                    <button type="button" class="btn btn-success">
                                                        <span class="glyphicon  glyphicon-plus"></span>Adicionar Resposta
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <legend>Questões</legend>

                                <div class="form-group ">
                                    <div class="col-sm-3 "></div>
                                    <div class="col-sm-9">
                                        <div class=" btn-group btn-group-sm " role="group" aria-label="...">
                                            <button type="button" class="btn btn-primary">Nova Questão</button>
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
