@extends('app')

@section('title')
    Cadastro de usuários
@stop

@section('container')
    <section>
        <div class="container">

            <p><a href="{{ url('usuario-lista') }}"> <span
                            class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a></p>

            <div class="row">

                @if(isset($erro))
                    <section>
                        <div class="container ">
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="alert-link">{{ $erro  }}</a>
                            </div>
                        </div>
                    </section>
                @endif

                @if(isset($msg))
                    <section>
                        <div class="container ">
                            <div class="alert alert-info" role="alert">
                                <a href="#" class="alert-link">{{ $msg  }}</a>
                            </div>
                        </div>
                    </section>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Cadastro de Usuário</h1>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/usuario-salvar') }}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{$usuario->id}}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">Nome</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Nome" class="form-control" name="name"
                                           value="{{ $usuario->name ? $usuario->name : old('name')  }}">
                                    <p class="help-block">Nome do Funcionário</p>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-sm-3 control-label">E-Mail</label>

                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email"
                                           value="{{ $usuario->email ? $usuario->email : old('email')  }}">
                                    <p class="help-block">Email do Funcionário</p>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-sm-3  control-label">Senha</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password">
                                    <p class="help-block">Defina uma Senha se no mínimo 6 dígitos para o
                                        funcionário </p>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-sm-3 control-label">Confirmar Senha</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password_confirmation">
                                    <p class="help-block">Comfirme a senha do funcionário </p>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ativo') ? ' has-error' : '' }}">
                                <label class="col-sm-3 control-label"></label>

                                <div class="col-sm-9">
                                    <input type="checkbox" name="ativo"
                                           value="true"
                                    @if(isset($usuario))
                                        {{  $usuario->ativo ? 'checked' : ''  }}
                                            @else
                                        {{  old('ativo') ? 'checked' : ''  }}
                                            @endif
                                    >Ativo
                                    @if ($errors->has('ativo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ativo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('admin') ? ' has-error' : '' }}">
                                <label class="col-sm-3 control-label"></label>

                                <div class="col-sm-9">
                                    <input type="checkbox" name="admin"
                                           value="true"
                                    @if(isset($usuario))
                                        {{  $usuario->admin ? 'checked' : ''  }}
                                            @else
                                        {{  old('admin') ? 'checked' : ''  }}
                                            @endif
                                    >Adminstrador
                                    @if ($errors->has('admin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('admin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-user"></i>Salvar
                            </button>


                        </form>
                    </div>
                </div>

                    <p><a href="{{ url('usuario-lista') }}"> <span
                                    class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Voltar</a></p>
            </div>
        </div>
    </section>
@stop
