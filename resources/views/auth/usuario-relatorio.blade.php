<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Relatório</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">
    <link href="{{ URL::asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/relatorio-usuario.css')}} ">
</head>
<body>


<div class="container">
    <div class="row">
        <div class="text-center cabecalho">
            <h1>STV TREINAMENTOS</h1>
            <h2>Relatório de acompanhamento de usuários</h2>
        </div>
    </div>

    <div class="row">
        <div class="sumario">
            <div class="col-md-6 col-sm-6 col-xs-6 table-bordered">
                <strong>Nome:</strong> {{$nome}}
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 table-bordered">
                <strong>Data Emissão:</strong> {{$data}}
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 sub-sumario">
            <h2 class="text-center text-uppercase">Inscrições</h2>
        </div>


        @forelse($cursos as $curso)

            <div class="detalhes">
                <table class="table table-bordered ">
                    <caption>{{$curso->titulo}}</caption>
                    <thead>
                    <tr>
                        <th>Unidade</th>
                        <th>Avaliação</th>
                        <th>Nota</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($curso->notas as $nota)
                        <tr>
                            <td>{{$nota->descricao}}</td>
                            <td>{{$nota->titulo}}</td>

                            @if($nota->nota > 70)
                                <td class="nota-aprovado">{{$nota->nota}}</td>
                            @else
                                <td class="nota-reprovado">{{$nota->nota ? $nota->nota : '-' }}</td>
                            @endif
                        </tr>
                    @endforeach

                    <td colspan="2"> Porcentagem de Vídeos Assistidos:</td>

                    @if($curso->PorcetagemAssistidos >= 100)
                        <td class="nota-aprovado">{{$curso->PorcetagemAssistidos}}%</td>
                    @else
                        <td class="nota-reprovado">{{$curso->PorcetagemAssistidos}}%</td>
                    @endif

                    <tfoot>
                    <tr>
                        <td colspan="2"><strong>Aprovação</strong></td>
                        @if($curso->aprovado)
                            <td>Aprovado</td>
                        @else
                            <td>Reprovado</td>
                        @endif
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>

        @empty
            <p class="text-center">O usuário não está inscrito em nenhum curso.</p>
        @endforelse
    </div>
</div>

</body>
</html>
