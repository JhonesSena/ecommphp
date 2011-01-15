

<script type="text/javascript">
    $(function(){
//        $('#tabpanel').tabs();
    });
</script>

<?php ?>
<div class="div_miolo">
<div class="div_migalha_de_pao"><div class="div_linhas_a-d"></div>
<span class="migalha_de_pao">Contato</span></div>
<div><img width="100px" height="6px" src="../images/1x18px.gif"></div>
<div class="div_contato_1e3">      	</div>
	<div class="div_contato_5">
	  <br>


      <span class="titulo_azul">Fale com a gente!</span>

     <br>
     <br>
     <br>
     <?php if(!empty($empresa['ContatosEmpresa'])):
         foreach ($empresa['ContatosEmpresa'] as $key => $contato):?>
            <strong><?=$contato['tipo']?>:</strong> <?=$contato['valor']?><br>
            <br>
         <?php endforeach;
     endif;
     ?>
     <?=$empresa['Empresa']['nome']?>
     <br>
   <?=$empresa['Empresa']['logradouro']?><br>
   <?php if(!empty($empresa['Empresa']['cidade'])) echo $empresa['Empresa']['cidade']."/".$empresa['Estado']['nome'];?>
   <br><?=$empresa['Empresa']['cep']?><br>
<br>
<br>
       <br>

	</div>
	<div class="div_contato_1e3">   	</div>
    <div class="div_contato_4">      	</div>
    <div class="div_contato_1e3">   	</div>

  <div class="div_contato_2"><br>
  <span class="titulo_azul">Mande um email!</span><br>
  <br><br>
      <?php echo $form->create('Contato');?>
      <table cellspacing="0" class="details">
      <?php
		echo $jquery->input('nome',array('class'=>'validateRequired', 'alt'=>'Nome', 'label'=>'Nome*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('email',array('class'=>'validateRequired validateEmail', 'alt'=>'Email', 'label'=>'Email*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('cidade',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('estado',array('empty'=>'selecione','type'=>'select','options'=>$estados,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('telefone',array('class'=>'validateTelefone', 'alt'=>'Telefone', 'label'=>'Telefone','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('celular',array('class'=>'validateTelefone', 'alt'=>'Celular', 'label'=>'Celular','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('assunto',array('empty'=>'Selecione','type'=>'select','options'=>$assuntos,'class'=>'validateRequired', 'alt'=>'Assunto', 'label'=>'Assunto*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('mensagem',array('type'=>'textarea','class'=>'validateRequired', 'alt'=>'Mensagem', 'label'=>'Mensagem*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
        ?>
      <tr><td class="left">
                <?php echo $form->submit(__('Enviar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?>
          </td><td class="right">
                <input type="reset" style="font-size:11px;" value="Limpar" name="Limpar" class="formbtn btn_delete">
          </td>
      </table>
      <?php echo $form->end();?>
</div>

</div>