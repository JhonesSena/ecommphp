
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $cliente['Cliente']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $cliente['Cliente']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $cliente['Cliente']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Cliente",true) ?></span></a></li>
    </ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['id']; ?></td></tr>		<tr><td class="left"><?php __('Telefone'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['telefone']; ?></td></tr>		<tr><td class="left"><?php __('Email'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['email']; ?></td></tr>		<tr><td class="left"><?php __('Logradouro'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['logradouro']; ?></td></tr>		<tr><td class="left"><?php __('Cep'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['cep']; ?></td></tr>		<tr><td class="left"><?php __('Bairro'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['bairro']; ?></td></tr>		<tr><td class="left"><?php __('Cidade'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['cidade']; ?></td></tr>		<tr><td class="left"><?php __('Estado'); ?></td><td class="right">
                        <?php echo $cliente['Estado']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">
			<?php if($cliente['Cliente']['ativo']) echo 'Sim'; else echo 'Não'; ?></td></tr>
            
        </table>
    </div>    
</div>
