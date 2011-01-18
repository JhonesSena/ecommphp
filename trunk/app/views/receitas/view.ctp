<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.jstree/jquery.tree.js"></script>
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
        <li><a href="#tab1"><span><?php echo __("Visualizar Receita",true) ?></span></a></li>
        <li><a href="#tab2"><span><?php echo __("Etapas",true) ?></span></a></li>
        <li><a href="#tab3"><span><?php echo __("Materiais Utilizados",true) ?></span></a></li>
    </ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $receita['Receita']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">
			<?php echo $receita['Receita']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Saudação'); ?></td><td class="right">
			<?php if(!empty($receita['Receita']['saudacao'])) echo $receita['Receita']['saudacao']; else "Nenhuma";  ?></td></tr>		<tr><td class="left"><?php __('Modalidade'); ?></td><td class="right">
			<?php echo $receita['Receita']['modalidade']; ?></td></tr>		<tr><td class="left"><?php __('Obs'); ?></td><td class="right">
			<?php echo $receita['Receita']['obs']; ?></td></tr>		<tr><td class="left"><?php __('Publicado'); ?></td><td class="right">
			<?php if($receita['Receita']['publicar']) echo 'Sim'; else echo 'Não'; ?></td></tr>		<tr><td class="left"><?php __('Imagem'); ?></td><td class="right">
			<?php echo $html->image('/img_receitas/'.$receita['Receita']['imagem'], array('align'=>'center','height'=>'100px'));?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">
			<?php if($receita['Receita']['ativo']==1) echo 'Sim';else echo 'Não'; ?></td></tr>
            
        </table>
    </div>
    
    
            
    <div id="tab2">
        <table id="myTable" class="tablesorter" cellspacing="1">
            <thead>
               <tr>
                    <th><?php echo _('Nome');?></th>
                    <th><?php echo _('Descrição');?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php echo _('Nome');?></th>
                    <th><?php echo _('Descrição');?></th>
                </tr>
            </tfoot>
            <tbody>
            <?php
            $i = 0;
            foreach ($receita['ItemReceita'] as $item):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $item['nome']; ?>
		</td>
		<td>
			<?php echo $item['descricao'];?>
		</td>
	</tr>
<?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div id="tab3">
        <table id="myTable2" class="tablesorter" cellspacing="1">
            <thead>
               <tr>
                    <th><?php echo _('Nome');?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php echo _('Nome');?></th>
                </tr>
            </tfoot>
            <tbody>
            <?php
            $i = 0;
            foreach ($receita['Material'] as $item):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $item['nome']; ?>
		</td>
	</tr>
<?php endforeach; ?>

            </tbody>
        </table>
    </div>
        
    
    
</div>
