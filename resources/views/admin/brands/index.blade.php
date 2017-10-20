@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listagem de Marcas</h2>
        </div>
        <div class="row">
            {!! Table::withContents($brands->items())
            ->callback('Ações', function($campo, $model){
                $linkEdit = route('admin.brands.edit', ['brand' => $model->id]);
                $linkShow = route('admin.brands.show', ['brand' => $model->id]);
                return Button::link('Editar')->asLinkTo($linkEdit).' | '.Button::link('Ver')->asLinkTo($linkShow);
             }) !!}
        </div>
        {!! $brands->links() !!}
        {!! Button::primary('Nova Marca')->asLinkTo(route('admin.brands.create')) !!}
    </div>
@endsection