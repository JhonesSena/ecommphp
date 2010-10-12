<script src="<?php echo $this->webroot;?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $('.impBoleto').click(function(){
            montarBoleto($(this).attr('value'));
        });
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

<div class="toolbar">


    <?
    $total = $paginator->counter(array('format' => '%pages%', true));
    if($total!=1) {
        echo "&nbsp;";
        $ant  = $paginator->current()-1;
        $prox = $paginator->current()+1;

        $sort = isset($paginator->params['named']['sort'])?'/sort:'. $paginator->params['named']['sort']:"";
        $direction = isset($paginator->params['named']['direction'])?'/direction:'. $paginator->params['named']['direction']:"";

        echo $html->link(__(null,true), 'index/page:'.$ant.$sort.$direction,array('class'=>'linkbutton linkbtn btn_back'))."&nbsp;";
        echo '<select style="height:22px;font-size:13px" onchange="location.href=\''. $this->webroot.$this->params['controller'].'/index/page:\'+this.value+\''.$sort.$direction.'\'">';
        for($x=1;$x<=$total;$x++) {
            echo $x==$paginator->current()?"<option selected value=\"$x\">".$x."</option>":"<option value=\"$x\">".$x."</option>";
        }
        echo "</select>&nbsp;";
        echo $html->link(__(null,true), 'index/page:'.$prox.$sort.$direction,array('class'=>'linkbutton linkbtn btn_go'));
    }
    ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Listar Pedidos",true) ?></span></a></li>
    </ul>
    <div id="tab1">

        <table id="myTable" class="tablesorter" cellspacing="1"> 
            <thead> 
                <tr>
                    <th><?php echo $paginator->sort('número');?></th>
                    <th><?php echo $paginator->sort('data');?></th>
                    <th><?php echo $paginator->sort('situacao_id');?></th>
                    <th><?php echo $paginator->sort('boleto');?></th>
                </tr>
            </thead> 
            <tfoot> 
                <tr>
                    <th><?php echo $paginator->sort('número');?></th>
                    <th><?php echo $paginator->sort('data');?></th>
                    <th><?php echo $paginator->sort('situacao_id');?></th>
                    <th><?php echo $paginator->sort('boleto');?></th>
                </tr>
            </tfoot> 
            <tbody> 
                <?php
                $i = 0;
                foreach ($pedidos as $pedido):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>
                <tr<?php echo $class;?>>
                    <td>
                            <?php echo $html->link($pedido['Pedido']['id'], array('action'=>'view', $pedido['Pedido']['id']), array('id'=>$pedido['Pedido']['id'])); ?>
                    </td>
                    <td>
                            <?php echo $pedido['Pedido']['created']; ?>
                    </td>
                    <td>
                            <?php echo $pedido['SituacaoPedido']['nome']; ?>
                    </td>
                    <td align="center">
                            <?php echo $html->image('/css/img/imprimir.gif', array('value'=>$pedido['Pedido']['id'], 'class'=>'impBoleto','style'=>'cursor: pointer;','align'=>'center','height'=>'16px', 'width'=>'16px;')); ?>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody> 
        </table>

    </div>
</div>