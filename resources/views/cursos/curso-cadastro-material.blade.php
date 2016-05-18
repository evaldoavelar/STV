@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    @include('cursos.partial.curso-tabs',array( "indice" => "material"  ))

    <section>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1>Matérial Didático do Curso</h1>
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
                                        <input type="text" class="form-control" id="descricao" name="descricao"
                                               placeholder="Descrição">
                                        <p class="help-block">Descrição do Material</p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="arquivo" class="col-sm-3 control-label">Arquivo</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="arquivo" name="arquivo">
                                        <p class="help-block">Selecione o arquivo</p>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-default ">Salvar Material</button>
                            </form>

                        @else

                            <div class="container">

                                <p><a href="" class="btn btn-default">Novo</a> </p>
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

    <section id="video">
        <div class="container ">
            <div class="row">

            </div>
        </div>
    </section>
@stop
