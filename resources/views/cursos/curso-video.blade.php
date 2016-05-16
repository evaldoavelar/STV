@extends('app')

@section('title')
    Vídeos
@stop

@section('container')

    <section>
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Aula: Manter Banco - Curso Especificação de Casos de Uso na Prática - Parte 9</h1>
                        <p>Nesta vídeo aula, trabalharemos na especificação de requisitos para o caso de uso Manter
                            Banco.</p>

                    </div>
                    <div class="panel-body">


                        <iframe width="560"  height="315" src="https://www.youtube.com/embed/sq3ioCtQhPo" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="panel-footer">
                   <p class="destaque-sub "><span>Tags</span>: Casos de Uso, Requisitos, Especificação</p>

                    <p>  Mini-Resumo: Um caso de uso representa uma unidade discreta da interação entre um usuário (humano ou máquina) e o sistema. Um caso de uso é uma unidade de um trabalho significante. Por exemplo: o "login para o sistema", "registrar no sistema" e "criar pedidos" são todos casos de uso. Cada caso de uso tem uma descrição o qual descreve a funcionalidade que irá ser construída no sistema proposto.</p>

                </div>

                <nav>
                    <ul class="pager">
                        <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span>Vídeo Anterior</a></li>
                        <li class="next"><a href="#">Próximo Vídeo<span aria-hidden="true">&rarr;</span></a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </section>
@stop