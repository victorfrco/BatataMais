@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Clientes</h2>
        </div>
        <div class="row">
            {!! Table::withContents($clients->items())
             ->callback('Ações', function($campo, $model){
                $linkEdit = route('admin.clients.edit', ['client' => $model->id]);
                $linkShow = route('admin.clients.show', ['client' => $model->id]);
                 return Button::link('Editar &nbsp'.Icon::pencil())->asLinkTo($linkEdit).' | '
                 .Button::link('Ver &nbsp;'.Icon::create('eye-open'))->asLinkTo($linkShow);
             })->withAttributes([
                'style' => 'font-size: 13px'
             ])
             !!}
        </div>

        {!!$clients->links();!!}
        <br>
        {!! Button::primary('Novo Cliente')->asLinkTo(route('admin.clients.create')) !!}
    </div>
@endsection