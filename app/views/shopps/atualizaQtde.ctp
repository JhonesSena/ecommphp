<?php if($resumo):?>
<table id="myTable" class="tablesorter" cellspacing="1">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Descrição</th>
            <th>Qtde</th>
            <th>Valor</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($resumo as $key => $item):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
        <tr<?php echo $class;?>>
            <td style="vertical-align: middle">
                    <?php echo $item['codigo']; ?>
            </td>
            <td style="vertical-align: middle">
                    <?php echo $item['descricao']; ?><br>
                <span style="color: blue;"><?php echo $item['item']; ?></span>
            </td>
            <td style="vertical-align: middle">
                    <?php echo $jquery->input('qtde',array('class'=>'validateRequired validateNumeric', 'label'=>'','id'=>'qtde'.$key, 'value'=> $item['qtde'],'style'=>'width: 30px','error' => false,'div'=>false));?>
            </td>
            <td style="vertical-align: middle">
                    <?php echo $item['preco']; ?>
            </td>
            <td style="vertical-align: middle">
                    <?php echo $item['subtotal']; ?>
            </td>
            <td style="vertical-align: middle">
                    <?php echo $html->image('/css/img/refresh.gif', array('id'=>$key, 'class'=>'akey','name'=>$item['chave_e'].'-'.$item['chave_i'],'align'=>'center','height'=>'16px', 'width'=>'16px;', 'style'=>'cursor: pointer'))?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr<?php echo $class;?>>
            <th style="vertical-align: middle" align="right" colspan="4">
                    Subtotal
            </th>
            <th style="vertical-align: middle" colspan="2">
                    <?php echo 'R$'.number_format($totalSemDesconto, 2, ',','.'); ?>
            </th>
        </tr>
        <?php if(!empty($resumoDesconto)): ?>
                <tr>
                    <th style="vertical-align: middle; font-size: 14px;" colspan="6" align="center">
                           Descontos Adquiridos
                    </th>
                </tr>
                <tr>
                    <th>Codigo</th>
                    <th>Descrição</th>
                    <th>Pacote</th>
                    <th colspan="2">Desconto</th>
                    <th>%</th>
                </tr>
                <?php
                $i = 0;
                foreach ($resumoDesconto as $key => $desconto):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>
                <tr<?php echo $class;?>>
                    <td style="vertical-align: middle">
                            <?php echo $desconto['codigo']; ?>
                    </td>
                    <td style="vertical-align: middle">
                            <?php echo $desconto['descricao']; ?>
                    </td>
                    <td style="vertical-align: middle">
                            <?php echo $desconto['qtde_pacote']; ?>
                    </td>
                    <td style="vertical-align: middle" colspan="2">
                            <?php echo $desconto['desconto']; ?>
                    </td>
                    <td style="vertical-align: middle">
                            <?php echo $desconto['percentual']; ?>
                    </td>
                </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if($descontoTotal > 0): ?>
            <tr>
                <th align="right" colspan="4" style="font-size: 14px">Total Desconto</th>
                <th align="left" colspan="3" style="font-size: 14px">R$ <?php echo number_format($descontoTotal, 2, ',', '.');?></th>
            </tr>
        <?php endif; ?>
        <tr>
            <th align="right" colspan="4" style="font-size: 14px">Total em produto</th>
            <th align="left" colspan="3" style="font-size: 14px">R$ <?php echo $totalProduto;?></th>
        </tr>
        <!--tr>
            <th align="right" colspan="4" style="font-size: 14px">Valor Frete</th>
            <th align="left" colspan="3" style="font-size: 14px">R$ <?php //echo $frete;?></th>
        </tr-->
        <tr>
            <th align="right" colspan="4" style="font-size: 14px">Total</th>
            <th align="left" colspan="3" style="font-size: 14px; color: blue;">R$ <?php echo $total;?></th>
        </tr>
    </tfoot>
</table>
<?php 
//    if($errosFrete['codigo']!=0){
//        echo "<span style='color: red'>Ocorreu um erro ao tentar calcular frete. ".$errosFrete['descricao']."</span>";
//    }
?>
<?php endif; ?>