@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($success))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $success }}
            </div>
        @endif
        <div class="row">
            <h2>Estoque</h2>
        </div>
        <div class="row" style="float: left;">
            {!! Form::open(array('action' => 'ProductController@addStock', 'method' => 'post')) !!}
            <div class="form-group">
                {!! Form::Label('product_name', 'Selecione o produto que deseja adicionar:') !!}
                <br>
                <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true"
                        name="product_id">
                    {!! $products = App\Models\Product::all() !!}
                    @foreach($products as $product)
                        <option value="{{$product->id}}">
                            {{$product->barcode}} - {{$product->name}}&ensp;&ensp;|&ensp;&ensp;{{$product->qtd}}</option>
                    @endforeach
                </select>

                <br><br>
                {!! Form::label('product_qtd', 'Informe a quantidade:') !!}
                <br>
                {!! Form::number('product_qtd') !!}
            </div>
            {!! Form::submit('Adicionar!', array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
        </div>
        <div class="row" style="float: right;">
            {!! Form::open(array('action' => 'ProductController@decreaseStock', 'method' => 'post')) !!}
            <div class="form-group">
                {!! Form::Label('product_name', 'Selecione o produto que deseja remover:') !!}
                <br>
                <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true"
                        name="product_id">
                    {!! $products = App\Models\Product::all() !!}
                    @foreach($products as $product)
                        <option value="{{$product->id}}">
                            {{$product->barcode}} - {{$product->name}}&ensp;&ensp;|&ensp;&ensp;{{$product->qtd}}</option>
                    @endforeach
                </select>

                <br><br>
                {!! Form::label('product_qtd', 'Informe a quantidade:') !!}
                <br>
                {!! Form::number('product_qtd') !!}
            </div>
            {!! Form::submit('Remover!', array('class' => 'btn btn-danger')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
@endsection