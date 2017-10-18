@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Clientes</h2>
        </div>
        <div class="row">
            {!! Table::withContents($clients->items()) !!}
        </div>

        {!!$clients->links();!!}
        {!! Button::primary('Novo Cliente')->asLinkTo(route('admin.clients.create')) !!}
    </div>
@endsection