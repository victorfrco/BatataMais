@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Fornecedores</h2>
        </div>
        <div class="row">
            {!! Table::withContents($providers->items())
             ->callback('Ações', function($campo, $model){
                $linkEdit = route('admin.providers.edit', ['provider' => $model->id]);
                $linkShow = route('admin.providers.show', ['provider' => $model->id]);
                $linkIncrement = route('admin.providers.show', ['provider' => $model->id]);
                 return Button::link('Editar &nbsp'.Icon::pencil())->asLinkTo($linkEdit).' | '
                    .Button::link('Ver &nbsp;'.Icon::create('eye-open'))->asLinkTo($linkShow);
             })->withAttributes([

             ]);
             !!}
        </div>
        {!! $providers->links(); !!}
        <br>
        {!! Button::primary('Novo Fornecedor')->asLinkTo(route('admin.providers.create')) !!}
    </div>
@endsection