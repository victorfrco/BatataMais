<div data-keyboard="false" data-backdrop="static" class="modal fade" id="removerAssociadoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Remover Desconto</h4>
            </div>
            {!! Form::open(array('action' => 'SellController@aplicarRemoverDesconto', 'method' => 'post')) !!}
            <div class="modal-body">
                <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja remover o desconto de associado para esta venda? </p>

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