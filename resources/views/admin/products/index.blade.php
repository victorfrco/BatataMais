@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Produtos</h2>
        </div>
        <div class="row">
            {!! Table::withContents($products->items()) !!}
        </div>
        {!! $products->links() !!}
        {!! Button::primary('Novo Produto')->asLinkTo(route('admin.products.create')) !!}
    </div>
@endsection