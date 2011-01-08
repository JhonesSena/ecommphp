
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
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $empresa['Empresa']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Empresa",true) ?></span></a></li>
        <li><a href="#tab2"><span><?php echo __("Outros Contatos",true) ?></span></a></li>
    </ul>

    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Nome Fantasia'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['nome_fantasia']; ?></td></tr>		<tr><td class="left"><?php __('Cnpj'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['cnpj']; ?></td></tr>		<tr><td class="left"><?php __('Email'); ?></td><td class="right">
			<?php echo $empresa['Empresa']['email']; ?></td></tr>		<tr><td class="left"><?php __('Logradouro'); ?></td><td class="right">
			<?php echo $empresa['Empresa']['logradouro']; ?></td></tr>		<tr><td class="left"><?php __('Cep'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['cep']; ?></td></tr>		<tr><td class="left"><?php __('Bairro'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['bairro']; ?></td></tr>		<tr><td class="left"><?php __('Cidade'); ?></td><td class="right">		
			<?php echo $empresa['Empresa']['cidade']; ?></td></tr>		<tr><td class="left"><?php __('Estado'); ?></td><td class="right">		
			<?php echo $empresa['Estado']['nome']; ?></td></tr>
            
        </table>
    </div>
    <div id="tab2">
        <table id="myTable" class="tablesorter" cellspacing="1">
            <thead>
               <tr>
                                        <th><?php echo 'Tipo';?></th>
                                        <th><?php echo 'Valor';?></th>
                                    </tr>
            </thead>
            <tfoot>
                <tr>
                                        <th><?php echo 'Tipo';?></th>
                                        <th><?php echo 'Valor';?></th>
                                    </tr>
            </tfoot>
            <tbody>
            <?php
            $i = 0;
            foreach ($empresa['ContatosEmpresa'] as $contatosEmpresa):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>
                <td>
			<?php echo $contatosEmpresa['tipo']; ?>
		</td>
		<td>
			<?php echo $contatosEmpresa['valor']; ?>
		</td>
	</tr>
<?php endforeach; ?>

            </tbody>
        </table>
    </div>
        
    
    
</div>
