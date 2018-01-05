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
                 return Button::link('Editar &nbsp'.Icon::pencil())->asLinkTo($linkEdit).' | '.Button::link('Ver &nbsp;'.Icon::create('eye-open'))->asLinkTo($linkShow);
             })->withAttributes([
                'style' => 'font-size: 13px'
             ]) !!}
        </div>
        {!! $brands->links()!!}
        <br>
        {!! Button::primary('Nova Marca')->asLinkTo(route('admin.brands.create')) !!}
    </div>
@endsection