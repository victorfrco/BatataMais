@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Relatório Diário</h2>
        </div>
        @php
            echo Bootstrapper\Facades\Accordion::named("basic")->withContents([
         [
            'title' => 'Relatório Sintético',
             'contents' => 'Em desenvolvimento'
         ],
         [
             'title' => 'Relatório Analítico',
             'contents' => '<h4>Entradas e Saídas</h4>
                        Informe a data desejada:
                              '.Form::open(array('action' => 'ReportController@generateAnaliticReport', 'method' => 'post')).''.
                          Form::date('date').'
                            <br><br>'.
                             Form::submit('Enviar', ['class' => 'btn btn-primary']).''.
                              Form::close().'',

            'style'=>''
         ],
     ])
        @endphp
        <div class="row">

        </div>
    </div>
@endsection