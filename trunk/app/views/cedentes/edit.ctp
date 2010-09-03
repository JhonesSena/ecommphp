

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $('#cep').blur(function(){
            if($(this).val() != '__.___-___' && $('#cep').val() != '')
               validaCep($(this).val());
        });

        $("input[id^='TipoPessoa']").click(function(){
            analisaTipoPessoa();
        });
    });

    $(document).ready(function(){

        if($('#cep').val() != '__.___-___' && $('#cep').val() != '')
           validaCep($('#cep').val());

        analisaTipoPessoa();
//        if($(this).attr('value') == 'f'){
//            $('.pessoaFisica').attr('disabled', '');
//            $('.pessoaJuridica').fadeOut(1000);
//            $('.pessoaFisica').fadeIn(1000);
//            $('.pessoaJuridica').attr('disabled', 'disabled');
//            $('.pessoaJuridica').attr('value', '');
//        }
//        else if($(this).attr('value') == 'j'){
//            $('.pessoaJuridica').attr('disabled', '');
//            $('.pessoaFisica').fadeOut(1000);
//            $('.pessoaJuridica').fadeIn(1000);
//            $('.pessoaFisica').attr('disabled', 'disabled');
//            $('.pessoaFisica').attr('value', '');
//        }
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
                $("#estados").attr('readonly', '');
                $("#cidade").attr('readonly', '');
                var result = eval(json);
                if(result['webservicecep']['resultado'] > 0){
                    $("#cidade").val(result['webservicecep']['cidade']);
                    $("#validaCep").val(result['webservicecep']['resultado']);
                    $("select[id='estados'] option[value='"+result['webservicecep']['estado']+"']").attr('selected', true);
                    $("#estados").attr('readonly', 'readonly');
                    $("#cidade").attr('readonly', 'readonly');
                }
                else{
                    $("select[id='estados'] option[value='']").attr('selected', true);
                    $('#flashMessage').html("O CEP digitado é inválido.");
                    $('#msginfo').fadeIn(500);
                    setTimeout("$('#msginfo').fadeOut(500)",4000);
                }

            }
        });
    }

    function analisaTipoPessoa(){

        $("input[id^='TipoPessoa']").each(function(){
            if($("#TipoPessoaF").attr('checked')){
                $('.pessoaFisica').attr('disabled', '');
                $('.pessoaJuridica').fadeOut(0);
                $('.pessoaFisica').fadeIn(1500);
                $('.pessoaJuridica').attr('disabled', 'disabled');
            }
            if($("#TipoPessoaJ").attr('checked')){
                $('.pessoaJuridica').attr('disabled', '');
                $('.pessoaFisica').fadeOut(0);
                $('.pessoaJuridica').fadeIn(1500);
                $('.pessoaFisica').attr('disabled', 'disabled');
            }
        });

    }
</script>

<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li>
			<a href="#tab1"><span><?php echo __("Editar Cedente",true) ?></span></a>
			</li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('Cedente');?>
		
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
        <div style="margin-left: 155px;" align="left"><? echo $jquery->input('tipo_pessoa',array('name'=>'data[Cliente][tipo_pessoa]','id'=>'tipo_pessoa','type'=>'radio', 'legend'=>false, 'label'=>'Cliente', 'options'=>$tipoCliente, 'value'=>$tipoPessoa,'error' => false,'div'=>false));?></div>
        <table cellspacing="0" class="details">
        	<?php
		echo $jquery->input('id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('conta_corrente',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('agencia_id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bloqueto_id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));

                echo $jquery->input('cliente_id',array('name'=>'data[Cliente][id]', 'value'=>$this->data['Cliente']['id'], 'type'=>'hidden','class'=>'validadeRequired', 'label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('nome',array('name'=>'data[Cliente][nome]', 'value'=>$this->data['Cliente']['nome'],'class'=>'validadeRequired', 'label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('nome_fantasia',array('name'=>'data[PessoaJuridica][nome_fantasia]','value'=>$this->data['PessoaJuridica']['nome_fantasia'], 'label'=>'Nome Fantasia*','class'=>'validadeRequired','alt'=>'Nome Fantasia','error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cnpj',array('name'=>'data[PessoaJuridica][cnpj]','value'=>$this->data['PessoaJuridica']['cnpj'],'class'=>'validadeRequired validateCNPJ','alt'=>'CNPJ', 'label'=>'CNPJ*','error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cpf',array('name'=>'data[PessoaFisica][cpf]','value'=>$this->data['PessoaFisica']['cpf'],'class'=>'validadeRequired validateCPF','alt'=>'CPF', 'label'=>'CPF*','error' => false,'div'=>false,'before' => '<tr class="pessoaFisica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('telefone',array('name'=>'data[Cliente][telefone]','value'=>$this->data['Cliente']['telefone'],'class'=>'validadeRequired validateTelefone','alt'=>'Telefone', 'label'=>'Telefone*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('email',array('name'=>'data[Cliente][email]','value'=>$this->data['Cliente']['email'],'class'=>'validadeRequired validateEmail','alt'=>'Email', 'label'=>'Email*', 'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('logradouro',array('name'=>'data[Cliente][logradouro]','value'=>$this->data['Cliente']['logradouro'],'type'=>'textarea','rows'=>3,'class'=>'validadeRequired','alt'=>'Logradouro', 'label'=>'Logradouro*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cep',array('name'=>'data[Cliente][cep]','value'=>$this->data['Cliente']['cep'],'id'=>'cep','class'=>'validateRequired validateCEP','alt'=>'Cep', 'label'=>'Cep*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bairro',array('name'=>'data[Cliente][bairro]','value'=>$this->data['Cliente']['bairro'],'class'=>'validadeRequired','alt'=>'Bairro', 'label'=>'Bairro*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cidade',array('name'=>'data[Cliente][cidade]','value'=>$this->data['Cliente']['cidade'],'id'=>'cidade','class'=>'validadeRequired','id'=>'cidade','alt'=>'Cidade', 'label'=>'Cidade*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('estado_id',array('name'=>'data[Cliente][estado_id]','value'=>$this->data['Cliente']['estado_id'], 'options'=>$estados,'id'=>'estados','class'=>'validadeRequired','alt'=>'Estado', 'label'=>'Estado*', 'empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
</div>
