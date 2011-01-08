
<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
</script>

<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Editar Empresa",true) ?></span></a></li>
        <li><a href="#tab2"><span><?php echo __("Outros Contatos",true) ?></span></a></li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('Empresa');?>
		
			<? if(!empty($jquery->validationErrors)){ ?>
			<div class="ui-widget">
				<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
					<br>
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
					<? 
					if ($session->check('Message.flash')){
						$session->flash();
						echo "<br>";
					}
					foreach($jquery->validationErrors as $model){
						foreach($model as $campo=>$valor){
							echo $jquery->label($campo).": ".$valor."<br>";
						}
					}
					?>
					<br>
				</div>
			</div>
			<?}?>
		        
        <table cellspacing="0" class="details">
        	<?php
		echo $jquery->input('id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('nome',array('class'=>'validateRequired','alt'=>'Nome','label'=>'Nome*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('nome_fantasia',array('class'=>'validateRequired','alt'=>'Nome fantasia','label'=>'Nome fantasia*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cnpj',array('class'=>'validateRequired validateCNPJ','alt'=>'Cnpj','label'=>'Cnpj*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('email',array('class'=>'validateRequired validateEmail','alt'=>'Email','label'=>'Email*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('logradouro',array('rows'=>2,'class'=>'validateRequired','alt'=>'Logradouro','label'=>'Logradouro*','type'=>'textarea','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cep',array('class'=>'validateRequired validateCEP','alt'=>'Cep','label'=>'Cep*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bairro',array('class'=>'validateRequired','alt'=>'Bairro','label'=>'Bairro*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cidade',array('class'=>'validateRequired','alt'=>'Cidade','label'=>'Cidade*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('estado_id',array('class'=>'validateRequired','alt'=>'Estado','label'=>'Estado*','empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
    <div id="tab2">
        <?php echo $form->create('ContatosEmpresa',array('url'=>array('action'=>'add',$this->data['Empresa']['id'])));?>
        <table cellspacing="0" class="details">
        	<?php
		echo $jquery->input('id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('tipo',array('class'=>'validateRequired','alt'=>'Tipo','label'=>'Tipo*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('valor',array('class'=>'validateRequired','alt'=>'Valor','label'=>'Valor*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>

        <table id="myTable" class="tablesorter" cellspacing="1">
            <thead>
               <tr>
                                        <th><?php echo 'Tipo';?></th>
                                        <th><?php echo 'Valor';?></th>
                                        <th><?php echo 'Excluir';?></th>
                                    </tr>
            </thead>
            <tfoot>
                <tr>
                                        <th><?php echo 'Tipo';?></th>
                                        <th><?php echo 'Valor';?></th>
                                        <th><?php echo 'Excluir';?></th>
                                    </tr>
            </tfoot>
            <tbody>
            <?php
            $i = 0;
            foreach ($this->data['ContatosEmpresa'] as $contatosEmpresa):
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
                <td>
                        <?php echo $html->image("/css/img/delete.gif", array('border'=>'none',"alt" => "Excluir",
                               'url' => array('controller' => 'contatos_empresas', 'action' => 'delete', $contatosEmpresa['id'],$this->data['Empresa']['id']))); ?>

		</td>
	</tr>
<?php endforeach; ?>

            </tbody>
        </table>

    </div>
</div>
