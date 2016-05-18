@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    @include('cursos.partial.curso-tabs',array( "indice" => "video"  ))

    <section>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1>Vídeos do Curso </h1>
                    </div>
                    <div class="panel-body">

                        @if( ! isset( $novo ))

                            <form class="form-horizontal" role="form">

                                <div class="form-group">
                                    <label for="titulo" class="col-sm-3 control-label">Título</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="titulo" name="titulo"
                                               placeholder="Título">
                                        <p class="help-block">Título do Vídeo</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="descricao" name="descricao"
                                               placeholder="Descrição">
                                        <p class="help-block">Descrição do Vídeo</p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="urlvideo" class="col-sm-3 control-label">Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="urlvideo" name="urlvideo"
                                               placeholder="URl">
                                        <p class="help-block">Informe a URL do Vídeo</p>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-default ">Salvar Vídeo</button>
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
                                        <td>Aula: Definindo as operações CRUD - Curso Completo de FireDac - Aula 7</td>
                                        <td><span class="glyphicon glyphicon-edit"></span></td>
                                        <td><span class="glyphicon glyphicon-trash"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Formulário de cadastro com FireMonkey e FireUI - Curso Completo de FireDac - Aula 8</td>
                                        <td><span class="glyphicon glyphicon-edit"></span></td>
                                        <td><span class="glyphicon glyphicon-trash"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Aula: Firedac com SQLite e Android - Curso Completo de FireDac - Aula 9</td>
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
