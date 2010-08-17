
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $banco['Banco']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $banco['Banco']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $banco['Banco']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Banco",true) ?></span></a></li><li><a href="#tab2"><span>Bloquetos</span></a></li><li><a href="#tab3"><span>Agencias</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $banco['Banco']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">		
			<?php echo $banco['Banco']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Codigo Compensacao'); ?></td><td class="right">		
			<?php echo $banco['Banco']['codigo_compensacao']; ?></td></tr>		<tr><td class="left"><?php __('Imagem'); ?></td><td class="right">		
			<?php echo $banco['Banco']['imagem']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($banco['Bloqueto'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Banco Id'); ?></th><th><?php __('Local Pagamento'); ?></th><th><?php __('Carteira'); ?></th><th><?php __('Tipo'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Banco Id'); ?></th><th><?php __('Local Pagamento'); ?></th><th><?php __('Carteira'); ?></th><th><?php __('Tipo'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($banco['Bloqueto'] as $bloqueto):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $bloqueto['id'];?></td>
<td><?php echo $bloqueto['banco_id'];?></td>
<td><?php echo $bloqueto['local_pagamento'];?></td>
<td><?php echo $bloqueto['carteira'];?></td>
<td><?php echo $bloqueto['tipo'];?></td>
<td><?php echo $bloqueto['ativo'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
    
            
    <div id="tab3">
            <?php if (!empty($banco['Agencia'])):?>
            <table id="myTable3" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Codigo'); ?></th><th><?php __('Codigo Cedente'); ?></th><th><?php __('Logradouro'); ?></th><th><?php __('Bairro'); ?></th><th><?php __('Cidade Id'); ?></th><th><?php __('Telefone'); ?></th><th><?php __('Banco Id'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Codigo'); ?></th><th><?php __('Codigo Cedente'); ?></th><th><?php __('Logradouro'); ?></th><th><?php __('Bairro'); ?></th><th><?php __('Cidade Id'); ?></th><th><?php __('Telefone'); ?></th><th><?php __('Banco Id'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($banco['Agencia'] as $agencia):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $agencia['id'];?></td>
<td><?php echo $agencia['codigo'];?></td>
<td><?php echo $agencia['codigo_cedente'];?></td>
<td><?php echo $agencia['logradouro'];?></td>
<td><?php echo $agencia['bairro'];?></td>
<td><?php echo $agencia['cidade_id'];?></td>
<td><?php echo $agencia['telefone'];?></td>
<td><?php echo $agencia['banco_id'];?></td>
<td><?php echo $agencia['ativo'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
