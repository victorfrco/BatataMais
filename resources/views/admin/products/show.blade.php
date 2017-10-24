@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Informações do Produto</h2>
            @php
                $linkEdit = route('admin.products.edit', ['product' => $product->id]);
                $linkDelete = route('admin.products.destroy', ['product' => $product->id]);
            @endphp
        {!! Button::primary('Editar  '.Icon::pencil())->asLinkTo($linkEdit) !!}
        {!! Button::danger('Excluir  '.Icon::remove())->asLinkTo($linkDelete)->addAttributes([
            'onClick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
        ]) !!}
            @php
                $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'url' => $linkDelete,
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]);
            @endphp
            <!-- exibe o formulário -->
            {!! form($formDelete) !!}
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$product->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$product->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$product->description}}</td>
                </tr>
                <tr>
                    <th scope="row">Preço</th>
                    <td>{{$product->price_resale}}</td>
                </tr>
                <tr>
                    <th scope="row">Preço de Custo</th>
                    <td>{{$product->price_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Quantidade em Estoque</th>
                    <td>{{$product->qtd}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection