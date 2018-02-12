@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Categorias</h2>
        </div>
        <div class="row">
            {!! Table::withContents($categories->items())
             ->callback('Ações', function($campo, $model){
                $linkEdit = route('admin.categories.edit', ['category' => $model->id]);
                $linkShow = route('admin.categories.show', ['category' => $model->id]);
                return Button::link('Editar &nbsp'.Icon::pencil())->asLinkTo($linkEdit).' | '.Button::link('Ver &nbsp;'.Icon::create('eye-open'))->asLinkTo($linkShow);
             })->withAttributes([
                'style' => 'font-size: 13px'
             ]) !!}
        </div>
        {!! $categories->links() !!}
        <br>
        {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.categories.create')) !!}
    </div>
@endsection