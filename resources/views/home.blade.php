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
            {{Form::text('qtd',null,['placeholder' => 'Qtd', 'class' => 'btn', 'style' => 'text-align:left; width:50px; color: #ffffff; background-color:#000000; border-color:#ffcc00', 'id' => 'codBarQtd'])}}
            {!! Form::search('product_barcode',null,['placeholder' => 'Código do produto...', 'class' => 'btn', 'style' => 'text-align:left; width:250px; color: #ffffff; background-color:#000000; border-color:#ffcc00', 'id' => 'codBar']) !!}
            @if(isset($order))
                {!! Form::button(Icon::barcode(), ['type'=>'submit', 'class' => 'btn btn-primary']) !!}
            @else
                {!! Form::button(Icon::barcode(), ['type'=>'submit', 'class' => 'btn btn-primary', 'disabled' => 'true']) !!}
            @endif

            @isset($order)
                   {!! Form::hidden('order_id', $order->id) !!}
            @endisset
            {!! Form::close() !!}
            @if(isset($order))
                @if(!$order->associated)
                    @if($order->pay_method != '3')
                        {!! Button::success(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#confirmarAssociadoModal'])  !!}
                        {!! Button::success(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#confirmarCartaoModal'])  !!}
                    @elseif($order->pay_method == '3')
                        {!! Button::primary(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'disabled' => 'true'])  !!}
                        {!! Button::danger(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#removerCartaoModal'])  !!}
                    @endif
                @elseif($order->associated)
                    {!! Button::danger(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'data-toggle' => 'modal', 'data-target' => '#removerAssociadoModal'])  !!}
                    {!! Button::primary(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'disabled' => 'true'])  !!}
                @endif
            @else
                {!! Button::primary(Icon::create('link'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'disabled' => 'true'])  !!}
                {!! Button::primary(Icon::create('credit-card'))->addAttributes(['style' => 'display: inline;margin-left:30px; margin-right:-35px; height:40px;', 'disabled' => 'true'])  !!}
            @endif
        </div>
        <div class="row">
            <div class="col-xs-7 col-sm-6 col-lg-8" style="background-color:#000000; background-image:url({{asset('storage/images/brands/listaEsquerda.jpg')}}); overflow: auto; margin-left:-61px; border: solid; border-width: 1px; height: 450px;" id="tabsCategorias" data-url="<?= route('admin.categories.create') ?>">
                @php
                    foreach($categories as $category){
                        $brands = App\Models\Brand::all()->where('category_id', '=', $category->id)->where('status','=', 1);
                        $listadivs = [];
                        foreach ($brands as $brand){
                            $exibe = App\Models\Brand::criaLista($brand->id);

                            array_push($listadivs, $exibe);
                        }

                        $string = implode($listadivs);

                       $names[] = [
                                'title' => '<p style="text-align:center; font-size:12px" rel="tooltip" title="'.$category->name.' : '.$category->description.'">'.substr($category->name,0,9).'</p>',
                                'content' => "<div>$string</div>"
                            ];
                            unset($listadivs);
                     }
                      $names[] = [
                         'title' => '<p style="text-align:center; vertical-align: top; font-size:20px" rel="tooltip" title="Nova Categoria">'.Icon::create('plus').'</p>',
                         'content' => ''
                     ];
                @endphp
                @if(isset($order))
                    {!! Tabbable::withContents($names) !!}
                @else
                    <h4>Para iniciar uma venda clique em "Nova Mesa"!</h4>
                @endif
            </div>
            <div class="col-xs-5 col-sm-6 col-lg-5" style="background-color:#000000; background-image:url({{asset('storage/images/brands/listaEsquerda.jpg')}}); margin-right:-40px; border: solid; border-width: 1px; height: 450px; overflow: auto">
                @if(isset($order))
                        <div align="center" style="border-bottom: solid; border-width: 1px; border-color: #2F3133"> Produtos de {{$order->client->name}}</div>
                        {!! $tabela = App\Models\Sell::atualizaTabelaDeItens($order->id)!!}
                @else
                        <div align="center" style="border-bottom: solid; border-width: 1px; border-color: #2F3133"> Lista de Produtos </div>
                @endif

            </div>
        </div>
            <div style="margin-left:-75px">Vendas:</div>
        <div class="col-xs-7 col-sm-6 col-lg-7" style="max-height: 70px; min-width:770px; margin-left:-90px; overflow-x: auto;white-space: nowrap;">
            @php
                if(App\Http\Controllers\CashController::buscaCaixaPorUsuario(\Illuminate\Support\Facades\Auth::id()) != null){
                    $orderController = new App\Http\Controllers\OrderController();
                    echo $orderController->carregaPedidosAbertos();
                }
            @endphp
        </div>
        <div class="col-xs-5 col-sm-6 col-lg-5" style="margin-top:-20px; margin-right: -60px; text-align:left;  display: inline;">
            <p style="margin-left: 27px; margin-top: -5px">Valor total da compra: <span style="font-size: 22px; text-shadow: 1px 1px #ffcc00; color: #ffffff; display: inline;">R$@if(isset($order)){{number_format($order->total, 2, ',', '.')}} @else 0,00 @endif </span>
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
        @if(\App\Desk::all()->where('status', '=', 1)->isNotEmpty())
            <div style="margin-left:-75px">Mesas:</div>
        @endif
        <div class="col-xs-7 col-sm-6 col-lg-7" style="max-height: 70px; min-width:1280px; margin-left:-90px;overflow-x: auto;white-space: nowrap;">
            @php
                if(App\Http\Controllers\CashController::buscaCaixaPorUsuario(\Illuminate\Support\Facades\Auth::id()) != null){
                    $deskController = new App\Http\Controllers\DeskController();
                    echo $deskController->carregaMesas();
                }
            @endphp
        </div>
    </div>

    {{--vincularVendaMesa--}}
    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="vincularVendaMesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">Nova Mesa</h4>
                </div>
                {!! Form::open(array('action' => 'DeskController@vincularMesa', 'method' => 'post')) !!}
                <div class="modal-body">
                    {!! Form::Label('venda', 'Selecione uma Venda:') !!}
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="order_id">
                        {!! $vendas = App\Models\Order::all()->whereIn('status', [4,5]) !!}
                        @foreach($vendas as $venda)
                            <option value="{{$venda->id}}">{{$venda->client->nickname}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="desk_id" />
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Vincular!', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                    {!! Form::open(array('action' => 'DeskController@criarMesaVenda', 'method' => 'post')) !!}
                    <input type="hidden" name="desk_id" />
                    {!! Form::token() !!}
                    {!! Form::submit('Nova Venda!', array('class' => 'btn btn-primary','style' => 'align:left')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="excluirMesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">Excluir Mesa</h4>
                </div>
                {!! Form::open(array('action' => 'DeskController@excluirMesa', 'method' => 'post')) !!}
                <div class="modal-body">
                    <p style="text-align: center; font-weight: bold">Deseja realmente excluir essa venda?</p>
                    <input type="hidden" name="desk_id" />
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Excluir!', array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    @include('modal/confirmarAssociadoModal')
    @include('modal/removerAssociadoModal')
    @include('modal/confirmarCartaoModal')
    @include('modal/removerCartaoModal')
    @include('modal/productModal')
    @include('modal/novaMesaModal')
    @include('modal/concluirVendaModal')
    @include('modal/cancelarVendaModal')
    @include('modal/vendaParcial')

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
@section('scripts')
    <script>
        setTimeout(function() {
            document.getElementById( "codBarQtd" ).focus();
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

        $(document).ready(function(){
            $("[rel=tooltip]").tooltip({ placement: 'bottom'});
        });

        $(document).ready(function() {
            $('button.darken-2').click(function(event) {
                var sDeskId = $(this).attr('data_desk_id');
                var oModalEdit = $('#vincularVendaMesa');
                oModalEdit.find('input[name="desk_id"]').val(sDeskId);
            });

        });

        $(document).ready(function() {
            $('button.darken-2').click(function(event) {
                var sDeskId = $(this).attr('data_desk_id');
                var oModalEdit = $('#excluirMesa');
                oModalEdit.find('input[name="desk_id"]').val(sDeskId);
            });

        });
    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@endsection