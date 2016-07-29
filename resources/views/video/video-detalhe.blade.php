@extends('app')

@section('title')
    STV Treinamento em Vídeos
@stop

@section('container')


    <section>
        <div class="container ">
            <div class="row-fluid">
                <div class="col-md-12 ">
                    <p class="destaque"><span>{{$video->descricao}}</span></p>
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
                            <h4><span class="glyphicon glyphicon-facetime-video"
                                      aria-hidden="true"></span> {{$video->titulo}}</h4>

                        </div>
                        <div class="panel-body">
                            <div class="row-fluid">
                                {!! $video->url !!}
                            </div>
                        </div>
                        <div class="panel-footer">

                            @if ( $video->videosAssistidos()->where('user_id',Auth::user()->id)->count() > 0)

                            <button class="btn btn-primary " disabled
                               data-userID="{{Auth::user()->id}}"
                               data-videoId="{{$video->id}}">
                                <span class="glyphicon glyphicon-ok"
                                 aria-hidden="true"></span> Assistido</button>

                             @else
                                <button id="btn-marcar-assitido" class="btn btn-info marcar-assitido"
                                   data-userID="{{Auth::user()->id}}"
                                   data-videoId="{{$video->id}}">
                                <span class="glyphicon glyphicon-ok"
                                      aria-hidden="true"></span>  Marca Como Assistido</button>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop

<meta name="_token" content="{!! csrf_token() !!}"/>

@section('scripts')

    <script>
        $(function () {
            $('#btn-marcar-assitido').click(function (e) {
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
                    video_id: btn.dataset.videoid,
                }

                console.log(formData);

                $.ajax({

                    type: "POST",
                    url: '{{Url('marcar-assitido')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.assistido) {
                            btn.textContent = 'Assistido';
                            $(btn).removeClass('btn-info');
                            $(btn).addClass('btn-primary');
                        } else {
                            btn.disabled = false;
                            alert(data.msg);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data.responseText);
                        btn.disabled = false;
                        alert('Não foi possivel marcar como assisitido');
                    }
                });
            })
        });
    </script>
@stop
