
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
        <?php if (!empty($agencia['Cedente'])):?>
            <li><a href="#tab2"><span>Cedentes</span></a></li>
        <?php endif;?>
    </ul>
        
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['id']; ?></td></tr>		<tr><td class="left"><?php __('Codigo'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['codigo']; ?></td></tr>		<tr><td class="left"><?php __('Codigo Cedente'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['codigo_cedente']; ?></td></tr>		<tr><td class="left"><?php __('Logradouro'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['logradouro']; ?></td></tr>		<tr><td class="left"><?php __('Bairro'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['bairro']; ?></td></tr>		<tr><td class="left"><?php __('Cidade'); ?></td><td class="right"><?php echo $agencia['Agencia']['cidade']; ?></td></tr>		<tr><td class="left"><?php __('Telefone'); ?></td><td class="right">
			<?php echo $agencia['Agencia']['telefone']; ?></td></tr>		<tr><td class="left"><?php __('Banco'); ?></td><td class="right"><?php echo $agencia['Banco']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">		
			<?php echo $agencia['Agencia']['ativo']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($agencia['Cedente'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Conta Corrente'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Agencia Id'); ?></th><th><?php __('Bloqueto Id'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Conta Corrente'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Agencia Id'); ?></th><th><?php __('Bloqueto Id'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($agencia['Cedente'] as $cedente):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $cedente['id'];?></td>
<td><?php echo $cedente['conta_corrente'];?></td>
<td><?php echo $cedente['cliente_id'];?></td>
<td><?php echo $cedente['agencia_id'];?></td>
<td><?php echo $cedente['bloqueto_id'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
