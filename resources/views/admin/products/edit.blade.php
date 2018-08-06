@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar Produto</h2>
            {!! form($form->add('edit', 'submit', [
            'attr' => ['class' => 'btn btn-primary btn-block'],
            'label' => 'Editar'
            ]))
            !!}
        </div>
    </div>
    <script>
        $('#pdiscount, #pcard, #pcost, #presale').keyup(function(){
            var v = $(this).val();
            v=v.replace(/\D/g,'');
            v=v.replace(/(\d{1,2})$/, ',$1');
            v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            v = v != ''?'R$ '+v:'';
            v=v.replace(/^0+/, '');
            $(this).val(v);
        });
    </script>
@endsection
