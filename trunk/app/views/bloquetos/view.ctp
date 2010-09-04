
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
    <?php echo $html->link(__('Editar', true), array('action'=>'edit', $bloqueto['Bloqueto']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
    <?php echo $html->link(__('Deletar', true), array('action'=>'delete', $bloqueto['Bloqueto']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $bloqueto['Bloqueto']['id'])); ?>
    <?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Bloqueto",true) ?></span></a></li>
    </ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            <tr><td class="left"><?php __('Id'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['id']; ?></td></tr>		<tr><td class="left"><?php __('Banco'); ?></td><td class="right"><?php echo $bloqueto['Banco']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Local Pagamento'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['local_pagamento']; ?></td></tr>		<tr><td class="left"><?php __('Carteira'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['carteira']; ?></td></tr>		<tr><td class="left"><?php __('Taxa Boleto'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['taxa_boleto']; ?></td></tr>		<tr><td class="left"><?php __('Dias Prazo Pagamento'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['dias_prazo_pagamento']; ?></td></tr>		<tr><td class="left"><?php __('Tipo'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['tipo']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">
                    <?php echo $bloqueto['Bloqueto']['ativo']; ?></td></tr>

        </table>
    </div>
</div>
