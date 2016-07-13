@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    {{-- @include('cursos.partial.curso-tabs',array( "indice" => "material"  )) --}}

    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="">Unidade</a></li>
        </ul>
    </div>

    <section>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1>Unidade do Curso </h1>
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

                        <form id="frmCadastroUnidade" class="form-horizontal" enctype="multipart/form-data" role="form"
                              action="{{url('unidade-salvar')}}" method="post">


                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="curso_id"
                                   value="{{$unidade->curso_id ? $unidade->curso_id : old('curso_id')}} "/>

                            <div class="form-group">
                                <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                                <div class="col-sm-9">
                                        <textarea class="form-control" id="descricao" name="descricao"
                                                  placeholder="Descrição">{{$unidade->descricao ? $unidade->descricao : old('descricao')}}</textarea>
                                    <p class="help-block">Descrição do Material</p>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <button type="submit" class="btn btn-default ">Salvar Unidade</button>
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

@section('scripts')
    <script src="{{ URL::asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{ URL::asset('js/valida-unidade.js')}}"></script>
@stop