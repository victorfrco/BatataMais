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
                return Button::link('Editar')->asLinkTo($linkEdit).' | '.Button::link('Ver')->asLinkTo($linkShow);
             })
             !!}
        </div>

        {!!$clients->links();!!}
        {!! Button::primary('Novo Cliente')->asLinkTo(route('admin.clients.create')) !!}
    </div>
@endsection