@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Cadastro de Usuário</h1>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label for="nome" class="col-sm-3 control-label">Nome</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nome" name="Nome" placeholder="Nome">
                                    <p class="help-block">Nome do Funcionário</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email">
                                    <p class="help-block">Email do Funcionário</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="senha" class="col-sm-3 control-label">Senha</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="senha" name="senha"
                                           placeholder="Senha">
                                    <p class="help-block">Defina uma Senha se no mínimo 6 dígitos para o
                                        funcionário </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ativo"> Ativo
                                        </label>
                                    </div>
                                    <p class="help-block">Define se o usuário estará ativo ou não</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="admin"> Administrador
                                        </label>
                                    </div>
                                    <p class="help-block">Define se o usuário é Administrador ou não</p>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-default">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
