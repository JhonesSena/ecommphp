<?php echo $jquery->init_date('pt-br','01/01/2000'); ?>
<script src="<?php echo $this->webroot;?>js/jquery.price_format.1.3.js" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>js/jquery-1.2.6.pack" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>


<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $('#preco').priceFormat({
            prefix: 'R$',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });

        $("#novoArquivo").click(function(){
            $('<br><input type="file" id="Imagem" />').appendTo('#arquivo');
            $("input[id^='Imagem']").each(function(i, val) {
                val.id = 'Imagem'+(i);
                val.name = 'data[Imagem]['+(i)+']';
            });
        });

        $("#next1").click(function () {$('#tabpanel').tabs('option', 'selected', 1)});
    });

    $(document).ready(function(){
        $('#cubagem').mask("9,99999");
        $('#desconto_por_pacote').mask("99,99");
    });
</script>

<div class="toolbar">
    <?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li>
            <a href="#tab1"><span><?php echo __("Novo Produto",true) ?></span></a>
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
            echo $jquery->input('codigo',array('class'=>'validateRequired validateNumeric','label'=>'Código*','alt'=>'Código','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('descricao',array('class'=>'validateRequired', 'label'=>'Descrição*', 'alt'=>'Descrição','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('grupo_id',array('empty'=>'Selecione','class'=>'validateRequired', 'label'=>'Grupo*', 'alt'=>'Grupo','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('pacote',array('name'=>'data[Preco][pacote]','class'=>'validateRequired validateNumeric', 'label'=>'Pacote*', 'alt'=>'Pacote','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('caixa',array('class'=>'validateRequired validateNumeric', 'label'=>'Caixa*', 'alt'=>'Caixa','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('peso_bruto',array('class'=>'validateRequired validateNumeric', 'label'=>'Peso Bruto*', 'alt'=>'Peso Bruto','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('peso_liquido',array('class'=>'validateRequired validateNumeric', 'label'=>'Peso Líquido*', 'alt'=>'Peso Líquido','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('cubagem',array('label'=>'Cubagem*','id'=>'cubagem','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('preco',array('name'=>'data[Preco][preco]','label'=>'Preço*','id'=>'preco','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('desconto_por_pacote',array('name'=>'data[Preco][desconto_por_pacote]','label'=>'Desconto Pacote (%)*','id'=>'desconto_por_pacote','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('obs',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('ativo',array('type'=>'hidden', 'value'=>1,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            ?>
            <tr><td class="left"></td><td class="right"><input type="button" id="next1" value="Continuar" style="font-size:11px" class="formbtn btn_salvar"></td>
            </tr>
        </table>

    </div>

    <div id="tab2">
        <table cellspacing="0" class="details">
            <?php echo $jquery->input('Imagem.0',array('type'=>'file','label'=>'','error' => false,'div'=>false,'before' => '<tr><td class="left">Arquivo','after' => '</td></tr>','between' => '</td><td class="right" id="arquivo">'));?>

            <tr><td class="left"><a id="novoArquivo" href="#" class="linkbutton linkbtn btn_add" style="background-position: 50%"></a></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
            </tr>

        </table>
    </div>
    <?php echo $form->end();?>
</div>
