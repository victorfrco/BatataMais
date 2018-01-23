@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Produtos</h2>
        </div>
        <div class="container">
            <form action="/searchProduct" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                           placeholder="Busque aqui o produto..." autofocus>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="row">
            @if(isset($products))
            {!! Table::withContents($products->items())
             ->callback('Ações', function($campo, $model){
                $linkEdit = route('admin.products.edit', ['product' => $model->id]);
                $linkShow = route('admin.products.show', ['product' => $model->id]);
                 return Button::link('Editar &nbsp'.Icon::pencil())->asLinkTo($linkEdit).'|'
                    .Button::link('Ver &nbsp;'.Icon::create('eye-open'))->asLinkTo($linkShow);
             })->withAttributes([
                'style' => 'font-size: 13px'
             ]);
             !!}
        </div>
        {!! $products->links(); !!}
            @else
                <h4>Nenhum produto encontrado!</h4>
            @endif
        <br>
        {!! Button::primary('Novo Produto')->asLinkTo(route('admin.products.create')) !!}
    </div>
@endsection