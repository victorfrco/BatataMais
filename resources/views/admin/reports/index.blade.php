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
            'contents' => 'Informe a data desejada:
                             '.Form::open(array('action' => 'ReportController@generateReport', 'method' => 'post')).''.
                             Form::date('date').'
                             <br><br>'.
                             Form::submit('Enviar', ['class' => 'btn btn-primary']).''.
                             Form::close().'',
             'style'=>''
        ],
        [
            'title' => 'Relatório Analítico',
            'contents' => 'Em desenvolvimento'
        ],
    ])
        @endphp
        <div class="row">

        </div>
    </div>
@endsection