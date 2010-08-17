
<script src="<?php echo $this->webroot;?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $situacao['Situacao']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $situacao['Situacao']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $situacao['Situacao']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Situacao",true) ?></span></a></li><li><a href="#tab2"><span>Situacao Pedidos</span></a></li><li><a href="#tab3"><span>Vendas</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $situacao['Situacao']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">		
			<?php echo $situacao['Situacao']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">		
			<?php echo $situacao['Situacao']['ativo']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($situacao['SituacaoPedido'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Pedido Id'); ?></th><th><?php __('Data'); ?></th><th><?php __('Situacao Id'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Pedido Id'); ?></th><th><?php __('Data'); ?></th><th><?php __('Situacao Id'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($situacao['SituacaoPedido'] as $situacaoPedido):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $situacaoPedido['id'];?></td>
<td><?php echo $situacaoPedido['pedido_id'];?></td>
<td><?php echo $situacaoPedido['data'];?></td>
<td><?php echo $situacaoPedido['situacao_id'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
    
            
    <div id="tab3">
            <?php if (!empty($situacao['Venda'])):?>
            <table id="myTable3" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Created'); ?></th><th><?php __('Pedido Id'); ?></th><th><?php __('Situacao Id'); ?></th><th><?php __('Boleto Id'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Created'); ?></th><th><?php __('Pedido Id'); ?></th><th><?php __('Situacao Id'); ?></th><th><?php __('Boleto Id'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($situacao['Venda'] as $venda):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $venda['id'];?></td>
<td><?php echo $venda['created'];?></td>
<td><?php echo $venda['pedido_id'];?></td>
<td><?php echo $venda['situacao_id'];?></td>
<td><?php echo $venda['boleto_id'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
