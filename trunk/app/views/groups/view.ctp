
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $group['Group']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $group['Group']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $group['Group']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Grupo de Acesso",true) ?></span></a></li>
        <?php if(!empty($group['Permissao'])):?><li><a href="#tab2"><span><?php echo __("Permissões",true) ?></span></a></li><?php endif;?>
    </ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $group['Group']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">
			<?php echo $group['Group']['name']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">
			<?php if($group['Group']['ativo']==1) echo 'Sim'; else echo 'Não'; ?></td></tr>
            
        </table>
    </div>
    

    <?php if(!empty($group['Permissao'])):?>
        <div id="tab2">
            <table id="myTable" class="tablesorter" cellspacing="1">
                <thead>
                   <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Ativo</th>
                                        </tr>
                </thead>
                <tfoot>
                    <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Ativo</th>
                                        </tr>
                </tfoot>
                <tbody>
                <?php
                $i = 0;
                foreach ($group['Permissao'] as $permissao):
                        $class = null;
                        if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                        }
                ?>
            <tr<?php echo $class;?>>
                    <td>
                            <?php echo $permissao['nome']; ?>
                    </td>
                    <td>
                            <?php echo $permissao['descricao']; ?>
                    </td>
                    <td>
                            <?php if($permissao['ativo']==1) echo 'Sim';else echo 'Não'; ?>
                    </td>
            </tr>
    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php endif;?>
</div>
