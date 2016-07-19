@extends('app')

@section('title')
   Nova Atividade
@stop

@section('container')


    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="">Atividades</a></li>
        </ul>
    </div>



    <div class="container">

        <div class="row">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h1>Atividades do Curso</h1>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">

                    <form id="frmAtividade" class="form-horizontal" role="form" action="{{url('atividade/salvar')}}"
                          method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="id" value="{{$atividade->id ? $atividade->id : old('id')}}"/>
                        <input type="hidden" name="unidade_id"
                               value="{{$atividade->unidade_id ? $atividade->unidade_id : old('unidade_id')}}"/>

                        <div class="form-group">
                            <label for="titulo" class="col-sm-3 control-label">Título</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Título" value="{{old('titulo')}}">
                                <p class="help-block">Título do Material</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                            <div class="col-sm-9">
                                        <textarea class="form-control" id="descricao" name="descricao"
                                                  placeholder="Descrição">{{old('descricao')}}</textarea>
                                <p class="help-block">Descrição do Material</p>
                            </div>
                        </div>

                        <div id="questoes">

                        </div>

                        <div class="form-group ">
                            <div class="col-sm-3 "></div>
                            <div class="col-sm-9">
                                <div class=" btn-group btn-group-sm " role="group" aria-label="...">
                                    <button id="btnNovaQuestao" type="button" class="btn btn-primary">Nova Questão
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="btnSalvar" class="btn btn-default ">Salvar Atividade</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    </section>

@stop

@section('scripts')
    @include('atividade.partial.atividade-script')

    <script>
        $(function () {
            //adicionar uma questão
            $("#btnNovaQuestao").click();
        });
    </script>
@stop
