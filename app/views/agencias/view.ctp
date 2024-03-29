
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $agencia['Agencia']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $agencia['Agencia']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $agencia['Agencia']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Agencia",true) ?></span></a></li>
    </ul>
        
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['id']; ?></td></tr>		<tr><td class="left"><?php __('Codigo'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['codigo']; ?></td></tr>		<tr><td class="left"><?php __('Codigo Cedente'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['codigo_cedente']; ?></td></tr>		<tr><td class="left"><?php __('Contrato'); ?></td><td class="right">
			<?php echo $agencia['Agencia']['contrato']; ?></td></tr>		<tr><td class="left"><?php __('Convênio Cobrança'); ?></td><td class="right">
			<?php echo $agencia['Agencia']['convenio_cobranca']; ?></td></tr>		<tr><td class="left"><?php __('Logradouro'); ?></td><td class="right">
			<?php echo $agencia['Agencia']['logradouro']; ?></td></tr>		<tr><td class="left"><?php __('Bairro'); ?></td><td class="right">
			<?php echo $agencia['Agencia']['bairro']; ?></td></tr>		<tr><td class="left"><?php __('Cidade'); ?></td><td class="right"><?php echo $agencia['Agencia']['cidade']; ?></td></tr>		<tr><td class="left"><?php __('Telefone'); ?></td><td class="right">
			<?php echo $agencia['Agencia']['telefone']; ?></td></tr>		<tr><td class="left"><?php __('Banco'); ?></td><td class="right"><?php echo $agencia['Banco']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['ativo']; ?></td></tr>            
            
        </table>
    </div>
</div>
