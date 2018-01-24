@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($order))
                @php
                    $dados = App\Http\Controllers\OrderHistoryController::exibeDetalhes($order);
                    echo '<h2> Informações sobre a venda '.$order->id.' - '. $dados['nomeCliente'] .' ('.$dados['apelidoCliente'].')'.'</h2>';
                    echo '<ul><li><u> Data de Criação:</u> '.$dados['dataDeCriacao'].'</li>';
                    echo '<li><u>Última Modificação:</u> '.$dados['ultimaAtualizacao'].'</li>';
                    echo '<li><u> Venda Realizada por:</u> '.$dados['usuarioResponsavel'].'</li>';
                    echo '<li><u> Valor total da venda:</u> R$'.number_format($dados['vlrTotal'], 2, ',', '.').'</li>';
                    echo '<li><u> Valor Desconto:</u> R$'.number_format($dados['vlrDesconto'], 2, ',', '.').'</li>';
                    echo '<li><u> Forma de Pagamento:</u> '.$dados['formaDePagamento'].'</li>';
                    echo '</ul>';

                    if($order->pay_method == 4)
                         echo '<p><u> Observação:</u> '.$order->obs.'</p>';

                    $contentOriginal = '<ul><li><u> Data :</u> '.$order->getUltimaAtualizacao().'</li>
                                <li><u> Venda Realizada por:</u> '.$order->getNomeUsuario().'</li>
                                <li><u> Valor Pago:</u> R$'.number_format((float)$order->total, 2, ',', '').'</li>
                                <li><u> Forma de Pagamento:</u> '.$order->getFormaDePagamentoFormatada($order->pay_method).'</li>
                                </ul>';
                    $itensOriginais = App\Http\Controllers\OrderController::itensFormatados($order->id);
                    $contentsOriginais = [];
                    foreach ($itensOriginais as $item){
                        $contentItensOriginais = $item[1] .' ' . $item[0]. ' - R$'.number_format($item[2], 2, ',', '.').'<br>' ;
                        array_push($contentsOriginais, $contentItensOriginais);
                    }
                    $tabelaItensOriginais = Bootstrapper\Facades\Accordion::withContents([
                        ['title' => 'Itens Pagos', 'contents' => implode('', $contentsOriginais)],
                    ]);

                    $names[] = ['title' => 'Pagamento Original',
                                'contents' => $contentOriginal.$tabelaItensOriginais
                    ];

                if($dados['possuiSubOrder']){
                    $subOrders = [];
                    $cont = 2;

                    foreach ($dados['subOrders'] as $subOrder){
                        $content = '<ul><li><u> Data :</u> '.$subOrder->getUltimaAtualizacao().'</li>
                    <li><u> Venda Realizada por:</u> '.$subOrder->getNomeUsuario().'</li>
                    <li><u> Valor Pago:</u> R$'.number_format($subOrder->total, 2, ',', '.').'</li>
                    <li><u> Forma de Pagamento:</u> '.$subOrder->getFormaDePagamento().'</li>
                    </ul>';

                    if($subOrder->pay_method == 4){
                     $content = $content.'<p><u> Observação:</u> '.$subOrder->obs.'</p>';
                    }

                    $itens = App\Http\Controllers\OrderController::itensFormatados($subOrder->id);
                    $contents = [];
                    foreach ($itens as $item){
                        $contentItens = $item[1] .' - ' . $item[0]. ' - R$'.number_format($item[2], 2, ',', '.').'<br>' ;
                        array_push($contents, $contentItens);
                    }
                    $tabelaItens = Bootstrapper\Facades\Accordion::withContents([
                        ['title' => 'Itens Pagos', 'contents' => implode('', $contents)],
                    ]);

                    $content = $content.$tabelaItens;
                       $names[] = [
                                'title' => 'Pagamento '. $cont,
                                'contents' => $content
                            ];
                       $cont++;
                    }
                }
                echo Bootstrapper\Facades\Accordion::named("basic")->withContents($names);

                if(App\Http\Controllers\OrderController::possuiBonificacao($order)){
                    echo '<h2>Bonificações</h2>';
                    $bonificacoes = App\Http\Controllers\OrderController::bonificacoes($order);
                    echo '<ul>';
                    foreach ($bonificacoes as $bonificacao){
                        echo '<li>'.$bonificacao->getValueForHeader('Qtd.').' '.$bonificacao->getValueForHeader('Item').' - '.$bonificacao->getValueForHeader('Valor Total').'</li>';
                    }
                    echo '</ul>';
                }
                @endphp
            @else
            <h4>Nenhuma venda realizada!</h4>
        @endif
    </div>
@endsection