@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Informações do Cliente</h2>
            @php
                $linkEdit = route('admin.clients.edit', ['client' => $client->id]);
                $linkDelete = route('admin.clients.destroy', ['client' => $client->id]);
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
                    <td>{{$client->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$client->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Apelido</th>
                    <td>{{$client->nickname}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection