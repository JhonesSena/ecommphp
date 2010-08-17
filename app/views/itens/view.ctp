
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $item['Item']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $item['Item']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $item['Item']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Item",true) ?></span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $item['Item']['id']; ?></td></tr>		<tr><td class="left"><?php __('Produto Id'); ?></td><td class="right">		
			<?php echo $item['Produto']['descricao']; ?></td></tr>		<tr><td class="left"><?php __('Codigo'); ?></td><td class="right">
			<?php echo $item['Item']['codigo']; ?></td></tr>		<tr><td class="left"><?php __('Titulo'); ?></td><td class="right">		
			<?php echo $item['Item']['titulo']; ?></td></tr>		<tr><td class="left"><?php __('Metragem'); ?></td><td class="right">		
			<?php echo $item['Item']['metragem']; ?></td></tr>		
                        <tr>
                        <td class="left"><?php __('Cor'); ?></td>
                            <td class="right">
                            <?php if(!empty($item['Cor']['id'])){
                                echo $item['Cor']['nome'].' '.$html->image('/'.$item['Cor']['diretorio'], array('align'=>'center','height'=>'20px', 'width'=>'70px;'));
                                } else{
                                    echo 'Nenhuma';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="left"><?php __('Ativo'); ?></td><td class="right">
			<?php echo $item['Item']['ativo']; ?></td></tr>            
            
        </table>
    </div>
    
        
    
    
</div>
