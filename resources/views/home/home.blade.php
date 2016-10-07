@extends('app')

@section('title')
    STV Treinamento em Vídeos
    @stop

    @section('container')


            <!-- Slides -->
    <section class=" ">
        <div class="container-fluid">
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
                        <img src="images/slide1.jpg" alt="Chania">
                        <div class="carousel-caption">
                            <h3>Evolua</h3>
                            <p>Dezenas de vídeos aulas para você melhorar seu conhecimento.</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/slide2.jpg" alt="Chania">
                        <div class="carousel-caption">
                            <h3>Comunique-se</h3>
                            <p>Aprenda como se comunicar melhor com sua equipe</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/slide3.jpg" alt="Flower">
                        <div class="carousel-caption">
                            <h3>24 horas</h3>
                            <p>Faça seu treinamento em qualquer lugar a qualquer hora</p>
                        </div>
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
        <div class="container text-justify">


            <div class="panel panel-primary espaco-30">
                <div class="panel-title">
                    <h1 class="text-center">Últimos Cursos Disponíveis</h1>
                </div>
                <div class="panel-body">


                    <div class="row">

                        @foreach($cursos as $curso)
                            <div class="col-sm-6 col-md-4">
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