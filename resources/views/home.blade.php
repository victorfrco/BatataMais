@extends('layouts.app')

@section('content')
    @if (session('inexistente'))
        @php
            if(session('inexistente')->exists)
                $order = session('inexistente');
        @endphp
        <div class="alert alert-danger" style="position:fixed; width: 40%; margin-left: 30%; z-index:9999;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Ops!</strong> Produto inexistente, <a href="{{route('admin.products.create')}}" class="alert-link">clique aqui </a>caso queira adicioná-lo.
        </div>
    @endif
    @if (session('semEstoque'))
        @php
            if(session('semEstoque')->exists)
                $order = session('semEstoque');
        @endphp
        <div class="alert alert-warning" style="position:fixed; width: 60%; margin-left: 20%; z-index:9999;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Ops!</strong> Produto com estoque negativo, <a href="{{route('estoque')}}" class="alert-link">clique aqui </a>caso queira aumentar seu estoque.
        </div>
    @endif
    @if (session('vendaRealizada'))
        <div class="alert alert-success" style="position:fixed; width: 40%; margin-left: 30%; z-index:9999;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Ok!</strong> Venda realizada com sucesso!
        </div>
    @endif
    <div class="container">
        <div class="col-xs-7 col-sm-6 col-lg-7"  style="margin-left:-90px; margin-right: 130px; margin-bottom: 10px;">
            @if(App\Http\Controllers\CashController::buscaCaixaPorUsuario(\Illuminate\Support\Facades\Auth::id()) != null)
                {!! \Bootstrapper\Facades\Button::primary('Nova Venda')->withAttributes(['class'=>'botao', 'data-toggle' => 'modal', 'data-target' => '#novaMesaModal']) !!}
            @else
                {!! \Bootstrapper\Facades\Button::primary('Nova Venda')->withAttributes(['class'=>'botao', 'data-toggle' => 'modal', 'data-target' => '#novaMesaModal', 'disabled' => 'true']) !!}
                {!! \Bootstrapper\Facades\Button::primary('Abrir Caixa!')->asLinkTo(route('admin.cashes.index')) !!}
            @endif
        </div>
        <div class="row" style="text-align: right">
            {!! Form::open(array('action' => 'SellController@codBarra', 'method' => 'post', 'style' => 'display:inline')) !!}
            {!! Form::search('product_barcode',null,['placeholder' => 'Código do produto...', 'class' => 'btn', 'style' => 'text-align:left; width:300px; color: #ffffff; background-color:#000000; border-color:#edb820', 'id' => 'codBar']) !!}
            @if(isset($order))
                {!! Form::button(Icon::barcode(), ['type'=>'submit', 'class' => 'btn btn-primary']) !!}
            @else
                {!! Form::button(Icon::barcode(), ['type'=>'submit', 'class' => 'btn btn-primary', 'disabled' => 'true']) !!}
            @endif

            @isset($order)
                   {!! Form::hidden('order_id', $order->id) !!}
            @endisset
            {!! Form::close() !!}
            @if(isset($order) && !$order->associated)
                {!! Button::success(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#confirmarAssociadoModal'])  !!}
            @elseif(isset($order) && $order->associated)
                {!! Button::danger(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#removerAssociadoModal'])  !!}
            @else
                {!! Button::primary(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'disabled' => 'true'])  !!}
            @endif
            @if(isset($order) && $order->pay_method != '3')
                {!! Button::success(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#confirmarCartaoModal'])  !!}
            @elseif(isset($order) && $order->pay_method == '3')
                {!! Button::danger(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#removerCartaoModal'])  !!}
            @else
                {!! Button::primary(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'disabled' => 'true'])  !!}
            @endif
        </div>
        <div class="row">
            <div class="col-xs-7 col-sm-6 col-lg-8" style="background-color:#7a0f14; background-image:url({{asset('storage/images/brands/logo3.jpg')}}); overflow: auto; margin-left:-61px; border: solid; border-width: 1px; height: 450px;" id="tabsCategorias" data-url="<?= route('admin.categories.create') ?>">
                @php
                    foreach($categories as $category){
                        $brands = App\Models\Brand::all()->where('category_id', '=', $category->id);
                        $listadivs = [];
                        foreach ($brands as $brand){
                            $exibe = App\Models\Brand::criaLista($brand->id);

                            array_push($listadivs, $exibe);
                        }

                        $string = implode($listadivs);

                       $names[] = [
                                'title' => $category->name,
                                'content' => "<div>$string</div>"
                            ];
                            unset($listadivs);
                     }
                      $names[] = [
                         'title' => Icon::create('plus'),
                         'content' => ''
                     ];
                @endphp
                @if(isset($order))
                    {!! Tabbable::withContents($names) !!}
                @else
                    <h4>Para iniciar uma venda clique em "Nova Mesa"!</h4>
                @endif
            </div>
            <div class="col-xs-5 col-sm-6 col-lg-5" style="background-color:#7a0f14; background-image:url({{asset('storage/images/brands/logo3.jpg')}}); margin-right:-40px; border: solid; border-width: 1px; height: 450px; overflow: auto">
                @if(isset($order))
                        <div align="center" style="border-bottom: solid; border-width: 1px; border-color: #2F3133"> Produtos de {{$order->client->name}}</div>
                        {!! $tabela = App\Models\Sell::atualizaTabelaDeItens($order->id)!!}
                @else
                        <div align="center" style="border-bottom: solid; border-width: 1px; border-color: #2F3133"> Lista de Produtos </div>
                @endif

            </div>
        </div>
        <div style="margin-left:-70px">Mesas:</div>
        <div class="col-xs-7 col-sm-6 col-lg-7" style="max-height: 70px; min-width:770px; margin-left:-80px; overflow-x: auto;white-space: nowrap;">
            @php
                if(App\Http\Controllers\CashController::buscaCaixaPorUsuario(\Illuminate\Support\Facades\Auth::id()) != null){
                    $orderController = new App\Http\Controllers\OrderController();
                    echo $orderController->carregaPedidosAbertos();
                }
            @endphp
        </div>
        <div class="col-xs-5 col-sm-6 col-lg-5" style="margin-top:-20px; margin-right: -60px; text-align:left;  display: inline;">
            <p style="margin-left: 10px; margin-top: -5px">Valor total da compra: <span style="font-size: 22px;  display: inline;">R$@if(isset($order)){{number_format($order->total, 2, ',', '.')}} @else 0,00 @endif </span>
                @php
                    if(isset($order))
                        if(\App\Http\Controllers\OrderController::possuiPagamento($order))
                            echo '(Pago R$'. \App\Http\Controllers\OrderController::valorPago($order).')';
                @endphp
            </p>
            @php
                 if(isset($order)){
                    $itens = App\Models\Item::all()->where('order_id', '=', $order->id);
                    if($itens->count() > 0)
                        echo Bootstrapper\Facades\ButtonGroup::withContents([
                             Button::success('Concluir Venda')->addAttributes(['style' => 'margin-top:-18px; width:150px ', 'data-toggle' => 'modal', 'data-target' => '#concluirVendaModal']),
                             Button::primary('Parcial')->addAttributes(['style' => 'background-color :yellow; margin-top:-18px; width:130px', 'data-toggle' => 'modal', 'data-target' => '#vendaParcial']),
                             Button::danger('Cancelar Venda')->addAttributes(['style' => 'margin-top:-18px;  width:150px; ', 'data-toggle' => 'modal', 'data-target' => '#cancelarVendaModal']),
                        ])->withAttributes(['style' => 'margin-right: -20px; margin-left:25px']);
                    else
                        echo Bootstrapper\Facades\ButtonGroup::withContents([
                             Button::success('Concluir Venda')->addAttributes(['style' => 'margin-top:-18px; width:150px ', 'data-toggle' => 'modal', 'data-target' => '#concluirVendaModal', 'disabled' => 'true']),
                             Button::primary('Parcial')->addAttributes(['style' => 'background-color :yellow; margin-top:-18px; width:130px', 'data-toggle' => 'modal', 'data-target' => '#vendaParcial', 'disabled' => 'true']),
                             Button::danger('Cancelar Venda')->addAttributes(['style' => 'margin-top:-18px;  width:150px; ', 'data-toggle' => 'modal', 'data-target' => '#cancelarVendaModal']),
                        ])->withAttributes(['style' => 'margin-right: -20px; margin-left:25px']);

                }else{
                   echo Bootstrapper\Facades\ButtonGroup::withContents([
                         Button::success('Concluir Venda')->addAttributes(['style' => 'margin-top:-18px; width:150px ', 'data-toggle' => 'modal', 'data-target' => '#concluirVendaModal', 'disabled' => 'true']),
                         Button::primary('Parcial')->addAttributes(['style' => 'background-color :yellow; margin-top:-18px; width:130px', 'data-toggle' => 'modal', 'data-target' => '#vendaParcial', 'disabled' => 'true']),
                         Button::danger('Cancelar Venda')->addAttributes(['style' => 'margin-top:-18px;  width:150px; ', 'data-toggle' => 'modal', 'data-target' => '#cancelarVendaModal', 'disabled' => 'true']),
                    ])->withAttributes(['style' => 'margin-right: -20px; margin-left:25px']);
                }
            @endphp
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="productModal" tabindex="-1" >
        <div class="modal-dialog" style="width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo" id="titulo"></h4>
                </div>
                {!! Form::open(array('action' => 'SellController@addProducts', 'method' => 'post')) !!}
                <div class="modal-body task" id="task" >
                </div>
                <div class="modal-footer">
                    @php
                        if(isset($order))
                            echo Form::hidden('order_id', $order->id);
                    @endphp
                    {!! Form::submit('Adicionar à venda!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="novaMesaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo" id="titulo">Nova Mesa</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@criarMesa', 'method' => 'post')) !!}

                <div class="modal-body task" id="task" >
                    <div class="form-group">
                        {!! Form::Label('cliente', 'Selecione um Cliente:') !!}
                        <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="client_id">
                            {!! $clientes = App\Models\Client::all() !!}
                            @foreach($clientes as $client)
                                <option value="{{$client->id}}">{{$client->nickname}}</option>
                            @endforeach
                        </select>
                        <br>
                        {{--<p style="display:inline; vertical-align: middle;font-weight: bold">É cliente associado? </p>--}}
                        {!! Form::hidden('associated', 0) !!}
                        {{--{!! Form::checkbox('associated', 1, '',array('class'=>'checkbox-inline','style' => 'margin-top: -1px;width: 20px; height: 20px;')) !!}--}}
                    </div>
                </div>
                <div class="modal-footer">
                    @php
                    if(isset($order))
                        echo Form::hidden('order_id', $order->id);
                    @endphp

                    {!! Form::submit('Criar Mesa!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    {!! Button::primary('Novo Cliente')->asLinkTo(route('admin.clients.create')) !!}
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="vendaParcial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="width: 800px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Venda Parcial</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@vendaParcial', 'method' => 'post')) !!}
                <div class="modal-body">
                    @php
                    if(isset($order))
                        if(\App\Http\Controllers\OrderController::possuiPagamento($order)){
                        echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p>
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id">';
                        $users = App\User::all();
                        foreach($users as $user)
                            echo '<option value="'.$user->id.'">'.$user->name.'</option>';

                    echo '</select><br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o valor a ser pago: </p>
                    <select class="" id="formaPagamentoParcial" name="formaPagamento" style="width: 212px;" disabled="true">
                        <option value="4">Múltiplo</option>
                    </select>
                    <div id="obsParcial" style="display: block; width:500px">';
                        if(isset($order))
                            echo 'Valor total pago: <input id="valorPago" name="valorPago" type="number" max="'.$order->total.'" step="0.01">
                            <br>
                        Informe uma observação:
                        <textarea name="obsParcial" style="width:500px"></textarea>
                    </div>
                    <div id="produtosParciais">';
                    if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                            echo Form::hidden('formaPagamento', 4);
                        }else
                            echo 'Não existe pedido em aberto!';
                       }
                        else{
                        echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p>
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id">';
                        $users = App\User::all();
                        foreach($users as $user)
                            echo '<option value="'.$user->id.'">'.$user->name.'</option>';
                        echo '</select>';
                        echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione a forma de pagamento: </p>
                    <select class="" id="formaPagamentoParcial" required name="formaPagamento" style="width: 212px;" onclick="parcial()">
                        <option value="">Selecione...</option>
                        <option value="1">Dinheiro</option>
                        <option value="2">Cartão de Débito</option>
                        <option value="3">Cartão de Crédito</option>
                        <option value="4">Múltiplo</option>
                        <option value="5">Transferência/Depósito</option>
                    </select>
                    <div id="obsParcial" style="display: none; width:500px">';
                        if(isset($order))
                            echo 'Valor total pago: <input id="valorPago" name="valorPago" type="number" max="'.$order->total.'" step="0.01">
                            <br>
                        Informe uma observação:
                        <textarea name="obsParcial" style="width:500px"></textarea>
                    </div>
                    <div id="produtosParciais">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione os produtos a pagar: </p>';
                    if(isset($order)){
                            $products = App\Http\Controllers\SellController::buscaProdutosPorVenda($order);
                            echo $products;
                            echo Form::hidden('order_id', $order->id);
                        }else
                        echo 'Não existe pedido em aberto!';
                        }
                    @endphp
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Concluir!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div></div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="concluirVendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Finalizar Venda</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@concluirVenda', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p>
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id">
                        {!! $users = App\User::all() !!}
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione a forma de pagamento: </p>
                    <select class="" id="formaPagamentoTotal" required name="formaPagamento" style="width: 212px;" onclick='troco();total();'>
                        <option value="">Selecione...</option>
                        <option value="1">Dinheiro</option>
                        <option value="2">Cartão de Débito</option>
                        <option value="3">Cartão de Crédito</option>
                        <option value="4">Múltiplo</option>
                        <option value="5">Transferência/Depósito</option>
                    </select>
                    <div id="troco" style="display: none;">
                        @if(isset($order))
                            Valor da venda (R$): <input style="margin-left: 5px; width: 90px" type="text" id="num1" value="{{$order->total}}" disabled="true" />
                             |
                        @endif
                        Valor entregue: <input style="margin-left: 5px; width: 90px" type="text" id="num2" onblur="calcular();" />
                        <br>
                    </div>
                    <div id="obsTotal" style="display: none; width:500px">
                        @if(isset($order))
                        Valor total pago: <input id="valorPago" name="valorPago" type="number" value="{{$order->total}}" disabled="true" step="0.01">
                        <br>
                        @endif
                        Informe uma observação:
                        <textarea name="obs" style="width:500px"></textarea>
                    </div>
                    <div id="valorDesconto" style="display: none;">
                        Desconto(R$) <input style="width: 90px"; id="num3" name="valorDesconto" type="text" step="0.01" onblur="calcular();">
                    </div>
                    <span id="resultado" style="font-size: 22px; font-weight: bold"></span>
                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                        }
                    @endphp
                </div>
                <div class="modal-footer">
                    <p style="display: inline; margin-right: 70px">Clique <a onclick='mostraDesconto()'>AQUI</a> para aplicar desconto!</p>
                    {!! Form::submit('Concluir!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="cancelarVendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Cancelar</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@cancelarVenda', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold">  Deseja realmente cancelar a venda? </p>

                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                        }
                    @endphp
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Sim!', array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="confirmarAssociadoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Aplicar Desconto</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@aplicarRemoverDesconto', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja aplicar desconto de atacado para esta venda? </p>

                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                        }
                    @endphp
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Sim!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="removerAssociadoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Remover Desconto</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@aplicarRemoverDesconto', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja remover o desconto de atacado para esta venda? </p>

                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                        }
                    @endphp
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Sim!', array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="confirmarCartaoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Aplicar Taxa</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@aplicarRemoverCartao', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja aplicar taxa de cartão de crédito para esta venda? </p>

                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                            echo Form::hidden('aplica', 1);
                        }
                    @endphp
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Sim!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="removerCartaoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Remover Taxa</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@aplicarRemoverCartao', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja remover a taxa de cartão de crédito para esta venda? </p>

                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                            echo Form::hidden('aplica', 0);
                        }
                    @endphp
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Sim!', array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
@section('scripts')
    <script>
        setTimeout(function() {
            document.getElementById( "codBar" ).focus();
        }, 0 );
        function incrementaProduto($id) {
            document.getElementById($id).stepUp(1);
        }
        function decrementaProduto($id) {
            document.getElementById($id).stepDown(1);
        }
        $('#tabsCategorias > ul> li:last').click(function (e) {
            e.preventDefault();
            window.location = $('#tabsCategorias').attr('data-url');
        });

        function total() {
            if (document.getElementById('formaPagamentoTotal').value === '4') {
                document.getElementById('obsTotal').style.display = 'block';
            } else {
                document.getElementById('obsTotal').style.display = 'none';
            }
        }

        function troco() {
            if (document.getElementById('formaPagamentoTotal').value === '1') {
                document.getElementById('troco').style.display = 'block';
            } else {
                document.getElementById('troco').style.display = 'none';
            }
        }

        function parcial() {
            if (document.getElementById('formaPagamentoParcial').value === '4') {
                document.getElementById('obsParcial').style.display = 'block';
                document.getElementById('produtosParciais').style.display = 'none';
            } else {
                document.getElementById('obsParcial').style.display = 'none';
                document.getElementById('produtosParciais').style.display = 'block';
            }
        }

        function calcular() {
            var num1 = Number(document.getElementById("num1").value);
            var num2 = Number(document.getElementById("num2").value);
            var num3 = Number(document.getElementById("num3").value);
            var elemResult = document.getElementById("resultado");
            var sub = num2 - num1 + num3;

            if (elemResult.textContent === undefined) {
                elemResult.textContent = "Troco (R$): " + sub.toFixed(2) + "";
            }
            else { // IE
                elemResult.innerText = "Troco (R$): " + sub.toFixed(2) + "";
            }
        }
        function mostraDesconto(){
            document.getElementById('valorDesconto').style.display = 'block';
        }

    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@endsection