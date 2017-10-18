@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Categorias</h2>
        </div>
        <div class="row">
            {!! Table::withContents($categories->items()) !!}
        </div>
        {!! $categories->links() !!}
        {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.categories.create')) !!}
    </div>
@endsection