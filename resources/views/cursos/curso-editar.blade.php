@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop


@section('container')

    {{-- @include('cursos.partial.curso-tabs',array( "indice" => "curso"  )) --}}

    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="">Dados do Curso</a></li>
        </ul>
    </div>

    <section>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1>Dados do Curso </h1>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="panel-body">

                        <form id="frm-curso" class="form-horizontal" role="form" action="{{url('curso-atualizar')}}" method="post">

                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                            <input type="hidden" name="id" value=" {{$curso->id}}"/>

                            <div class="form-group">
                                <label for="titulo" class="col-sm-3 control-label">Título</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                           placeholder="Título" maxlength="200" value="{{$curso->titulo}}">
                                    <p class="help-block">Título do Curso</p>
                                    @if ($errors->has('titulo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="descricao" placeholder="Descrição"
                                              name="descricao" maxlength="200">{{$curso->descricao}}</textarea>
                                    <p class="help-block">Descrição do Curso</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="instrutor" class="col-sm-3 control-label">Instrutor</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="instrutor" name="instrutor" maxlength="200"
                                           placeholder="Instrutor" value="{{$curso->instrutor}}">
                                    <p class="help-block">Nome do Instrutor do Curso</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoria_id" class="col-sm-3 control-label">Categoria</label>
                                <div class="col-sm-9">

                                    <select class="form-control" name="categoria_id">
                                        <option disabled selected>Selecione</option>
                                        @foreach( $categorias as $cat )
                                            @if( $cat->id == $curso->categoria_id)
                                                <option selected value="{{$cat->id}}">{{$cat->descricao}}</option>
                                            @else
                                                <option value="{{$cat->id}}">{{$cat->descricao}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p class="help-block">Selecione uma Categoria para o Curso </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="palavras_chaves" class="col-sm-3 control-label">Palavras-chave</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="palavras_chaves" name="palavras_chaves"
                                           placeholder="Palavras-chave" maxlength="200" value="{{$curso->palavras_chaves}}">
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

@section('scripts')
    <script src="{{ URL::asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{ URL::asset('js/valida-curso.js')}}"></script>
@stop