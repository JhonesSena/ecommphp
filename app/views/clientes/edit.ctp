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

        $("form").submit(function(){
            return validateFields();
        });
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

    function validateFields(){
        $('#msgerroData').remove();
        var retorno = true;
        var string = "<ul id='msgerroData' style='margin-top:1px;margin-bottom: 1px;'>";

        if($("#TipoPessoaF").attr('checked')){
            if($("#cpf").val()==''||$("#cpf").val()=='___.___.___-__')
            {
                string += "<li>CPF é campo obrigatório.</li>";
                retorno = false;
            }
        }

        if($("#TipoPessoaJ").attr('checked')){
            if($("#nomeFantasia").val()=='')
            {
                string += "<li>Nome Fantasia é campo obrigatório.</li>";
                retorno = false;
            }

            if($("#cnpj").val()==''||$("#cnpj").val()=='___.___.___/____-__')
            {
                string += "<li>CNPJ é campo obrigatório.</li>";
                retorno = false;
            }
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
<?php //echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?>
</div>

<div id="tabpanel">
    <ul>
        <li>
			<a href="#tab1"><span><?php echo __("Editar Cliente",true) ?></span></a>
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
        <div style="margin-left: 155px;" align="left"><? echo $jquery->input('tipo_pessoa',array('id'=>'tipo_pessoa','type'=>'radio', 'legend'=>false, 'label'=>'Cliente', 'options'=>$tipoCliente, 'value'=>$selectPessoa,'error' => false,'div'=>false));?></div>
        <table cellspacing="0" class="details">
        	<?php
		echo $jquery->input('id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('nome',array('class'=>'validateRequired', 'label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('pessoaJuridicaId',array('type'=>'hidden','name'=>'data[PessoaJuridica][id]','value'=>$this->data['PessoaJuridica']['id'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('nome_fantasia',array('id'=>'nomeFantasia','name'=>'data[PessoaJuridica][nome_fantasia]','value'=>$this->data['PessoaJuridica']['nome_fantasia'], 'label'=>'Nome Fantasia*','error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cnpj',array('id'=>'cnpj','name'=>'data[PessoaJuridica][cnpj]','value'=>$this->data['PessoaJuridica']['cnpj'],'class'=>'validateCNPJ','alt'=>'CNPJ', 'label'=>'CNPJ*','error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('pessoaFisicaId',array('type'=>'hidden','name'=>'data[PessoaFisica][id]','value'=>$this->data['PessoaFisica']['id'],'error' => false,'div'=>false,'before' => '<tr class="pessoaJuridica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cpf',array('id'=>'cpf','name'=>'data[PessoaFisica][cpf]','value'=>$this->data['PessoaFisica']['cpf'],'class'=>'validateCPF','alt'=>'CPF', 'label'=>'CPF*','error' => false,'div'=>false,'before' => '<tr class="pessoaFisica"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('telefone',array('class'=>'validateRequired validateTelefone','alt'=>'Telefone', 'label'=>'Telefone*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('email',array('class'=>'validateRequired validateEmail','alt'=>'Email', 'label'=>'Email*', 'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('logradouro',array('type'=>'textarea','rows'=>3,'class'=>'validateRequired','alt'=>'Logradouro', 'label'=>'Logradouro*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cep',array('id'=>'cep','class'=>'validateRequired validateCEP','alt'=>'Cep', 'label'=>'Cep*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('bairro',array('class'=>'validateRequired','alt'=>'Bairro', 'label'=>'Bairro*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('cidade',array('id'=>'cidade','class'=>'validateRequired','id'=>'cidade','alt'=>'Cidade', 'label'=>'Cidade*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('estado_id',array('id'=>'estados','class'=>'validateRequired','alt'=>'Estado', 'label'=>'Estado*', 'empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('User.id',array('class'=>'validateRequired user', 'type'=>'hidden', 'value'=>$this->data['User']['id'], 'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('User.password',array('type'=>'password', 'value'=>'', 'label'=>'Senha','error' => false,'div'=>false,'before' => '<tr class="user"><td class="left">','after' => '<b style="color:blue"> Preencha o campo senha apenas se necessário.</b></td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('redigite_senha',array('id'=>'confirmaSenha','value'=>'', 'type'=>'password', 'label'=>'Confirmação Senha','error' => false,'div'=>false,'before' => '<tr class="user"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('ativo',array('type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
	?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
</div>
