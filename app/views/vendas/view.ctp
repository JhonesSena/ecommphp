
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $venda['Venda']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $venda['Venda']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $venda['Venda']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Venda",true) ?></span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $venda['Venda']['id']; ?></td></tr>		<tr><td class="left"><?php __('Created'); ?></td><td class="right">		
			<?php echo $venda['Venda']['created']; ?></td></tr>		<tr><td class="left"><?php __('Pedido'); ?></td><td class="right"><?php echo $venda['Pedido']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Situacao'); ?></td><td class="right"><?php echo $venda['Situacao']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Boleto'); ?></td><td class="right"><?php echo $venda['Boleto']['nome']; ?></td></tr>            
            
        </table>
    </div>
    
        
    
    
</div>
