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
            <table class="table table-condensed">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$client->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$client->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Razão Social</th>
                    <td>{{$client->nickname}}</td>
                </tr>
                <tr>
                    <th scope="row">Telefone</th>
                    <td>{{$client->phone1}}</td>
                </tr>
                <tr>
                    <th scope="row">Celular</th>
                    <td>{{$client->phone2}}</td>
                </tr>
                <tr>
                    <th scope="row">e-Mail</th>
                    <td>{{$client->email}}</td>
                </tr>
                <tr>
                    <th scope="row">CPF</th>
                    <td>{{$client->cpf}}</td>
                </tr>
                <tr>
                    <th scope="row">CNPJ</th>
                    <td>{{$client->cnpj}}</td>
                </tr>
                <tr>
                    <th scope="row">Endereco</th>
                    <td>{{$client->adr_street.', '.$client->adr_number. ' ('.$client->adr_compl.')'. ' - '.$client->adr_neighborhood }}</td>
                </tr>
                <tr>
                    <th scope="row">CEP</th>
                    <td>{{$client->adr_cep}}</td>
                </tr>
                <tr>
                    <th scope="row">Observação</th>
                    <td>{{$client->obs}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection