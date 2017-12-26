<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Federal Hookah Pub') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<h2 align="center"> Relatório Diário - Sintético</h2>
<h4 align="center"> Data: {{$dados['data']}}</h4>
<table class="table table-striped">
    <thead>
    <tr>
        <th width="40%">Status</th>
        <th width="40%">Quantidade</th>
        <th width="20%">Valor Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Total</th>
        <td>{{$dados['totalDeVendas']}}</td>
        <td>R$ {{number_format((float)$dados['vlrTotalDeVendas'], 2, '.', '')}}</td>
    </tr>
    <tr>
        <th>Em Aberto</th>
        <td>{{$dados['totalDeVendasEmAberto']}}</td>
        <td>R$ {{number_format((float)$dados['vlrTotalDeVendasEmAberto'], 2, '.', '')}}</td>
    </tr>
    <tr>
        <th>Finalizadas</th>
        <td>{{$dados['totalDeVendasFinalizadas']}}</td>
        <td>R$ {{number_format((float)$dados['vlrTotalDeVendasFinalizadas'], 2, '.', '')}}</td>
    </tr>
    <tr>
        <th>Canceladas</th>
        <td>{{$dados['totalDeVendasCanceladas']}}</td>
        <td>R$ {{number_format((float)$dados['vlrTotalDeVendasCanceladas'], 2, '.', '')}}</td>
    </tr>
    </tbody>
</table>
<table class="table table-striped">
    <thead>
    <tr>
        <th width="40%">Forma de Pagamento</th>
        <th width="40%">Quantidade</th>
        <th width="20%">Valor Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Dinheiro</th>
        <td>{{$dados['qtdVendasDinheiro']}}</td>
        <td>R$ {{number_format((float)$dados['vlrVendasDinheiro'], 2, '.', '')}}</td>
    </tr>
    <tr>
        <th>Débito</th>
        <td>{{$dados['qtdVendasDebito']}}</td>
        <td>R$ {{number_format((float)$dados['vlrVendasDebito'], 2, '.', '')}}</td>
    </tr>
    <tr>
        <th>Crédito</th>
        <td>{{$dados['qtdVendasCredito']}}</td>
        <td>R$ {{number_format((float)$dados['vlrVendasCredito'], 2, '.', '')}}</td>
    </tr>
    </tbody>
</table>
</body>
