@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop


@section('container')


    @include('cursos.partial.curso-tabs',array( "indice" => "curso"  ))



        <section>
            <div class="container">

                <div class="row">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h1>Dados do Curso </h1>
                        </div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form">

                                <div class="form-group">
                                    <label for="titulo" class="col-sm-3 control-label">Título</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="titulo" name="titulo"
                                               placeholder="Título">
                                        <p class="help-block">Título do Curso</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="instrutor" class="col-sm-3 control-label">Instrutor</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="instrutor" name="instrutor"
                                               placeholder="Instrutor">
                                        <p class="help-block">Nome do Instrutor do Curso</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="categoria" class="col-sm-3 control-label">Categoria</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="categoria">
                                            <option disabled selected>Selecione</option>
                                            <option>Informatica</option>
                                            <option>Ketchup</option>
                                            <option>Relish</option>
                                        </select>
                                        <p class="help-block">Selecione uma Categoria para o Curso </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="palavraschave" class="col-sm-3 control-label">Palavras-chave</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="palavraschave" name="palavraschave"
                                               placeholder="Palavras-chave">
                                        <p class="help-block">Defina algumas Palavras-chaves para identificar o
                                            Curso</p>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-default ">Salvar Curso</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@stop
