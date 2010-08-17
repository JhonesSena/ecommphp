
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $user['User']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $user['User']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $user['User']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar User",true) ?></span></a></li><li><a href="#tab2"><span>Clientes</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $user['User']['id']; ?></td></tr>		<tr><td class="left"><?php __('Password'); ?></td><td class="right">		
			<?php echo $user['User']['password']; ?></td></tr>		<tr><td class="left"><?php __('Group'); ?></td><td class="right"><?php echo $user['Group']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Username'); ?></td><td class="right">		
			<?php echo $user['User']['username']; ?></td></tr>		<tr><td class="left"><?php __('Created'); ?></td><td class="right">		
			<?php echo $user['User']['created']; ?></td></tr>		<tr><td class="left"><?php __('Modified'); ?></td><td class="right">		
			<?php echo $user['User']['modified']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($user['Cliente'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Telefone'); ?></th><th><?php __('Email'); ?></th><th><?php __('Logradouro'); ?></th><th><?php __('Cep'); ?></th><th><?php __('Bairro'); ?></th><th><?php __('Cidade'); ?></th><th><?php __('Estado Id'); ?></th><th><?php __('Login'); ?></th><th><?php __('Senha'); ?></th><th><?php __('User Id'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Telefone'); ?></th><th><?php __('Email'); ?></th><th><?php __('Logradouro'); ?></th><th><?php __('Cep'); ?></th><th><?php __('Bairro'); ?></th><th><?php __('Cidade'); ?></th><th><?php __('Estado Id'); ?></th><th><?php __('Login'); ?></th><th><?php __('Senha'); ?></th><th><?php __('User Id'); ?></th><th><?php __('Ativo'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($user['Cliente'] as $cliente):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $cliente['id'];?></td>
<td><?php echo $cliente['telefone'];?></td>
<td><?php echo $cliente['email'];?></td>
<td><?php echo $cliente['logradouro'];?></td>
<td><?php echo $cliente['cep'];?></td>
<td><?php echo $cliente['bairro'];?></td>
<td><?php echo $cliente['cidade'];?></td>
<td><?php echo $cliente['estado_id'];?></td>
<td><?php echo $cliente['login'];?></td>
<td><?php echo $cliente['senha'];?></td>
<td><?php echo $cliente['user_id'];?></td>
<td><?php echo $cliente['ativo'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
