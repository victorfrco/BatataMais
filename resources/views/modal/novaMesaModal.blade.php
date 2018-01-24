<div data-keyboard="false" data-backdrop="static" class="modal fade" id="novaMesaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title titulo" id="titulo">Nova Mesa</h4>
            </div>
            {!! Form::open(array('action' => 'SellController@criarMesa', 'method' => 'post')) !!}

            <div class="modal-body task" id="task" >
                <div class="form-group">
                    {!! Form::Label('cliente', 'Selecione um Cliente:') !!}
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="client_id">
                        {!! $clientes = App\Models\Client::all() !!}
                        @foreach($clientes as $client)
                            <option value="{{$client->id}}">{{$client->nickname}}</option>
                        @endforeach
                    </select>
                    <br>
                    {{--<p style="display:inline; vertical-align: middle;font-weight: bold">É cliente associado? </p>--}}
                    {!! Form::hidden('associated', 0) !!}
                    {{--{!! Form::checkbox('associated', 1, '',array('class'=>'checkbox-inline','style' => 'margin-top: -1px;width: 20px; height: 20px;')) !!}--}}
                </div>
            </div>
            <div class="modal-footer">
                @php
                    if(isset($order))
                        echo Form::hidden('order_id', $order->id);
                @endphp

                {!! Form::submit('Criar Mesa!', array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}
                {!! Button::primary('Novo Cliente')->asLinkTo(route('admin.clients.create')) !!}
            </div>
        </div>
    </div>
</div>