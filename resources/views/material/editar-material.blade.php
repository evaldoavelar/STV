@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    {{-- @include('cursos.partial.curso-tabs',array( "indice" => "material"  )) --}}

    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="">Material</a></li>
        </ul>
    </div>

    <section>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                            <h1>Material Didático do Curso </h1>
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

                            <form id="frmCadastroMaterial" class="form-horizontal" enctype="multipart/form-data" role="form" action="{{url('material-atualizar')}}"  method="post">


                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                                <input type="hidden" name="id" value=" {{$material->id}}"/>
                                <input type="hidden" name="curso_id" value=" {{$material->curso_id}}"/>

                                <div class="form-group">
                                    <label for="titulo" class="col-sm-3 control-label">Título</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="titulo" name="titulo"
                                               placeholder="Título" value="{{$material->titulo}}">
                                        <p class="help-block">Título do Material</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="descricao" name="descricao"
                                               placeholder="Descrição">{{$material->descricao}}</textarea>
                                        <p class="help-block">Descrição do Material</p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="arquivo" class="col-sm-3 control-label">Arquivo</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="novoarquivo" name="novoarquivo" {{--accept="e.g: .gif, .jpg, .png, .doc, .pdf"--}}>
                                        <p class="help-block">Selecione o arquivo</p>
                                    </div>
                                </div>

                                <input type="hidden" name="arquivo" value="{{$material->arquivo}}">

                                <button type="submit" class="btn btn-default ">Salvar Material</button>
                            </form>


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
