
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $grupo['Grupo']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $grupo['Grupo']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $grupo['Grupo']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Grupo",true) ?></span></a></li><li><a href="#tab2"><span>Produtos</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $grupo['Grupo']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">		
			<?php echo $grupo['Grupo']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">		
			<?php if($grupo['Grupo']['ativo']==1) echo 'Sim'; else 'Não';?></td></tr>
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($grupo['Produto'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Codigo'); ?></th><th><?php __('Titulo'); ?></th><th><?php __('Linha Id'); ?></th><th><?php __('Grupo Id'); ?></th><th><?php __('Metragem'); ?></th><th><?php __('Pacote'); ?></th><th><?php __('Peso'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Codigo'); ?></th><th><?php __('Titulo'); ?></th><th><?php __('Linha Id'); ?></th><th><?php __('Grupo Id'); ?></th><th><?php __('Metragem'); ?></th><th><?php __('Pacote'); ?></th><th><?php __('Peso'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($grupo['Produto'] as $produto):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $produto['id'];?></td>
<td><?php echo $produto['codigo'];?></td>
<td><?php echo $produto['titulo'];?></td>
<td><?php echo $produto['linha_id'];?></td>
<td><?php echo $produto['grupo_id'];?></td>
<td><?php echo $produto['metragem'];?></td>
<td><?php echo $produto['pacote'];?></td>
<td><?php echo $produto['peso'];?></td>
<td><?php if ($produto['ativo']==1) echo 'Sim'; else echo 'Não';?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
