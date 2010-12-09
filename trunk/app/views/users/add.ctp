
<? echo $jquery->init_date(); ?>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
    
    $(document).ready(function() {
        $("form").submit(function(){
            return verificaValidacao();
        });
    });
    
    function verificaValidacao(){

        $('#msgerroData').remove();
        var retorno = true;

        var string = "<ul id='msgerroData'>";

        if($("#senhaId").val()!=$("#senhaConfirmId").val()){
            string = string + "<li>A confirmação de senha não coincidem.</li>";
            retorno = false;
        }

        if(retorno == false){
            string = string + "</ul>";
            $('#msgerro').append(string);
            $('#msgerro').show();
        }

        if($('#msgerro').text() == ""){
            $('#msgerro').hide();
        }

        return retorno;

    }
</script>

<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li>
			<a href="#tab1"><span><?php echo __("Novo Usuário",true) ?></span></a>
			</li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('User');?>
		
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
		echo $jquery->input('username',array('class'=>'validateRequired','label'=>'Usuário*','alt'=>'Usuário','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('password',array('id'=>'senhaId','class'=>'validateRequired','label'=>'Senha*','alt'=>'Senha','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('password_confirm',array('type'=>'password','id'=>'senhaConfirmId','label'=>'Confirmar Senha*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('group_id',array('class'=>'validateRequired','label'=>'Grupo de Acesso*','alt'=>'Grupo de Acesso','empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('ativo',array('type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
</div>
