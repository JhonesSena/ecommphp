

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $('#cep').blur(function(){
            if($(this).val() != '__.___-___')
               validaCep($(this).val());
        });
    });

    function validaCep(cep){
        $.ajax({
            type: "get",
            async: true,
            error: function(){
                location.href="";
            },
            url: '<?php echo $this->webroot;?>ajax/validaCep/'+cep,
            dataType: 'json',
            success: function(json){
                var result = eval(json);
                if(result['webservicecep']['resultado'] > 0){
                    $("#cidade").val(result['webservicecep']['cidade']);
                    $("#validaCep").val(result['webservicecep']['resultado']);
                }
                else{
                    $('#flashMessage').html("O CEP digitado é inválido.");
                    $('#msginfo').fadeIn(500);
                    setTimeout("$('#msginfo').fadeOut(500)",4000);
                }
            }
        });
    }
</script>

<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li>
			<a href="#tab1"><span><?php echo __("Novo Cliente",true) ?></span></a>
			</li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('Cliente');?>
		
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
		echo $jquery->input('telefone',array('class'=>'validadeRequired validateTelefone','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('email',array('class'=>'validadeRequired validateEmail', 'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('logradouro',array('class'=>'validadeRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cep',array('id'=>'cep','class'=>'validateRequired validateCEP','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bairro',array('class'=>'validadeRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cidade',array('class'=>'validadeRequired','id'=>'cidade','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('estado_id',array('class'=>'validadeRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('login',array('class'=>'validadeRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('senha',array('class'=>'validadeRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('user_id',array('class'=>'validadeRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('ativo',array('type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
</div>
