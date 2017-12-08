@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>PÁGINA TESTE</h2>
    </div>
        <div class="row">
            <div class="col-sm-8" style="border-color: #2F3133; border: groove; height: 400px;" id="tabsCategorias" data-url="<?= route('admin.categories.create') ?>">
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
            <div class="col-sm-4" style="border-color: #2F3133; border: groove; height: 400px; overflow: auto">
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