 @extends('app')

@section('title')
   Novo Vídeo
@stop

@section('container')

    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="">Vídeo</a></li>
        </ul>
    </div>

    <section>
        <div class="container">

            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1>Vídeos do Curso </h1>
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


                        <form id="frmCadastroVideo" class="form-horizontal" enctype="multipart/form-data" role="form"
                              action="{{url('video-atualizar')}}" method="post">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="id" value="{{$video->id ? $video->id : old('id')}} "/>
                            <input type="hidden" name="unidade_id" value="{{$video->unidade_id ? $video->unidade_id : old('unidade_id')}} "/>

                            <div class="form-group">
                                <label for="titulo" class="col-sm-3 control-label">Título</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                           placeholder="Título"
                                           value="{{$video->titulo ? $video->titulo : old('titulo')}} ">
                                    <p class="help-block">Título do Vídeo</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                                <div class="col-sm-9">
                                        <textarea class="form-control" id="descricao" name="descricao"
                                                  placeholder="Descrição">{{$video->descricao ? $video->descricao : old('descricao')}} </textarea>
                                    <p class="help-block">Descrição do Material</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="urlvideo" class="col-sm-3 control-label">Url</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="url" name="url"
                                           placeholder="URl" value="{{$video->url ? $video->url : old('url')}} ">
                                    <p class="help-block">Informe a URL do Vídeo</p>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-default ">Salvar Vídeo</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@stop



@section('scripts')
    <script src="{{ URL::asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{ URL::asset('js/valida-video.js')}}"></script>
@stop