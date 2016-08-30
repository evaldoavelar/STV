<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Certificado</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">

    <style>
        body {
            font-family: 'Lato';
        }

    </style>

    <link rel="stylesheet" href="{{url('css/certificado.css')}} ">
</head>
<body >


<div class="book">
    <div class="page">
        <div class="subpage">
            <h2>A <strong>STV TREINAMENTOS</strong> confere a:</h2>
            <h1><strong>{{$nome}}</strong></h1>
            <p>O Certificado de participação no curso "{{$curso}}" realizado em  {{ $data_inscrito }}.</p>
            <p class="rodape">Belo Horizonte {{$data}}</p>
        </div>
    </div>
</div>

</body>
</html>
