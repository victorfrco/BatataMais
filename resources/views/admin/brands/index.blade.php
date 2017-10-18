@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Marcas</h2>
        </div>
        <div class="row">
            {!! Table::withContents($brands->items()) !!}
        </div>
        {!! $brands->links() !!}
        {!! Button::primary('Nova Marca')->asLinkTo(route('admin.brands.create')) !!}
    </div>
@endsection