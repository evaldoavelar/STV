@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque">Listagem de <span>Usuários</span></p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="usuario-cadastro" class="">Novo</a></li>
                                    <li><a href="" class=""></a></li>
                                </ul>
                                <form class="navbar-form navbar-left " role="search">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option value="nome">Nome</option>
                                            <option value="email">Email</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Pesquisar">
                                    </div>
                                    <button type="submit" class="btn btn-default">Filtrar</button>
                                </form>

                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
            </div>

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><span class="glyphicon  glyphicon-user " aria-hidden="true"></span> Usuários
                        </h4>
                    </div>
                    <div class="">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Ativo</th>
                                <th>Relatório</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Paulo</td>
                                <td>paulo@gmail.com</td>
                                <td>Sim</td>
                                <td><span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>
                            <tr>
                                <td>Marcia</td>
                                <td>marcia@gmail.com</td>
                                <td>Sim</td>
                                <td><span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                            </tr>
                            <tr>
                                <td>Joana</td>
                                <td>Jil@gmail.com</td>
                                <td>Não</td>
                                <td><span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span></td>
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