
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
        <li><a href="#tab1"><span><?php echo __("Visualizar Group",true) ?></span></a></li><li><a href="#tab2"><span>Useres</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $group['Group']['id']; ?></td></tr>		<tr><td class="left"><?php __('Name'); ?></td><td class="right">		
			<?php echo $group['Group']['name']; ?></td></tr>		<tr><td class="left"><?php __('Created'); ?></td><td class="right">		
			<?php echo $group['Group']['created']; ?></td></tr>		<tr><td class="left"><?php __('Modified'); ?></td><td class="right">		
			<?php echo $group['Group']['modified']; ?></td></tr>            
            
        </table>
    </div>
    
    
            
    <div id="tab2">
            <?php if (!empty($group['User'])):?>
            <table id="myTable2" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Password'); ?></th><th><?php __('Group Id'); ?></th><th><?php __('Username'); ?></th><th><?php __('Created'); ?></th><th><?php __('Modified'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Password'); ?></th><th><?php __('Group Id'); ?></th><th><?php __('Username'); ?></th><th><?php __('Created'); ?></th><th><?php __('Modified'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($group['User'] as $user):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $user['id'];?></td>
<td><?php echo $user['password'];?></td>
<td><?php echo $user['group_id'];?></td>
<td><?php echo $user['username'];?></td>
<td><?php echo $user['created'];?></td>
<td><?php echo $user['modified'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
