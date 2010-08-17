
<script src="<?php echo $this->webroot;?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $("#impBoleto").click(function(){
            montarBoleto($(this).attr('value'));
        });
    });
    function montarBoleto(idPedido){
        $.ajax({
            type: 'get',
            async:true,
            url: '<?php echo $this->webroot;?>boletos/boleto/'+idPedido,
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
                    gerarBoleto(msg);
                }

            }
        });
    }
    function gerarBoleto(conteudo)
    {
        var webroot = "<?php echo $this->webroot ?>";
        var width = 850;
        var height = 730;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height-60) / 2;
        var css = '';
        css = css + '<link rel="stylesheet" href="'+webroot+'css/boleto.css" type="text/css" media="print"/>';

        var generator = window.open('','name','height='+height+', width='+width+', top='+top+', left='+left+', resizable=no, fullscreen=no, scrollbars=yes');
        generator.document.write('<html><head><title>Boleto</title>');
        generator.document.write(css);
        generator.document.write('</head><body>');
        generator.document.write(conteudo);
        generator.document.write('<div><center><button id="imprimir" onclick="javascript:window.print()" class="formbtn btn_imprimir">Imprimir</button></center></div>');
        generator.document.write('</body></html>');
        generator.document.close();
        if (generator.focus) (generator.focus ())

    }
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">            
    $(document).ready(function(){
        $(".tablesorter").tablesorter(); 
    });
</script>

<div class="toolbar">
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
                <a href="#" id="impBoleto" value="<?php echo $itens[0]['Pedido']['id'];?>" class="linkbutton linkbtn btn_imprimir">Imprimir boleto</a>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Pedido",true) ?></span></a></li></ul>
    <div id="tab1">
        <table id="myTable" class="tablesorter" cellspacing="1">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descrição</th>
                    <th>Qtde</th>
                    <th>Valor</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $totalSemDesconto = 0;
                foreach ($itens as $key => $item):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>
                <tr<?php echo $class;?>>
                    <td style="vertical-align: middle">
                            <?php echo $item['Produto']['codigo']; ?>
                    </td>
                    <td style="vertical-align: middle">
                            <?php echo $item['Produto']['descricao']; ?><br>
                        <span style="color: blue;"><?php echo $item['Item']['codigo'].' '.$item['Item']['titulo']; ?></span>
                    </td>
                    <td style="vertical-align: middle">
                            <?php echo $item['ItensPedido']['qtde']; ?><br>
                    </td>
                    <td style="vertical-align: middle">
                            <?php echo $item['Preco']['preco']; ?>
                    </td>
                    <td style="vertical-align: middle">
                            <?php
                            $parcial = (str_replace('R$','',str_replace(',','.',$item['Preco']['preco'])) * $item['ItensPedido']['qtde']);
                            $totalSemDesconto += $parcial;
                          ?>
                            <?php echo ('R$'.number_format($parcial, 2, ',', '.')); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr<?php echo $class;?>>
                    <th style="vertical-align: middle" align="right" colspan="4">
                            Subtotal
                    </th>
                    <th style="vertical-align: middle" colspan="1">
                            <?php echo 'R$'.number_format($totalSemDesconto, 2, ',','.'); ?>
                    </th>
                </tr>
                <?php if(!empty($resumoDesconto)): ?>
                        <tr>
                            <th style="vertical-align: middle; font-size: 14px;" colspan="5" align="center">
                                   Descontos Adquiridos
                            </th>
                        </tr>
                        <tr>
                            <th>Codigo</th>
                            <th>Descrição</th>
                            <th>Pacote</th>
                            <th colspan="2">Desconto</th>
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
                                    <?php echo $desconto['descricao_produto']; ?>
                            </td>
                            <td style="vertical-align: middle">
                                    <?php echo $desconto['qtde_pacote']; ?>
                            </td>
                            <td style="vertical-align: middle" colspan="2">
                                    <?php echo $desconto['desconto'].' ('.$desconto['percentual'].'%)'; ?>
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if($descontoTotal > 0): ?>
                    <tr>
                        <th align="right" colspan="2" style="font-size: 14px">Total Desconto</th>
                        <th align="left" colspan="3" style="font-size: 14px">R$ <?php echo number_format($descontoTotal, 2, ',', '.');?></th>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th align="right" colspan="2" style="font-size: 14px">Total em produto</th>
                    <th align="left" colspan="3" style="font-size: 14px">R$ <?php echo number_format($totalProduto,2,',','.');?></th>
                </tr>
                <tr>
                    <th align="right" colspan="2" style="font-size: 14px">Valor Frete</th>
                    <th align="left" colspan="3" style="font-size: 14px">R$ <?php echo $item['Pedido']['valor_frete'];?></th>
                </tr>
                <tr>
                    <th align="right" colspan="2" style="font-size: 14px">Total</th>
                    <th align="left" colspan="3" style="font-size: 14px; color: blue;">R$ <?php echo number_format($total,2,',','.');?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    
        
    
    
</div>
