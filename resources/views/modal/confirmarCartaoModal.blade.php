<div data-keyboard="false" data-backdrop="static" class="modal fade" id="confirmarCartaoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: #2F3133">{!!\Bootstrapper\Facades\Icon::create('warning-sign')->withAttributes(['class' => 'btn-lg'])!!}&ensp;&ensp;  Aplicar Taxa</h4>
            </div>
            {!! Form::open(array('action' => 'SellController@aplicarRemoverCartao', 'method' => 'post')) !!}
            <div class="modal-body">
                <br><p style="display:inline; vertical-align: middle;font-weight: bold; color: #2F3133">  Deseja aplicar taxa de cartão de crédito para esta venda? </p>

                @php
                    if(isset($order)){
                        echo Form::hidden('order_id', $order->id);
                        echo Form::hidden('aplica', 1);
                    }
                @endphp
                {!! Form::token() !!}
            </div>
            <div class="modal-footer">
                {!! Form::submit('Sim!', array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>