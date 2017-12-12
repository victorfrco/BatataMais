@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <h2>Novo Fornecedor</h2>
            <div class="col-sm-8" style="overflow: auto;">
                {!! form($form->add('insert', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => 'inserir'
            ]))
            !!}
            </div>
        </div>
    </div>
@endsection
