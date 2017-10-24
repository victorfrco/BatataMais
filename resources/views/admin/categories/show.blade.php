@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Informações da Categoria</h2>
            @php
                $linkEdit = route('admin.categories.edit', ['category' => $category->id]);
                $linkDelete = route('admin.categories.destroy', ['category' => $category->id]);
            @endphp
            {!! Button::primary('Editar  '.Icon::pencil())->asLinkTo($linkEdit) !!}
            {!! Button::danger('Excluir  '.Icon::remove())->asLinkTo($linkDelete)->addAttributes([
                'onClick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
            ]) !!}
            <br><br>
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
                    <td>{{$category->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$category->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$category->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection