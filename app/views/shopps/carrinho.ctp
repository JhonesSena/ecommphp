
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
        ouvinte();


    });
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //$(".tablesorter").tablesorter(); //criar ordenação no grid
    });
</script>

<script>
    function selecionados(){
        chs = $(".chk").get();
        saida = "";
        for(i=0;i<chs.length;i++){
            saida = chs[i].checked?saida+","+chs[i].value:saida;
        }
        return saida.substring(1,saida.length);
    }
    function selecionarTodos(){
        chs = $(".chk").get();
        saida = "";
        for(i=0;i<chs.length;i++){
            if(chs[i].checked){
                chs[i].checked=false;
            }else{
                chs[i].checked=true;
            }
        }
    }

    function ouvinte(){
        $(".akey").click(function(){
            atualizaQtde($(this).attr('name'), $("#qtde"+$(this).attr('id')).attr('value'));
        });
    }

    function atualizaQtde(chave, valor){
        $.ajax({
            type: 'get',
            async:false,
            url: '<?php echo $this->webroot;?>ajax/atualizaItemCarrinho/'+chave+'/'+valor,
            beforeSend: function(){
                $('#dialog').html("<div style='text-align:center;' ><img src='<?php echo $this->webroot;?>img/ajax_preloader.gif'/></div>");
                $('#dialog').dialog('open');
            },
            complete: function(){
                $('#dialog').dialog('close');
            },
            error: function(){
                location.href="";
            },
            success: function(msg){
                if(msg != ''){
                    $('#dialog').dialog('close');
                    $("#tab1").html(msg);
                    ouvinte();
                }

            }
        });
    }

    function gerarRelatorio(conteudo)
    {
        var webroot = "<?php echo $this->webroot ?>";
        var width = 900;
        var height = 1000;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var valor = "<center><button id='imprimir' onclick='javascript:imprimir()' class='linkbutton linkbtn btn_imprimir'>Imprimir</button></center>";
        var script = '<script src="'+webroot+'js/jquery.ui/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></scr'+'ipt>';
        script = script+'<script src="'+webroot+'js/jquery-1.3.2.min.js" type="text/javascript"></scr'+'ipt>';
        var css = '<link rel="stylesheet" href="'+webroot+'css/defaultPrint.css" type="text/css"/>';
        css = css + '<link rel="stylesheet" href="'+webroot+'css/default.css" type="text/css"/>';
        css = css + '<link rel="stylesheet" href="'+webroot+'css/print.css" type="text/css" media="print"/>';

        var generator = window.open('','name','height='+height+', width='+width+', top='+top+', left='+left+', resizable=no, fullscreen=yes');
        generator.document.write('<html><head><title>Relatório</title>');
        generator.document.write(css);
        generator.document.write(script);
        generator.document.write('</head><body>');
        generator.document.write(conteudo);
        generator.document.write(removeButton);
        generator.document.write('<div><center><button id="imprimir" onclick="javascript:window.print()" class="formbtn btn_imprimir">Imprimir</button></center></div>');
        generator.document.write('</body></html>');
        generator.document.close();
        if (generator.focus) (generator.focus ())

    }
</script>

<div class="toolbar">
    <?php echo $html->link(__('Continuar compra', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
    <?php echo $html->link(__('Limpar carrinho', true), array('action'=>'limparCarrinho'), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente limpar o carrinho?', true))); ?>
    <?php echo $html->link(__('Fechar pedido', true), array('controller'=>'pedidos','action'=>'add'), array('class'=>'linkbutton linkbtn btn_salvar'), sprintf(__('Deseja realmente fechar o pedido?', true))); ?>
</div>
<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Listar Produtos",true) ?></span></a></li>
    </ul>
    <div id="tab1">

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
                <tr>
                    <th align="right" colspan="4" style="font-size: 14px">Valor Frete</th>
                    <th align="left" colspan="3" style="font-size: 14px">R$ <?php echo $frete;?></th>
                </tr>
                <tr>
                    <th align="right" colspan="4" style="font-size: 14px">Total</th>
                    <th align="left" colspan="3" style="font-size: 14px; color: blue;">R$ <?php echo $total;?></th>
                </tr>
            </tfoot>
        </table>
        <?php
        if($errosFrete['codigo']!=0) {
            echo "<span style='color: red'>Ocorreu um erro ao tentar calcular frete. ".$errosFrete['descricao']."</span>";
        }
        ?>
    </div>
</div>