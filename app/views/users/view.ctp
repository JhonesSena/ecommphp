
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
                <?php if($jquery->verificaPermissao(array('users/edit_user'), $session->read('UserTelas'))):?>
                    <?php echo $html->link(__('Editar', true), array('action'=>'edit_user', $user['User']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
                <?php endif;?>
                <?php if($jquery->verificaPermissao(array('users/delete'), $session->read('UserTelas'))):?>
                    <?php echo $html->link(__('Deletar', true), array('action'=>'delete', $user['User']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $user['User']['id'])); ?>
                <?php endif;?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Usuário",true) ?></span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $user['User']['id']; ?></td></tr>				
                        <tr><td class="left"><?php __('Nome'); ?></td><td class="right"><?php echo $user['Cliente']['nome']; ?></td></tr>
                        <tr><td class="left"><?php __('Email'); ?></td><td class="right"><?php echo $user['Cliente']['email']; ?></td></tr>
                        <tr><td class="left"><?php __('Grupo de Acesso'); ?></td><td class="right"><?php echo $user['Group']['name']; ?></td></tr>		            
            
        </table>
    </div>    
</div>
