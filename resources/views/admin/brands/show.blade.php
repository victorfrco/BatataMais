@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Informações da Marca</h2>
            @php
                $linkEdit = route('admin.brands.edit', ['brand' => $brand->id]);
                $linkDelete = route('admin.brands.destroy', ['brand' => $brand->id]);
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
                    <td>{{$brand->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$brand->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$brand->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection