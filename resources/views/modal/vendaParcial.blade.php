<div data-keyboard="false" data-backdrop="static" class="modal fade" id="vendaParcial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width: 800px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Venda Parcial</h4>
            </div>
            {!! Form::open(array('action' => 'SellController@vendaParcial', 'method' => 'post')) !!}
            <div class="modal-body">
                @php
                    if(isset($order))
                        if(\App\Http\Controllers\OrderController::possuiPagamento($order)){
                        /*echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p>
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id">';
                        $users = App\User::all();
                        foreach($users as $user)
                            echo '<option value="'.$user->id.'">'.$user->name.'</option>';
                    echo '</select>';*/
                    echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o valor a ser pago: </p>
                    <select class="" id="formaPagamentoParcial" name="formaPagamento" style="width: 212px;" disabled="true">
                        <option value="4">Múltiplo</option>
                    </select>
                    <div id="obsParcial" style="display: block; width:500px">';
                        if(isset($order))
                            echo '<table class="table">
                            <tr>
                                <td>Valor Dinheiro: </td>
                                <td><input style="width:120px" id="dinheiro" name="dinheiro" type="text" max="'.$order->total.'"  ></td>
                            </tr>
                            <tr>
                                <td>Valor Débito: </td>
                                <td><input style="width:120px" id="debito" name="debito" type="text" max="'.$order->total.'"  ></td>
                            </tr>
                            <tr>
                                <td>Valor Crédito: </td>
                                <td><input style="width:120px" id="credito" name="credito" type="text" max="'.$order->total.'"  ></td>
                            </tr>
                            </table>

                    <div id="produtosParciais">';
                    if(isset($order)){
                            echo Form::hidden('order_id', $order->id);
                            echo Form::hidden('formaPagamento', 4);
                        }else
                            echo 'Não existe pedido em aberto!';
                       }
                        else{
                        /*echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Informe o vendedor: </p>
                    <select style="max-height: 50px; overflow: auto" class="selectpicker" data-live-search="true" name="user_id">';
                        $users = App\User::all();
                        foreach($users as $user)
                            echo '<option value="'.$user->id.'">'.$user->name.'</option>';
                        echo '</select>';*/
                        echo '<br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione a forma de pagamento: </p>
                    <select class="" id="formaPagamentoParcial" required name="formaPagamento" style="width: 212px;" onclick="parcial()">
                        <option value="">Selecione...</option>
                        <option value="1">Dinheiro</option>
                        <option value="2">Cartão de Débito</option>
                        <option value="3">Cartão de Crédito</option>
                        <option value="4">Múltiplo</option>
                    </select>
                    <div id="obsParcial" style="display: none; width:400px">';
                        if(isset($order))
                            echo '
                            <table class="table">
                            <tr>
                                <td>Valor Dinheiro: </td>
                                <td><input style="width:120px" id="dinheiro" name="dinheiro" type="text" max="'.$order->total.'"  ></td>
                            </tr>
                            <tr>
                                <td>Valor Débito: </td>
                                <td><input style="width:120px" id="debito" name="debito" type="text" max="'.$order->total.'"  ></td>
                            </tr>
                            <tr>
                                <td>Valor Crédito: </td>
                                <td><input style="width:120px" id="credito" name="credito" type="text" max="'.$order->total.'"  ></td>
                            </tr>
                            </table>
                    </div>
                    <div id="produtosParciais">
                    <br><p style="display:inline; vertical-align: middle;font-weight: bold">Selecione os produtos a pagar: </p>';
                    if(isset($order)){
                            $products = App\Http\Controllers\SellController::buscaProdutosPorVenda($order);
                            echo $products;
                            echo Form::hidden('order_id', $order->id);
                        }else
                        echo 'Não existe pedido em aberto!';
                        }
                @endphp
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit('Concluir!', array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
<script>
    $('#debito, #credito, #dinheiro').keyup(function(){
        var v = $(this).val();
        v=v.replace(/\D/g,'');
        v=v.replace(/(\d{1,2})$/, ',$1');
        v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        v = v != ''?'R$ '+v:'';
        v=v.replace(/^0+/, '');
        $(this).val(v);
    });
</script>