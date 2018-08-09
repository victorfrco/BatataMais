@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Últimas Bonificações</h2>
        </div>
        <div class="row">
            {!! Table::withContents($bonifications->items())
            ->withAttributes([
                'style' => 'font-size: 13px'
             ]) !!}
        </div>
        <br>
        {!! Button::primary('Nova Bonificação')->addAttributes(['data-toggle' => 'modal', 'data-target' => '#addBonificacao']) !!}
    </div>

    <div data-keyboard="false" data-backdrop="static" class="modal fade" id="addBonificacao" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titulo">Nova Bonificação</h4>
                </div>
                {!! Form::open(array('action' => 'BonificationController@store', 'method' => 'post')) !!}
                <div class="modal-body task">
                    Informe a venda:
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="order_id">';
                        @php
                        $orders = App\Http\Controllers\OrderController::vendasRecentesOriginaisPagas();
                        foreach($orders as $order){
                            $client = App\Models\Client::find($order->client_id)->nickname;
                            echo '<option value="'.$order->id.'">'.$order->id.' - '.$client.'</option>';
                        }
                        @endphp
                    </select>
                    <br><br>
                    Selecione a bonificação:
                    <select style="overflow: auto" class="selectpicker" data-live-search="true" name="product_id">
                        {!! $products = App\Models\Product::all() !!}
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->barcode}}-{{$product->name}}&ensp;&ensp;|&ensp;&ensp;{{$product->qtd}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    Informe a quantidade:
                    <input required type="numer" min="0" name="product_qtd">
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Bonificar!', array('class' => 'btn btn-success')) !!}
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
@endsection