@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Produtos</h2>
        </div>
        <div class="row">
            {!! Table::withContents($products->items())
             ->callback('Ações', function($campo, $model){
                $linkEdit = route('admin.products.edit', ['product' => $model->id]);
                $linkShow = route('admin.products.show', ['product' => $model->id]);
                $linkIncrement = route('admin.products.show', ['product' => $model->id]);
                 return Button::link('Editar &nbsp'.Icon::pencil())->asLinkTo($linkEdit).' | '
                    .Button::link('Ver &nbsp;'.Icon::create('eye-open'))->asLinkTo($linkShow).' | '
                    .Button::link('Adicionar &nbsp;'.Icon::create('plus'))->asLinkTo($linkIncrement);
             })->withAttributes([

             ]);
             !!}
        </div>
        {!! $products->links(); !!}
        <br>
        {!! Button::primary('Novo Produto')->asLinkTo(route('admin.products.create')) !!}
    </div>
@endsection