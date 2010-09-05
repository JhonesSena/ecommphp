<?php echo $jquery->init_date('pt-br','01/01/2000'); ?>
<script src="<?php echo $this->webroot;?>js/jquery.price_format.1.3.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $('#taxa').priceFormat({
            prefix: 'R$',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });
    });
</script>

<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li>
			<a href="#tab1"><span><?php echo __("Novo Bloqueto",true) ?></span></a>
			</li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('Bloqueto');?>
		
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
                echo $jquery->input('nome',array('class'=>'validateRequired','alt'=>'Nome', 'label'=>'Nome*','empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('banco_id',array('class'=>'validateRequired','alt'=>'Banco', 'label'=>'Banco*','empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('local_pagamento',array('class'=>'validateRequired','alt'=>'Local Pagamento', 'label'=>'Local Pagamento*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('carteira',array('class'=>'validateRequired','alt'=>'Carteira', 'label'=>'Carteira*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('taxa_boleto',array('class'=>'validateRequired','alt'=>'Taxa Boleto', 'label'=>'Taxa Boleto*','id'=>'taxa','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('dias_prazo_pagamento',array('class'=>'validateRequired','alt'=>'Dias Prazo Pagamento', 'label'=>'Dias Prazo Pagamento*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('tipo',array('class'=>'validateRequired','alt'=>'Tipo', 'label'=>'Tipo*','type'=>'select', 'empty'=>'Selecione','options'=>$tipos,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('ativo',array('type'=>'hidden','value'=>1,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
</div>
