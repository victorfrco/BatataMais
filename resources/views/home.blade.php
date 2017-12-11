@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>PÁGINA TESTE</h2>
    </div>
        <div class="row">
            <div class="col-xs-7 col-sm-6 col-lg-8" style="margin-left:-100px; border-color: #2F3133; border: groove; height: 450px;" id="tabsCategorias" data-url="<?= route('admin.categories.create') ?>">
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
            <div class="col-xs-5 col-sm-6 col-lg-5" style="border-color: #2F3133; border: groove; height: 450px; overflow: auto">
                @php
                    if(isset($order)){
                        echo '<div align="center" style="background-color:#99cb84;"> Produtos de '.$order->client->name.'</div>';
                        $tabela = App\Models\Sell::atualizaTabelaDeItens($order->id);
                        echo $tabela;
                        echo '<div style="position: absolute; bottom: 10px; width: 90%;background-color:#c9e2b3">Valor total da compra: '.$order->total.'</div>';

                    }else
                        echo '<div align="center" style="background-color:#99cb84;"> Lista de Produtos </div>';
                @endphp

            </div>
        </div>
        <div class="col-xs-5 col-sm-6 col-lg-5" style="margin-left:59%; text-align:left;">
            Valor total da compra: R$@php if(isset($order))echo number_format((float)$order->total, 2, '.', ''); else echo '0,00' @endphp <br>
            @php
                if(isset($order))
                    echo Button::success('Concluir Venda')->addAttributes(['style' => 'height:40px; width:210px', 'data-toggle' => 'modal', 'data-target' => '#concluirVendaModal']);
                else
                    echo Button::success('Concluir Venda')->addAttributes(['style' => 'height:40px; width:210px', 'disabled' => 'true']);
            @endphp
            {!! Button::danger('Cancelar Venda')->addAttributes(['style' => 'height:40px; width:210px', 'data-toggle' => 'modal', 'data-target' => '#cancelarVendaModal']) !!}

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
                    {!! Form::submit('Adicionar à venda!') !!}
                    {!! Form::close() !!}
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
                    Selecione a forma de pagamento: <br>
                    {!! Form::select('formaPagamento', ['Dinheiro', 'Cartão de Débito', 'Cartão de Crédito'])  !!}
                    @php
                        if(isset($order))
                            echo Form::hidden('order_id', $order->id);
                    @endphp
                    {!! Form::token() !!}

                </div>
                <div class="modal-footer">
                    {!! Form::submit('Concluir!') !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('js/ajax-crud.js')}}"></script>

@endsection
@section('scripts')
    <script>
        function myFunction1($id) {
            document.getElementById($id).stepUp(1);
        }
        function myFunction2($id) {
            document.getElementById($id).stepDown(1);
        }
        $('#tabsCategorias > ul> li:last').click(function (e) {
            e.preventDefault();
            window.location = $('#tabsCategorias').attr('data-url');
        });

    </script>
@endsection