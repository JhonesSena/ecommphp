
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $cedente['Cedente']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $cedente['Cedente']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $cedente['Cedente']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Cedente",true) ?></span></a></li><li><a href="#tab2"><span>Boletos</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $cedente['Cedente']['id']; ?></td></tr>		<tr><td class="left"><?php __('Conta Corrente'); ?></td><td class="right">		
			<?php echo $cedente['Cedente']['conta_corrente']; ?></td></tr>		<tr><td class="left"><?php __('Cliente'); ?></td><td class="right"><?php echo $cedente['Cliente']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Agencia'); ?></td><td class="right"><?php echo $cedente['Agencia']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Bloqueto'); ?></td><td class="right"><?php echo $cedente['Bloqueto']['nome']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($cedente['Boleto'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Numero'); ?></th><th><?php __('Nosso Numero'); ?></th><th><?php __('Emissao'); ?></th><th><?php __('Status'); ?></th><th><?php __('Vencimento'); ?></th><th><?php __('Cedente Id'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Valor'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Numero'); ?></th><th><?php __('Nosso Numero'); ?></th><th><?php __('Emissao'); ?></th><th><?php __('Status'); ?></th><th><?php __('Vencimento'); ?></th><th><?php __('Cedente Id'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Valor'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($cedente['Boleto'] as $boleto):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $boleto['id'];?></td>
<td><?php echo $boleto['numero'];?></td>
<td><?php echo $boleto['nosso_numero'];?></td>
<td><?php echo $boleto['emissao'];?></td>
<td><?php echo $boleto['status'];?></td>
<td><?php echo $boleto['vencimento'];?></td>
<td><?php echo $boleto['cedente_id'];?></td>
<td><?php echo $boleto['cliente_id'];?></td>
<td><?php echo $boleto['valor'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
