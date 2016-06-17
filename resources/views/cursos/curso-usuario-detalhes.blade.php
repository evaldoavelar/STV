@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container jumbotron espaco-40">
            <div class="row">
                <div class="col-md-12 ">
                    <h1 class="destaque"><span>Engenharia de Software</span></h1>
                    <p class="destaque-sub"><a href="#video">11 Vídeos</a> | <a href="#atividades"> 7 Atividades  Avaliativas</a> | <a href="#material">15 Materiais Didáticos</a>
                           </p>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default avaliacao">
                        <div class="panel-body">
                            <div class="row-fluid">
                                <div class="col-lg-12">
                                    <p>Este curso abordará de forma prática e objetiva como devemos proceder para
                                        especificar
                                        requisitos através de casos de uso.</p>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="col-md-6">
                                    <div title="Clique para avaliar o Curso" >
                                        <h2> Avaliação</h2>
                                        <p>
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                                            <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                                        </p>
                                    </div>
                                    <p class="pull-left"><strong>Autor</strong> : José dos Santos</p>

                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12 espaco-10">
                                        <a class="btn btn-primary btn-half-block">Inscrever</a>
                                    </div>
                                    <div class="col-md-12 espaco-10 ">
                                        <a class="btn btn-info btn-half-block">Gerar Certificado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque"><span>Conteúdo</span> do curso </p>
                </div>
            </div>
        </div>
    </section>



    <section id="material">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Material Didático
                            </h4>

                        </div>
                        <div class="panel-body">
                            <p><a href=""><span class="glyphicon glyphicon-download"></span> Sobre a história da
                                    humanidade</a></p>
                            <p><a href=""><span class="glyphicon glyphicon-download"></span> Sobre a história da
                                    humanidade</a></p>
                            <p><a href=""><span class="glyphicon glyphicon-download"></span> Sobre a história da
                                    humanidade</a></p>
                            <p><a href=""><span class="glyphicon glyphicon-download"></span> Sobre a história da
                                    humanidade</a></p>
                            <p><a href=""><span class="glyphicon glyphicon-download"></span> Sobre a história da
                                    humanidade</a></p>
                            <p><a href=""><span class="glyphicon glyphicon-download"></span> Sobre a história da
                                    humanidade</a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="atividades">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Atividades</h4>

                        </div>

                        <div class="panel-body">
                            <div class="row-fluid">
                                <div class="col-lg-12 contador">
                                    <p><span class="badge ">1</span> Atividade 1</p>
                                    <p><a class="pull-right" href=""><span class="glyphicon glyphicon-ok"
                                                                           aria-hidden="true"></span> Concluído</a></p>
                                </div>
                                <div class="col-lg-12 contador">
                                    <p><span class="badge">2</span> Atividade 2</p>
                                    <p><a class="pull-right" href=""><span class="glyphicon glyphicon-pencil"
                                                                           aria-hidden="true"></span> Realizar Ativiade</a>
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="video">
        <div class="container espaco-40">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h4><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Vídeos</h4>

                        </div>
                        <div class="panel-body">
                            <div class="row-fluid">
                                <div class="col-lg-12 contador">
                                    <p><span class="badge ">1</span> Este curso abordará de forma prática e objetiva
                                        como devemos proceder para
                                        especificar
                                        requisitos através de casos de uso.</p>
                                    <p><a class="pull-right" href="curso-video"><span class="glyphicon glyphicon-ok"
                                                                                      aria-hidden="true"></span> Vídeo
                                            Assitido</a>
                                    </p>
                                </div>
                                <div class="col-lg-12 contador">
                                    <p><span class="badge">2</span> Este curso abordará de forma prática e objetiva como
                                        devemos proceder para</p>
                                    <p><a class="pull-right" href="curso-video"><span class="glyphicon glyphicon-ok"
                                                                                      aria-hidden="true"></span> Vídeo
                                            Assitido</a>
                                    </p>
                                </div>
                                <div class="col-lg-12 contador">
                                    <p><span class="badge ">3</span> Este curso abordará de forma prática e objetiva
                                        como devemos proceder para
                                        especificar
                                        requisitos através de casos de uso.</p>
                                    <p><a class="pull-right" href="curso-video"><span
                                                    class="glyphicon glyphicon-facetime-video"
                                                    aria-hidden="true"></span> Assitir Vídeo</a>
                                    </p>
                                </div>
                                <div class="col-lg-12 contador">
                                    <p><span class="badge">4</span> Este curso abordará de forma prática e objetiva como
                                        devemos proceder para
                                        especificar
                                        requisitos através de casos de uso.</p>
                                    <p><a class="pull-right" href="curso-video"><span
                                                    class="glyphicon glyphicon-facetime-video"
                                                    aria-hidden="true"></span> Assitir Vídeo</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
