@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Informações do Fornecedor</h2>
            @php
                $linkEdit = route('admin.providers.edit', ['provider' => $provider->id]);
                $linkDelete = route('admin.providers.destroy', ['provider' => $provider->id]);
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
                    <td>{{$provider->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Empresa</th>
                    <td>{{$provider->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Representante</th>
                    <td>{{$provider->agent}}</td>
                </tr>
                <tr>
                    <th scope="row">Telefone 1</th>
                    <td>{{$provider->phone1}}</td>
                </tr>
                <tr>
                    <th scope="row">Telefone2</th>
                    <td>{{$provider->phone2}}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{$provider->email}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection