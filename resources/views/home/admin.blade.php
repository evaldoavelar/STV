@extends('app')

@section('title')
    STV Treinamento em Vídeos

@stop

@section('container')

    <!-- Slides -->
    <section class="content ">
        <div class="container">
            <div class="block-header">
                <h2>ADMINISTRAÇÃO</h2>
            </div>

            <div class="row clearfix espaco-40">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <a href="{{url('curso-lista')}}">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">collections</i>
                            </div>
                            <div class="content">
                                <div class="text">CURSOS</div>
                                <div class="number count-to" data-from="0" data-to="125" data-speed="15"
                                     data-fresh-interval="20">{{$cursos}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <a href="{{url('usuario-lista')}}">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="content">
                                <div class="text">USUÁRIOS</div>
                                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000"
                                     data-fresh-interval="20">{{$usuarios}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>

@stop