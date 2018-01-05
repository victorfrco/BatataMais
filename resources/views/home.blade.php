@extends('layouts.app')

@section('content')
    @if (session('inexistente'))
        @php
            $order = session('inexistente');
        @endphp
        <div class="alert alert-danger" style="position:fixed; width: 40%; margin-left: 30%; z-index:9999;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Ops!</strong> Produto inexistente, <a href="{{route('admin.products.create')}}" class="alert-link">clique aqui </a>caso queira adicioná-lo.
        </div>
    @endif
    @if (session('semEstoque'))
        @php
            $order = session('semEstoque');
        @endphp
        <div class="alert alert-warning" style="position:fixed; width: 60%; margin-left: 20%; z-index:9999;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Ops!</strong> Produto com estoque negativo, <a href="{{route('estoque')}}" class="alert-link">clique aqui </a>caso queira aumentar seu estoque.
        </div>
    @endif
    <div class="container">
        <div class="col-xs-7 col-sm-6 col-lg-7"  style="margin-left:-90px; margin-right: 130px; margin-bottom: 10px;">
            {!! \Bootstrapper\Facades\Button::primary('Nova Mesa')->withAttributes(['data-toggle' => 'modal', 'data-target' => '#novaMesaModal']) !!}
        </div>
        <div class="row" style="text-align: right">
            {!! Form::open(array('action' => 'SellController@codBarra', 'method' => 'post', 'style' => 'display:inline')) !!}
            {!! Form::search('product_barcode',null,['placeholder' => 'Código do produto...', 'class' => 'btn', 'style' => 'text-align:left; width:300px; color: #ffffff; background-color:#000000; border:thik; border-color:#C8B90C', 'id' => 'codBar']) !!}
            {!! Form::button(Icon::barcode(), ['type'=>'submit', 'class' => 'btn btn-primary']) !!}
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
        </div>
        <div class="row">
            <div class="col-xs-7 col-sm-6 col-lg-8" style="background: -webkit-gradient(linear, left top, left bottom, from(#000000), to(#515151)); overflow: auto; margin-left:-61px; border: solid; border-width: 1px; height: 450px;" id="tabsCategorias" data-url="<?= route('admin.categories.create') ?>">
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
                {!! Tabbable::withContents($names) !!}
            </div>
            <div class="col-xs-5 col-sm-6 col-lg-5" style="background: -webkit-gradient(linear, left top, left bottom, from(#000000), to(#515151)); margin-right:-40px; border: solid; border-width: 1px; height: 450px; overflow: auto">
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
                $orderController = new App\Http\Controllers\OrderController();
                echo $orderController->carregaPedidosAbertos();
            @endphp
        </div>
        <div class="col-xs-5 col-sm-6 col-lg-5" style="margin-top:-20px; margin-right: -60px; text-align:left;  display: inline;">
            <p style="margin-left: 10px; margin-top: -5px">Valor total da compra: <span style="font-size: 22px;  display: inline;">R$@if(isset($order)){{number_format((float)$order->total, 2, '.', '')}} @else 0,00 @endif </span></p>
            @php
                if(isset($order)){
                    echo Button::success('Concluir Venda')->addAttributes(['style' => 'margin-top:-18px; margin-left:25px;height:40px; width:210px', 'data-toggle' => 'modal', 'data-target' => '#concluirVendaModal']);
                    echo Button::danger('Cancelar Venda')->addAttributes(['style' => 'margin-top:-18px; margin-right:-25px;margin-left:25px; height:40px; width:210px', 'data-toggle' => 'modal', 'data-target' => '#cancelarVendaModal']);

                }else{
                    echo Button::success('Concluir Venda')->addAttributes(['style' => 'margin-top:-18px; margin-left:25px; height:40px; width:210px', 'disabled' => 'true']);
                    echo Button::danger('Cancelar Venda')->addAttributes(['style' => 'margin-top:-18px; margin-right:-25px;margin-left:25px; height:40px; width:210px', 'disabled' => 'true']);
                }
            @endphp
        </div>
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog">
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

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="concluirVendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Finalizar Venda</h4>
                </div>
                {!! Form::open(array('action' => 'SellController@concluirVenda', 'method' => 'post')) !!}
                <div class="modal-body">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione a forma de pagamento: </p>
                    {!! Form::select('formaPagamento', ['Dinheiro', 'Cartão de Débito', 'Cartão de Crédito'], null, ['class' => 'selectpicker'])  !!}

                    @php
                        if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                        }
                    @endphp
                    {!! Form::token() !!}
                </div>
                <div class="modal-footer">
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
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja aplicar desconto de associado para esta venda? </p>

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
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja remover o desconto de associado para esta venda? </p>

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

    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@endsection