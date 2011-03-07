
<?php echo $form->create('Itens', array('url'=> array('controller'=>'shopps','action'=>'carrinho')));?>
<table cellspacing="0" class="shopp">
    <thead>
        <tr>
            <th align="center" colspan="2"><?php echo 'Cód.'.$produto['Produto']['codigo'].' - '.$produto['Produto']['descricao'].' - '.$produto['Produto']['preco'];?></th>
        </tr>
    </thead>
    <tbody>
        <tr style="height: 45px">
            <td align="right" style="font-size: 13pt">Item</td>
            <td align="left" style="font-size: 13pt">Quantidade</td>
        </tr>
        <?php
        $qtde_item = 1;
        if($produto['Preco'][0]['pacote'] == 1){
            $msgDesconto = 'Desconto de '.$produto['Preco'][0]['desconto_por_pacote'].' % para cada unidade.';
        }else if($produto['Preco'][0]['pacote'] == 1){
            $msgDesconto = 'Na soma dos itens acima, múltiplo de '.$produto['Preco'][0]['pacote'].', desconto de '.$produto['Preco'][0]['desconto_por_pacote'].' %.';
        }
        
        if(!empty($result)) {
            $qtde_item = 0;
            foreach ($result as $key => $value) {
                echo $jquery->input('id', array('name'=>"data[Item][$key][id]", 'type'=>'hidden', 'value'=>$value['Produto']['id']));
                echo $jquery->input('codigo', array('name'=>"data[Item][$key][codigo]", 'type'=>'hidden', 'value'=>$value['Produto']['codigo']));
                echo $jquery->input('codigoitem', array('name'=>"data[Item][$key][codigo_item]", 'type'=>'hidden', 'value'=>$value['Item']['codigo']));
                echo $jquery->input('qtde',array('class'=>'validateRequired validateNumeric', 'name'=>"data[Item][$key][qtde]",'label'=>$value['Item']['titulo'].' '.$html->image('/'.$value['Cor']['diretorio'],array('align'=>'center','height'=>'20px', 'width'=>'50px;', 'margin'=>'3px')),'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '<b style="font-weight: bold; color: blue;"></b></td></tr>','between' => '</td><td class="right">'));
                $qtde_item++;
            }
        }
        else {
            echo $jquery->input('id', array('name'=>"data[Item][0][id]", 'type'=>'hidden', 'value'=>$produto['Produto']['id']));
            echo $jquery->input('codigo', array('name'=>"data[Item][0][codigo]", 'type'=>'hidden', 'value'=>$produto['Produto']['codigo']));
//            echo $jquery->input('item', array('name'=>"[Item][$key]['item']", 'type'=>'hidden', 'value'=>$value['Item']['titulo']));
            echo $jquery->input('qtde',array('class'=>'validateRequired validateNumeric', 'name'=>"data[Item][0][qtde]", 'label'=>$produto['Produto']['descricao'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '<b style="font-weight: bold; color: blue;"></b></td></tr>','between' => '</td><td class="right">'));
        }
        echo $jquery->input('', array('id'=>'qtdeItem', 'type'=>'hidden', 'value'=>$qtde_item));
        ?>
    </tbody>
    <tfoot>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Adicionar ao carrinho',true),array('style'=>'font-size:11px','class'=>'formbtn btn_carrinho'));?></td></tr>
        <tr style="height: 40px"><td colspan="2" align="center" style="color: blue; font-weight: bold; font-size: 13px"><?php echo $msgDesconto;?></td></tr>
    </tfoot>


</table>
<?php echo $form->end();?>