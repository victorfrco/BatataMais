@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Nova Categoria</h2>
            {!! form($form->add('insert', 'submit', [
            'attr' => ['class' => 'btn btn-primary btn-block'],
            'label' => 'inserir'
            ]))
            !!}
        </div>
    </div>
@endsection
