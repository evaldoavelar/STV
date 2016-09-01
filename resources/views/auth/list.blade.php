@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container ">

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
                                <li><a href="{{url('/register')}}" class="">Novo</a></li>
                                <li><a href="" class=""></a></li>
                            </ul>
                            <form class="navbar-form navbar-left " role="search" get="{{url('/usuario-lista')}}">
                                <div class="form-group">
                                    <select class="form-control" name="campo">
                                        <option {{ isset($campo)  ? ( $campo == 'name' ? 'selected' : '') : '' }} value="name">
                                            Nome
                                        </option>
                                        <option {{ isset($campo)  ? ( $campo == 'email' ? 'selected' : '') : '' }} value="email">
                                            Email
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="valor" placeholder="Pesquisar"
                                           value="{{ isset($valor)  ? $valor : '' }}">
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
                                    <th>Administrador</th>
                                    <th>Relatório</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{$usuario->name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->ativo ? 'Sim' : 'Não'}}</td>
                                        <td>{{$usuario->admin ? 'Sim' : 'Não'}}</td>
                                        @if($usuario->admin)
                                            <td> <span
                                                    class="glyphicon glyphicon-object-align-bottom"
                                                    aria-hidden="true"></span> </td>
                                        @else
                                            <td><a href="{{url('/usuario-relatorio',$usuario->id)}}"> <span
                                                            class="glyphicon glyphicon-object-align-bottom"
                                                            aria-hidden="true"></span></a></td>
                                        @endif
                                        <td><a href="{{url('/usuario-editar',$usuario->id)}}"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                        </td>
                                        <td><a href="{{url('/usuario-excluir',$usuario->id)}}"><span
                                                        class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


        </div>
    </section>
@stop


@section('scripts')

    <script>
        $(document).ready(function () {


            $(".glyphicon-trash").click(function (event) {

                if (confirm("Deseja Excluir?") === false)
                    event.preventDefault();
            });

        });

    </script>

@stop