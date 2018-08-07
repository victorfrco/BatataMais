@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <div class="container">
        <div class="row">
            <h2>Caixa Atual</h2>
        </div>
        <div class="row">
            @include('flash::message')
            @php
                if($caixa == null){
                    echo 'Não existe caixa em aberto. Por favor realize a abertura de caixa!<br><br>';
                    echo \Bootstrapper\Facades\Button::success('Abrir Caixa')->withAttributes(['data-toggle' => 'modal', 'data-target' => '#abrirCaixaModal']);
                }else{
                    echo \Bootstrapper\Facades\Button::success('Nova Entrada')->withAttributes(['data-toggle' => 'modal', 'data-target' => '#novaEntradaModal']).' ';
                    echo \Bootstrapper\Facades\Button::danger('Nova Saída')->withAttributes(['data-toggle' => 'modal', 'data-target' => '#novaSaidaModal']).'<br><br>';
                    echo \Bootstrapper\Facades\Button::normal('<img src="https://png.icons8.com/metro/50/000000/cash-register.png">   Valor de Abertura: '.$caixa->getValorAberturaFormatado())->large()->withAttributes(['disabled' => 'true', 'style'=>'width: 700px;']).'<br><br>';
                    echo \Bootstrapper\Facades\Button::INFO(\Bootstrapper\Facades\Icon::create('credit-card')->withAttributes(['style' => 'color:black; font-size:45px; vertical-align:middle']).'  Débito: '.\App\Http\Controllers\CashMovesController::buscaValoresDebito($caixa->id))->withAttributes(['data-toggle' => 'modal', 'data-target' => '#caixaDebito','style'=>'width: 230px; height:70px']).' ';
                    echo \Bootstrapper\Facades\Button::INFO(\Bootstrapper\Facades\Icon::create('credit-card')->withAttributes(['style' => 'color:black; font-size:45px; vertical-align:middle']).'  Crédito: '.\App\Http\Controllers\CashMovesController::buscaValoresCredito($caixa->id))->withAttributes(['data-toggle' => 'modal', 'data-target' => '#caixaCredito', 'style'=>'width: 230px; height:70px']).' ';
                    echo \Bootstrapper\Facades\Button::INFO('<img src="https://png.icons8.com/metro/50/000000/money.png">  Dinheiro: '.\App\Http\Controllers\CashMovesController::buscaValoresDinheiro($caixa->id))->withAttributes(['data-toggle' => 'modal', 'data-target' => '#caixaDinheiro', 'style'=>'width: 230px; height:70px']).'<br><br>';
                    echo \Bootstrapper\Facades\Button::success('Entradas: '.\App\Http\Controllers\CashMovesController::buscaValoresEntradas($caixa->id))->large()->withAttributes(['style' => 'background-color: #99ffd6; color:black; width: 350px; height:70px'])->withAttributes(['data-toggle' => 'modal', 'data-target' => '#entradas']);
                    echo \Bootstrapper\Facades\Button::danger('Saídas: '.\App\Http\Controllers\CashMovesController::buscaValoresSaidas($caixa->id))->large()->withAttributes(['style' => 'background-color: #ff8080; color:black; width: 350px; height:70px'])->withAttributes(['data-toggle' => 'modal', 'data-target' => '#saidas']).'<BR><BR>';
                    echo \Bootstrapper\Facades\Button::normal('Total: '.\App\Http\Controllers\CashMovesController::buscaValorTotal($caixa->id))->withAttributes(['style'=>'width: 700px; height:70px; color: black; font-size:40px; vertical-align:middle']).'<br><br>';
                    echo \Bootstrapper\Facades\Button::danger('Fechar Caixa')->withAttributes(['data-toggle' => 'modal', 'data-target' => '#fecharCaixaModal']);
                }
            @endphp
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="abrirCaixaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Abrir Caixa</h4>
                </div>
                {!! Form::open(array('action' => 'CashController@store', 'method' => 'post')) !!}
                <div class="modal-body">
                    <label>
                        Informe o valor atual do caixa (troco): R$
                        <input style="width: 90px" name="inicial_value" id="inicial_value">

                        <br><br>Informe a quantidade de mesas que deseja abrir:
                        <input style="width: 90px" name="desks" id="desks">
                    </label>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Abrir!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="novaEntradaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Nova Entrada</h4>
                </div>
                {!! Form::open(array('action' => 'CashController@novaEntrada', 'method' => 'post')) !!} {{-- todo alterar essa parada--}}
                <div class="modal-body">
                    <label>
                        Informe o valor da nova entrada: R$
                        <input style="width: 90px" name="novaEntradaValor" id="novaEntradaValor">
                        @php if($caixa != null)
                            echo '<input type="hidden" name="cash_id" id="cash_id" value="'.$caixa->id.'">';
                        @endphp
                    </label>
                    <br>Informe uma observação:
                    <textarea id="novaEntradaObservacao" name="novaEntradaObs" style="width:500px"></textarea>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Adicionar!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="novaSaidaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Nova Saída</h4>
                </div>
                {!! Form::open(array('action' => 'CashController@novaSaida', 'method' => 'post')) !!} {{-- todo alterar essa parada--}}
                <div class="modal-body">
                    <label>
                        Informe o valor da sangria: R$
                        <input style="width: 90px" name="novaSaidaValor" id="novaSaidaValor">
                        @php if($caixa != null)
                            echo '<input type="hidden" name="cash_id" id="cash_id" value="'.$caixa->id.'">';
                        @endphp
                    </label>
                    <br>Informe uma observação:
                    <textarea id="novaSaidaObservacao" name="novaSaidaObs" style="width:500px"></textarea>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Subtrair!', array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="caixaDebito" tabindex="-1">
        <div class="modal-dialog" style="width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Entradas de cartão de débito</h4>
                </div>
                <div class="modal-body">
                        @php
                            if($caixa != null){
                                echo \App\Http\Controllers\CashController::buscaEntradasDebito($caixa->id);
                        }
                        @endphp
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="caixaCredito" tabindex="-1">
        <div class="modal-dialog" style="width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Entradas de cartão de crédito</h4>
                </div>
                <div class="modal-body">
                    @php
                        if($caixa != null){
                            echo \App\Http\Controllers\CashController::buscaEntradasCredito($caixa->id);
                    }
                    @endphp
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="caixaDinheiro" tabindex="-1">
        <div class="modal-dialog" style="width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Entradas no dinheiro</h4>
                </div>
                <div class="modal-body">
                    @php
                        if($caixa != null){
                            echo \App\Http\Controllers\CashController::buscaEntradasDinheiro($caixa->id);
                    }
                    @endphp
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="entradas" tabindex="-1">
        <div class="modal-dialog" style="width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Entradas do Caixa</h4>
                </div>
                <div class="modal-body">
                    @php
                        if($caixa != null){
                            echo \App\Http\Controllers\CashController::buscaEntradas($caixa->id);
                    }
                    @endphp
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="saidas" tabindex="-1">
        <div class="modal-dialog" style="width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Saídas do Caixa</h4>
                </div>
                <div class="modal-body">
                    @php
                        if($caixa != null){
                            echo \App\Http\Controllers\CashController::buscaSaidas($caixa->id);
                    }
                    @endphp
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    {{--Falta inserir regra para não fechar o caixa se houver mesas/vendas em aberto--}}
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="fecharCaixaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Fechar Caixa</h4>
                </div>
                {!! Form::open(array('action' => 'CashController@fecharCaixa', 'method' => 'post')) !!}
                <div class="modal-body">
                        Deseja realmente fechar o caixa? <br>
                        @if($caixa != null)
                        O valor atual em caixa deve ser <span style="font-size: 25px">{{$caixa->getValorTotalFormatado()}}</span>.<br>
                            {{Form::hidden('cash_id', $caixa->id)}}
                        @endif
                        Valor Confere?
                        <select id="confirma" onclick="confirmar()" required>
                            <option value="">Selecione...</option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                        </select>
                        <div id="obs" style="display: none">
                            <br>
                            Informe uma observação:
                            <textarea id="observacao" name="obs" style="width:500px"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Fechar!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    <script>
        function confirmar() {
            if (document.getElementById('confirma').value === '2') {
                document.getElementById('obs').style.display = 'block';
                document.getElementById('observacao').required = true;
            } else {
                document.getElementById('obs').style.display = 'none';
                document.getElementById('observacao').required = false;
            }
        }

        $('#inicial_value, #novaEntradaValor, #novaSaidaValor').keyup(function(){
            var v = $(this).val();
            v=v.replace(/\D/g,'');
            v=v.replace(/(\d{1,2})$/, ',$1');
            v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            v = v != ''?'R$ '+v:'';
            v=v.replace(/^0+/, '');
            $(this).val(v);
        });
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
@endsection