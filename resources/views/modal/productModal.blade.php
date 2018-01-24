<div data-keyboard="false" data-backdrop="static" class="modal fade" id="productModal" tabindex="-1" >
    <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title titulo" id="titulo"></h4>
            </div>
            {!! Form::open(array('action' => 'SellController@addProducts', 'method' => 'post')) !!}
            <div class="modal-body task" id="task" >
            </div>
            <div class="modal-footer">
                @php
                    if(isset($order))
                    echo Form::hidden('order_id', $order->id);
                @endphp
                {!! Form::submit('Adicionar à venda!', array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/ajax-crud.js')}}"></script>