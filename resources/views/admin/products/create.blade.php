@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <h2>Novo Produto</h2>
            <div class="col-sm-8" style="overflow: auto;">
                {!! form($form->add('insert', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => 'inserir'
            ]))
            !!}
            </div>
        </div>
    </div>
    <script>
        $('#price_discount, #price_card, #price_cost, #price_resale').keyup(function(){
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
