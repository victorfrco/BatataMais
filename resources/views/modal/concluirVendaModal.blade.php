<div data-keyboard="false" data-backdrop="static" class="modal fade" id="concluirVendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Finalizar Venda</h4>
            </div>
            {!! Form::open(array('action' => 'SellController@concluirVenda', 'method' => 'post')) !!}
            <div class="modal-body">
                {{--<br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p>
                <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id">
                    {!! $users = App\User::all() !!}
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>--}}
                <br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione a forma de pagamento: </p>
                <select class="" id="formaPagamentoTotal" required name="formaPagamento" style="width: 212px;" onclick='troco();total();'>
                    <option value="">Selecione...</option>
                    <option value="1">Dinheiro</option>
                    <option value="2">Cartão de Débito</option>
                    <option value="3">Cartão de Crédito</option>
                    <option value="4">Múltiplo</option>
                </select>
                <div id="troco" style="display: none;">
                    @if(isset($order))
                        <table class="table">
                            <tr> <td>Valor da venda (R$): </td> <td><input style="margin-left: 5px; width: 90px" type="text" id="num1" value="{{$order->total}}" disabled="true" /></td></tr>
                    @endif
                            <tr> <td>Valor entregue: </td> <td><input style="margin-left: 5px; width: 90px" type="text" id="num2" onblur="calcular();" /></td></tr>
                        </table>
                </div>
                <div id="obsTotal" style="display: none; width:500px">
                    @if(isset($order))
                        Valor total pago: <input id="valorPago" name="valorPago" type="number" value="{{$order->total}}" disabled="true" step="0.01">
                        <br>
                    @endif
                    Informe uma observação:
                    <textarea name="obs" style="width:500px"></textarea>
                </div>
                <div id="valorDesconto" style="display: none;">
                    Desconto(R$) <input style="width: 90px" id="num3" name="valorDesconto" type="text" step="0.01" onblur="calcular();">
                </div>
                <span id="resultado" style="font-size: 22px; font-weight: bold"></span>
                @php
                    if(isset($order)){
                        echo Form::hidden('order_id', $order->id);
                    }
                @endphp
            </div>
            <div class="modal-footer">
                <p style="display: inline; margin-right: 70px">Clique <a onclick='mostraDesconto()'>AQUI </a> para aplicar desconto!</p>
                {!! Form::submit('Concluir!', array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#num2').keyup(function(){
        var v = $(this).val();
        v=v.replace(/\D/g,'');
        v=v.replace(/(\d{1,2})$/, ',$1');
        v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        v = v != ''?'R$ '+v:'';
        v=v.replace(/^0+/, '');
        $(this).val(v);
    });
    $('#num3').keyup(function(){
        var v = $(this).val();
        v=v.replace(/\D/g,'');
        v=v.replace(/(\d{1,2})$/, ',$1');
        v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        v = v != ''?'R$ '+v:'';
        v=v.replace(/^0+/, '');
        $(this).val(v);
    });
</script>