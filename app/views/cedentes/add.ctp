
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

                
                $('.pessoaFisica').addClass('validateRequired');
                $('.pessoaJuridica').removeClass('validateRequired');
            }
            if($("#TipoPessoaJ").attr('checked')){
                $('.pessoaJuridica').attr('disabled', '');
                $('.pessoaFisica').fadeOut(0);
                $('.pessoaJuridica').fadeIn(1500);
                $('.pessoaFisica').attr('disabled', 'disabled');

                $('.pessoaJuridica').addClass('validateRequired');
                $('.pessoaFisica').removeClass('validateRequired');
            }
        });

    }
    
</script>

<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li>
			<a href="#tab1"><span><?php echo __("Novo Cedente",true) ?></span></a>
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
        <div style="margin-left: 155px;" align="left"><? echo $jquery->input('tipo_pessoa',array('name'=>'data[Cliente][tipo_pessoa]','id'=>'tipo_pessoa','type'=>'radio', 'legend'=>false, 'label'=>'Cliente', 'options'=>$tipoCliente, 'value'=>'f','error' => false,'div'=>false));?></div>
        <table cellspacing="0" class="details">
        	<?php
		echo $jquery->input('conta_corrente',array('class'=>'validateRequired','alt'=>'Conta Corrente','label'=>'Conta Corrente*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('agencia_id',array('class'=>'validateRequired','alt'=>'Agência','label'=>'Agência*','empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bloqueto_id',array('class'=>'validateRequired','alt'=>'Bloqueto','label'=>'Bloqueto*', 'empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('nome',array('class'=>'validateRequired', 'label'=>'Nome*','alt'=>'Nome','name'=>'data[Cliente][nome]','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('nome_fantasia',array('class'=>'validateRequired', 'label'=>'Nome Fantasia*','alt'=>'Nome Fantasia','name'=>'data[PessoaJuridica][nome_fantasia]', 'label'=>'Nome Fantasia*','class'=>'validateRequired','alt'=>'Nome Fantasia','error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cnpj',array('class'=>'validateRequired','alt'=>'CNPJ','label'=>'CNPJ*','name'=>'data[PessoaJuridica][cnpj]','class'=>'validateRequired validateCNPJ','alt'=>'CNPJ', 'label'=>'CNPJ*','error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('PessoaJuridica.ativo',array('type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr class="pessoaFisica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cpf',array('class'=>'validateRequired validateCPF','alt'=>'CPF', 'label'=>'CPF*','name'=>'data[PessoaFisica][cpf]','error' => false,'div'=>false,'before' => '<tr class="pessoaFisica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('PessoaFisica.ativo',array('type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr class="pessoaFisica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('telefone',array('class'=>'validateRequired validateTelefone','alt'=>'Telefone', 'label'=>'Telefone*','name'=>'data[Cliente][telefone]','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('email',array('class'=>'validateRequired validateEmail','alt'=>'Email', 'label'=>'Email*','name'=>'data[Cliente][email]', 'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('logradouro',array('class'=>'validateRequired','alt'=>'Logradouro', 'label'=>'Logradouro*','name'=>'data[Cliente][logradouro]','type'=>'textarea','rows'=>3,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cep',array('class'=>'validateRequired validateCEP','alt'=>'Cep', 'label'=>'Cep*','name'=>'data[Cliente][cep]','id'=>'cep','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bairro',array('class'=>'validateRequired','alt'=>'Bairro', 'label'=>'Bairro*','name'=>'data[Cliente][bairro]','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cidade',array('class'=>'validateRequired','id'=>'cidade','alt'=>'Cidade', 'label'=>'Cidade*','name'=>'data[Cliente][cidade]','id'=>'cidade','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('estado_id',array('class'=>'validateRequired','alt'=>'Estado', 'label'=>'Estado*','name'=>'data[Cliente][estado_id]','id'=>'estados', 'empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('ativo',array('name'=>'data[Cliente][ativo]','type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
</div>
