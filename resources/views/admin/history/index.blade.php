@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/searchOrderHistory" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                       placeholder="Busque a venda por id..." autofocus>
                <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row">
            @if(isset($orders))
                {!! Table::withContents($orders->items())
                 ->callback('Ações', function($campo, $model){
                    $linkEdit = route('historyDetail', ['order' => $model->id]);
                     return Button::link('Ver Detalhes &nbsp'.Icon::create('eye-open'))->asLinkTo($linkEdit);
                 })->withAttributes([
                    'style' => 'font-size: 13px'
                 ]);
                 !!}
        </div>
        {!! $orders->links(); !!}
        @else
            <h4>Nenhuma venda realizada!</h4>
        @endif
    </div>
@endsection