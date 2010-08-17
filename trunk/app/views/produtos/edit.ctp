<script src="<?php echo $this->webroot;?>js/jquery.price_format.1.3.js" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>js/jquery-1.2.6.pack" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $('.moeda').priceFormat({
            prefix: 'R$',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });

    });

    $(document).ready(function(){
        $('#cubagem').mask("9,99999");
        $('#desconto_por_pacote').mask("99,99");

        reload();

        $().ajaxStart(function() {
            $('#dialog').html("<div style='text-align:center;' ><img src='<?php echo $this->webroot;?>/img/ajax-loader.gif'/></div>");
            $('#dialog').dialog('open');
        });

        $().ajaxStop(function() {
            $('#dialog').dialog('close');
            reload();
        });
    });

    function reload(){
        $('.excluirImg').click(function(){
            excluirImagem($(this).attr('value'));
        });

        $("#novoArquivo").click(function(){
            $('<br><input type="file" id="Imagem" />').appendTo('#arquivo');
            $("input[id^='Imagem']").each(function(i, val) {
                val.id = 'Imagem'+(i);
                val.name = 'data[Imagem]['+(i)+']';
            });
        });

        $("#next1").click(function () {$('#tabpanel').tabs('option', 'selected', 1)});
    }

    function excluirImagem(id){
        idProduto = "<?php echo $this->data['Produto']['id']; ?>";
        $.ajax({
            type: "get",
            url: '<?php echo $this->webroot;?>ajax/delete_imagem_for_produto/'+id+'/'+idProduto,
            success: function(msg){
                if(msg != ''){
                    $('#flashMessage').html('A Imagem foi excluída com sucesso!');
                    $('#msginfo').fadeIn(500);
                    setTimeout("$('#msginfo').fadeOut(500)",4000);
                    $("#tab2").html(msg);
                }
                else{
                    $('#flashMessage').html('Erro ao tentar excluir a Imagem, Tente novamente.');
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
            <a href="#tab1"><span><?php echo __("Editar Produto",true) ?></span></a>
        </li>
        <li>
            <a href="#tab2"><span><?php echo __("Imagem",true) ?></span></a>
        </li>
    </ul>
    <?php echo $form->create('Produto', array('type'=>'file'));?>
    <div id="tab1">
        <? if(!empty($jquery->validationErrors)) { ?>
        <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <br>
                <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <?
                    if ($session->check('Message.flash')) {
                        $session->flash();
                        echo "<br>";
                    }
                    foreach($jquery->validationErrors as $model) {
                        foreach($model as $campo=>$valor) {
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
            echo $jquery->input('codigo',array('class'=>'validateRequired validateNumeric','label'=>'Código*','alt'=>'Código','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('descricao',array('class'=>'validateRequired', 'label'=>'Descrição*', 'alt'=>'Descrição','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('grupo_id',array('empty'=>'Selecione','class'=>'validateRequired', 'label'=>'Grupo*', 'alt'=>'Grupo','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));

            echo $jquery->input('pacote',array('type'=>'hidden','name'=>'data[Preco][0][pacote]','value'=>$this->data['Preco'][0]['pacote'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('pacote',array('name'=>'data[Preco][1][pacote]','value'=>$this->data['Preco'][0]['pacote'], 'class'=>'validateRequired validateNumeric', 'label'=>'Pacote*', 'alt'=>'Pacote','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));

            echo $jquery->input('caixa',array('class'=>'validateRequired validateNumeric', 'label'=>'Caixa*', 'alt'=>'Caixa','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('peso_bruto',array('class'=>'validateRequired validateNumeric', 'label'=>'Peso Bruto*', 'alt'=>'Peso Bruto','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('peso_liquido',array('class'=>'validateRequired validateNumeric', 'label'=>'Peso Líquido*', 'alt'=>'Peso Líquido','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('cubagem',array('label'=>'Cubagem*','id'=>'cubagem','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));

            echo $jquery->input('preco',array('type'=>'hidden','name'=>'data[Preco][0][preco]','value'=>$this->data['Preco'][0]['preco'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('preco_id',array('type'=>'hidden','name'=>'data[Preco][0][id]','value'=>$this->data['Preco'][0]['id'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));

            echo $jquery->input('preco',array('class'=>'moeda','name'=>'data[Preco][1][preco]','value'=>$this->data['Preco'][0]['preco'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('preco_ativo',array('type'=>'hidden','name'=>'data[Preco][1][ativo]','value'=>$this->data['Preco'][0]['ativo'],'label'=>'Preço*','id'=>'preco','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));


            echo $jquery->input('desconto_por_pacote',array('type'=>'hidden','name'=>'data[Preco][0][desconto_por_pacote]','value'=>'R$'.number_format($this->data['Preco'][0]['desconto_por_pacote'],2,',','.'),'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('desconto_por_pacote',array('label'=>'Desconto Pacote (%)*','class'=>'moeda','name'=>'data[Preco][1][desconto_por_pacote]','value'=>$this->data['Preco'][0]['desconto_por_pacote'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));

            echo $jquery->input('obs',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('ativo',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            ?>
            <tr><td class="left"></td><td class="right"><input type="button" id="next1" value="Continuar" style="font-size:11px" class="formbtn btn_salvar"></td>
            </tr>
        </table>

    </div>

    <div id="tab2">
        <table cellspacing="0" class="details">
            <?php echo $jquery->input('Imagem.0',array('type'=>'file','label'=>'','error' => false,'div'=>false,'before' => '<tr><td class="left">Arquivo','after' => '</td></tr>','between' => '</td><td class="right" id="arquivo">'));?>
            <tr><td class="left"><a id="novoArquivo" href="#" class="linkbutton linkbtn btn_add" style="background-position: 50%"></a></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td></tr>
        </table>

        <table cellspacing="0" class="details" align="center">
            <?php if(isset($this->data['Imagem'])){
                foreach ($this->data['Imagem'] as $key => $value) {
                    if(($key)%3 == 0 || $key == 0)
                        echo "<tr>";
                    echo "<td align='center'>".$html->image('/img_produtos/'.$value['nome'], array('align'=>'center','height'=>'130px', 'margin'=>'3px'))."";
                    echo " <a value='".$value['id']."' class='excluirImg linkbutton linkbtn btn_delete' style='background-position: 50%'></a></td>";
                    if(($key)%3 == 0 || $key == 0)
                        echo "<tr>";
                }
            }
            ?>
        </table>
    </div>
    <?php echo $form->end();?>
</div>
