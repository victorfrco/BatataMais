@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Relatório Diário</h2>
        </div>
        @php
            $users = App\User::all();
            $usuarios = [];
            foreach($users as $user){
                $usuario = '<option value="'.$user->id.'">'.$user->name.'</option>';
                array_push($usuarios, $usuario);
            }
            $end = '</select><br><br>';
            array_push($usuarios, $end);
            $usuarios = implode('',$usuarios);
            //todo

            echo Bootstrapper\Facades\Accordion::named("basic")->withContents([
         [
            'title' => 'Relatório Sintético',
             'contents' => 'Em desenvolvimento'
         ],
         [
             'title' => 'Relatório de Produtos',
             'contents' => '<h4>Produtos com código agrupados por família</h4>
                              <a href="'.action("ReportController@produtosComCodigos").'">'.\Bootstrapper\Facades\Button::primary('Gerar').'</a>',

            'style'=>''
         ],
         [
             'title' => 'Relatório Analítico',
             'contents' => '<h4>Entradas e Saídas</h4>
                        Informe a data desejada:
                              '.Form::open(array('action' => 'ReportController@generateAnaliticReport', 'method' => 'post')).''.
                          Form::date('date',null, ['required' => 'true']).'
                            <br><br>'.
                             Form::submit('Enviar', ['class' => 'btn btn-primary']).''.
                              Form::close().'',

            'style'=>''
         ],
         [
             'title' => 'Relatório de Vendas',
             'contents' => '<h4>Periódico</h4>
                        Informe a data inicial:
                              '.Form::open(array('action' => 'ReportController@generateSellReport', 'method' => 'post')).''.
                          Form::date('dateInicial',null, ['required' => 'true']).
                          '<br>Informe a data final:<br>'.
                          Form::date('dateFinal',null, ['required' => 'true']).'
                            <br><br>'.
                             Form::submit('Enviar', ['class' => 'btn btn-primary']).''.
                              Form::close().'',

            'style'=>''
         ],
         [
             'title' => 'Relatório de Vendas Por Usuário',
             'contents' => '<h4>Periódico</h4>
                        Informe a data inicial:
                              '.Form::open(array('action' => 'ReportController@generateUserReport', 'method' => 'post')).''.
                          Form::date('dateInicial',null, ['required' => 'true']).
                          '<br>Informe a data final:<br>'.
                          Form::date('dateFinal',null, ['required' => 'true']).'
                            <br>'.'
                            <br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p> <br>
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id" required>
                    '.$usuarios
                    .Form::submit('Enviar', ['class' => 'btn btn-primary']).''.
                              Form::close().'',

            'style'=>''
         ],
     ])
        @endphp
        <div class="row">

        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@endsection
