@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')

    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque"><span>{{$cursos->count()}}</span> Cursos encontrados </p>
                </div>
            </div>
        </div>
    </section>

    @forelse($cursos as $i => $curso)

        <section id="cursos">
            <div class="container espaco-40">
                <div class="row-fluid">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                <h2>{{$curso->titulo}}</h2>
                            </div>

                            <div class="panel-body">
                                @if(Auth::check())
                                    @if ( $inscrito = ($curso->inscritos()->where('user_id',Auth::user()->id)->get()->count() > 0))@endif
                                @else
                                    @if ( $inscrito = false) @endif
                                @endif

                                <div class="row-fluid">
                                    <div class="row contador">
                                        <div class="col-lg-9 ">
                                            <p><span class="badge ">{{$i+1}}</span> {{$curso->descricao}}
                                            </p>
                                            <p class="pull-left"><strong>Instrutor</strong>
                                                : {{$curso->instrutor}}</p>
                                        </div>
                                        <div class="col-lg-3 avaliacao avaliacao-direita">
                                            <div class="col-md-12" title="Clique para avaliar o Curso ">
                                                <h2> Avaliação</h2>
                                                <p>
                                                    @for($j = 1; $j<=5;$j++)
                                                        @if($j <= $curso->avaliacoes())
                                                            <span class="glyphicon glyphicon-star"
                                                                  aria-hidden="true"></span>
                                                        @else
                                                            <span class="glyphicon glyphicon-star-empty"
                                                                  aria-hidden="true"></span>
                                                        @endif
                                                    @endfor
                                                </p>
                                            </div>
                                            <div class="col-md-12 ">
                                                @if(Auth::check())
                                                    @if( $inscrito )
                                                        <button class="btn btn-group-lg btn-primary" disabled>
                                                            Inscrito
                                                        </button>
                                                    @else
                                                        <button class="btn btn-group-lg btn-danger inscrever"
                                                                data-userID="{{Auth::user()->id}}"
                                                                data-cursoId="{{$curso->id}}">Inscrever
                                                        </button>
                                                    @endif
                                                @else
                                                    <a href="{{url('/login')}}"
                                                       class="btn btn-group-lg btn-primary">
                                                        Faça Login para se Inscrever
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row-fluid ">
                                            <div class="col-lg-12 ">
                                                @if( $inscrito && Auth::check())
                                                    <a class="pull-right"
                                                       href="{{url('curso-detalhes',$curso->id)}}">Acessar&nbsp;&nbsp;<span
                                                                class="glyphicon glyphicon  glyphicon-chevron-right"
                                                                aria-hidden="true"></span> </a>

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @empty

        <section>
            <div class="container ">
                <div class="row-fluid">
                    <div class="col-md-12 ">
                        <h3>Nenhum curso encontrado com esses critérios :(</h3>
                    </div>
                </div>
            </div>
        </section>
    @endforelse

@stop

<meta name="_token" content="{!! csrf_token() !!}"/>

@section('scripts')

    <script>
        $(function () {
            $('.inscrever').click(function (e) {
                var btn = $(this)[0]
                btn.disabled = true;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();


                var formData = {
                    user_id: btn.dataset.userid,
                    curso_id: btn.dataset.cursoid,
                }

                console.log(formData);

                $.ajax({

                    type: "POST",
                    url: '{{Url('inscrever-curso')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.inscrito) {
                            btn.textContent = 'Inscrito';
                            $(btn).removeClass('btn-danger');
                            $(btn).addClass('btn-primary');
                        } else {
                            btn.disabled = false;
                            alert(data.msg);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        btn.disabled = false;
                        alert('Não foi possivel realizar a inscrição');
                    }
                });
            })
        });
    </script>
@stop


