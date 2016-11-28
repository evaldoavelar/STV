@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')


    <!-- Slides -->
    <section class=" ">
        <div class="container">
            <div id="slides" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#slides" data-slide-to="0" class="active"></li>
                    <li data-target="#slides" data-slide-to="1"></li>
                    <li data-target="#slides" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <a href="{{url('cursos-por-categoria',5)}}">
                            <img src="images/slide1.jpg" alt="Chania">
                            <div class="carousel-caption">
                                <h3>Inglês</h3>
                                <p>Dezenas de vídeos aulas para você melhorar seu conhecimento em outro Idioma.</p>
                            </div>
                        </a>
                    </div>


                    <div class="item">
                        <a href="{{url('cursos-por-categoria',2)}}">
                            <img src="images/slide2.jpg" alt="Chania">
                            <div class="carousel-caption">
                                <h3>Melhore sua escrita</h3>
                                <p>Aprenda como se comunicar melhor com sua equipe</p>
                            </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="{{url('cursos-por-categoria',4)}}">
                            <img src="images/slide3.jpg" alt="Flower">
                            <div class="carousel-caption">
                                <h3>O futuro está na computação</h3>
                                <p>Melhore o seu conhecimento em dezenas de softwares</p>
                            </div>
                        </a>
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#slides" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="right carousel-control" href="#slides" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Ultimos Cursos -->
    <section>
        <div class="container text-justify espaco-40">


            <div class="panel panel-primary espaco-30">
                <div class="panel-title">
                    <h1 class="text-center">Últimos Cursos Disponíveis</h1>
                </div>
                <div class="panel-body">


                    <div class="row">

                        @foreach($cursos as $curso)
                            <div class="col-sm-6 col-md-4">
                                <a href="{{url("curso-detalhes",$curso->id)}}">
                                    <div class="thumbnail">
                                        <img class="img-thumbnail" src="images/curso1.jpg" alt="...">
                                        <div class="caption">
                                            <h3>{{$curso->titulo}}</h3>
                                            <p class="thumbnail-p"> {{ $curso->descricao  }}</p>
                                            <p>
                                                <span class="badge "> {{$curso->inscritos()->count()}} Inscritos</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    <div class="row">

                    </div>

                </div>

            </div>

        </div>
    </section>

@stop