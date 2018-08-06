<div data-keyboard="false" data-backdrop="static" class="modal fade" id="cancelarVendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Cancelar</h4>
            </div>
            {!! Form::open(array('action' => 'SellController@cancelarVenda', 'method' => 'post')) !!}
            <div class="modal-body">
                <br><p style="text-align: center; vertical-align: middle;font-weight: bold">  Deseja realmente cancelar a venda? </p>

                @php
                    if(isset($order)){
                        echo Form::hidden('order_id', $order->id);
                    }
                @endphp
                {!! Form::token() !!}
            </div>
            <div class="modal-footer">
                {!! Form::submit('Sim!', array('class' => 'btn btn-danger')) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>