@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar Marca</h2>
            {!! form($form->add('edit', 'submit', [
            'attr' => ['class' => 'btn btn-primary btn-block'],
            'label' => 'Editar'
            ]))
            !!}
        </div>
    </div>
@endsection
