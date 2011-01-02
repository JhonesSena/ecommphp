
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $receita['Receita']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $receita['Receita']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $receita['Receita']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Receita",true) ?></span></a></li><li><a href="#tab2"><span>Item Receitas</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $receita['Receita']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">		
			<?php echo $receita['Receita']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Modalidade'); ?></td><td class="right">		
			<?php echo $receita['Receita']['modalidade']; ?></td></tr>		<tr><td class="left"><?php __('Obs'); ?></td><td class="right">		
			<?php echo $receita['Receita']['obs']; ?></td></tr>		<tr><td class="left"><?php __('Imagem'); ?></td><td class="right">		
			<?php echo $receita['Receita']['imagem']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">		
			<?php echo $receita['Receita']['ativo']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($receita['ItemReceita'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Nome'); ?></th><th><?php __('Descricao'); ?></th><th><?php __('Sequencia'); ?></th><th><?php __('Imagem'); ?></th><th><?php __('Receita Id'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Nome'); ?></th><th><?php __('Descricao'); ?></th><th><?php __('Sequencia'); ?></th><th><?php __('Imagem'); ?></th><th><?php __('Receita Id'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($receita['ItemReceita'] as $itemReceita):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $itemReceita['id'];?></td>
<td><?php echo $itemReceita['nome'];?></td>
<td><?php echo $itemReceita['descricao'];?></td>
<td><?php echo $itemReceita['sequencia'];?></td>
<td><?php echo $itemReceita['imagem'];?></td>
<td><?php echo $itemReceita['receita_id'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
