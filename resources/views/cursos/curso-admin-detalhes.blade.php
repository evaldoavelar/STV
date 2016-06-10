@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')



    <section>
        <div class="container espaco-40">
            <div class="row">
                <div class="col-md-12 ">
                    <p class="destaque">Detalhes  Curso <span>Engenharia de Software</span></p>
                    <p class="destaque-sub">Introdução a Engenharia de Software - Caio Ribeiro</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container ">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="usuario-cadastro" class="">Novo Curso</a></li>
                                <li><a href="" class="">Editar</a></li>
                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </section>



    <section id="material">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Material Didático
                            </h4>
                            < <p><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a></p>

                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Sobre a história da
                                    humanidade</td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="atividades">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Atividades</h4>
                            <p><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a></p>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Atividade 1</td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>
                            <tr>
                                <td>Atividade 2</td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="video">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Vídeos</h4>
                            <p><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a></p>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> Este curso abordará de forma prática e objetiva
                                    como devemos proceder para
                                    especificar
                                    requisitos através de casos de uso.</td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Este curso abordará de forma prática e objetiva
                                        como devemos proceder para
                                        especificar
                                        requisitos através de casos de uso</td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
