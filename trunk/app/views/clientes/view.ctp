
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $cliente['Cliente']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $cliente['Cliente']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $cliente['Cliente']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Cliente",true) ?></span></a></li><li><a href="#tab2"><span>Cedentes</span></a></li><li><a href="#tab3"><span>Cliente Fisicos</span></a></li><li><a href="#tab4"><span>Cliente Juridicos</span></a></li><li><a href="#tab5"><span>Boletos</span></a></li><li><a href="#tab6"><span>Cliente Pedidos</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['id']; ?></td></tr>		<tr><td class="left"><?php __('Telefone'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['telefone']; ?></td></tr>		<tr><td class="left"><?php __('Email'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['email']; ?></td></tr>		<tr><td class="left"><?php __('Logradouro'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['logradouro']; ?></td></tr>		<tr><td class="left"><?php __('Cep'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['cep']; ?></td></tr>		<tr><td class="left"><?php __('Bairro'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['bairro']; ?></td></tr>		<tr><td class="left"><?php __('Cidade'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['cidade']; ?></td></tr>		<tr><td class="left"><?php __('Estado'); ?></td><td class="right"><?php echo $cliente['Estado']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Login'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['login']; ?></td></tr>		<tr><td class="left"><?php __('Senha'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['senha']; ?></td></tr>		<tr><td class="left"><?php __('User'); ?></td><td class="right"><?php echo $cliente['User']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">		
			<?php echo $cliente['Cliente']['ativo']; ?></td></tr>            
            
        </table>
    </div>
    
                <div id="tab2">
                 <table cellspacing="0" class="details">
                    <tr>
                        <th colspan="2">Detalhes<th>
                    </tr>
            <?php if (!empty($cliente['Cedente'])):?>
            		<tr><td class="left"><?php __('Id');?></td><td class="right"><?php echo $cliente['Cedente']['id'];?></td></tr>		<tr><td class="left"><?php __('Conta Corrente');?></td><td class="right"><?php echo $cliente['Cedente']['conta_corrente'];?></td></tr>		<tr><td class="left"><?php __('Cliente Id');?></td><td class="right"><?php echo $cliente['Cedente']['cliente_id'];?></td></tr>		<tr><td class="left"><?php __('Agencia Id');?></td><td class="right"><?php echo $cliente['Cedente']['agencia_id'];?></td></tr>		<tr><td class="left"><?php __('Bloqueto Id');?></td><td class="right"><?php echo $cliente['Cedente']['bloqueto_id'];?></td></tr>                    
                </table>
                <?php endif; ?>
            
                <?php echo $html->link(__('Editar Cedente', true), array('controller'=> 'cedentes', 'action'=>'edit', $cliente['Cedente']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
            </div>
                        <div id="tab3">
                 <table cellspacing="0" class="details">
                    <tr>
                        <th colspan="2">Detalhes<th>
                    </tr>
            <?php if (!empty($cliente['ClienteFisico'])):?>
            		<tr><td class="left"><?php __('Id');?></td><td class="right"><?php echo $cliente['ClienteFisico']['id'];?></td></tr>		<tr><td class="left"><?php __('Cliente Id');?></td><td class="right"><?php echo $cliente['ClienteFisico']['cliente_id'];?></td></tr>		<tr><td class="left"><?php __('Nome');?></td><td class="right"><?php echo $cliente['ClienteFisico']['nome'];?></td></tr>		<tr><td class="left"><?php __('Cpf');?></td><td class="right"><?php echo $cliente['ClienteFisico']['cpf'];?></td></tr>                    
                </table>
                <?php endif; ?>
            
                <?php echo $html->link(__('Editar Cliente Fisico', true), array('controller'=> 'cliente_fisicos', 'action'=>'edit', $cliente['ClienteFisico']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
            </div>
                        <div id="tab4">
                 <table cellspacing="0" class="details">
                    <tr>
                        <th colspan="2">Detalhes<th>
                    </tr>
            <?php if (!empty($cliente['ClienteJuridico'])):?>
            		<tr><td class="left"><?php __('Id');?></td><td class="right"><?php echo $cliente['ClienteJuridico']['id'];?></td></tr>		<tr><td class="left"><?php __('Cliente Id');?></td><td class="right"><?php echo $cliente['ClienteJuridico']['cliente_id'];?></td></tr>		<tr><td class="left"><?php __('Nome Fantasia');?></td><td class="right"><?php echo $cliente['ClienteJuridico']['nome_fantasia'];?></td></tr>		<tr><td class="left"><?php __('Razao Social');?></td><td class="right"><?php echo $cliente['ClienteJuridico']['razao_social'];?></td></tr>		<tr><td class="left"><?php __('Cnpj');?></td><td class="right"><?php echo $cliente['ClienteJuridico']['cnpj'];?></td></tr>                    
                </table>
                <?php endif; ?>
            
                <?php echo $html->link(__('Editar Cliente Juridico', true), array('controller'=> 'cliente_juridicos', 'action'=>'edit', $cliente['ClienteJuridico']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
            </div>
            
            
    <div id="tab5">
            <?php if (!empty($cliente['Boleto'])):?>
            <table id="myTable5" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Numero'); ?></th><th><?php __('Nosso Numero'); ?></th><th><?php __('Emissao'); ?></th><th><?php __('Status'); ?></th><th><?php __('Vencimento'); ?></th><th><?php __('Cedente Id'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Valor'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Numero'); ?></th><th><?php __('Nosso Numero'); ?></th><th><?php __('Emissao'); ?></th><th><?php __('Status'); ?></th><th><?php __('Vencimento'); ?></th><th><?php __('Cedente Id'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Valor'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($cliente['Boleto'] as $boleto):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $boleto['id'];?></td>
<td><?php echo $boleto['numero'];?></td>
<td><?php echo $boleto['nosso_numero'];?></td>
<td><?php echo $boleto['emissao'];?></td>
<td><?php echo $boleto['status'];?></td>
<td><?php echo $boleto['vencimento'];?></td>
<td><?php echo $boleto['cedente_id'];?></td>
<td><?php echo $boleto['cliente_id'];?></td>
<td><?php echo $boleto['valor'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
    
            
    <div id="tab6">
            <?php if (!empty($cliente['ClientePedido'])):?>
            <table id="myTable6" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <th><?php __('Id'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Pedido Id'); ?></th>                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <th><?php __('Id'); ?></th><th><?php __('Cliente Id'); ?></th><th><?php __('Pedido Id'); ?></th>                </tr>
            </tfoot> 
            <tbody>
    <?php
                    $i = 0;
                    foreach ($cliente['ClientePedido'] as $clientePedido):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                            }
                    ?>
<tr<?php echo $class;?>><td><?php echo $clientePedido['id'];?></td>
<td><?php echo $clientePedido['cliente_id'];?></td>
<td><?php echo $clientePedido['pedido_id'];?></td>
</tr>
	<?php endforeach;?>            </tbody>
            </table>
    <?php endif; ?>

            
    
    </div>
        
    
    
</div>
