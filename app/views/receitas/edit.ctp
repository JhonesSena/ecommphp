<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.jstree/jquery.tree.js"></script>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
        $("#arvoreReceita").tree({
            callback : {
                onmove : function (NODE,REF_NODE,TYPE,TREE_OBJ,RB) {
                    $.tree.rollback(RB);
                }
            },
            types : {
                "default" : {
                    clickable	: true,
                    renameable	: false,
                    deletable	: false,
                    creatable	: false,
                    draggable	: false,
                    max_children	: -1,
                    max_depth	: -1,
                    valid_children	: "all"
                },
                "item" : {
                    draggable : false,
                    deletable : false,
                    valid_children : ["subitem"],
                    icon : {
                        image : $("#webroot").val()+"js/jquery.jstree/item.gif"
                    }
                },
                "subitem" : {
                    valid_children : ["subitem"],
                    icon : {
                        image : $("#webroot").val()+"js/jquery.jstree/subitem.gif"
                    }
                }
            }
        });

//        $("#FormItemReceita").submit(function(){
//            salvarItemReceita(this);
//            return false;
//        });

    });
    $(document).ready(function(){
         
    });

    function salvarItemReceita(form){
        $.ajax({
            type:"post",
            async: true,
            data: $(form).serialize(),
            url:$("#webroot").val()+"ajax/salvarItemReceita/"+"<?=$this->data["Receita"]['id'];?>",
            success:function(msg)
            {
                if(parseInt(msg)== 1){
                    $('#flashMessage').html("O Custo foi salvo com sucesso!");
                    $('#msginfo').fadeIn(500);
                    setTimeout("$('#msginfo').fadeOut(500)",4000);
                }else{
                    $('#flashMessage').html("A operação não pode ser concluída, Verifique os problemas e tente novamente.");
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
        <li><a href="#tab1"><span><?php echo __("Editar Receita",true) ?></span></a></li>
        <li><a href="#tab2"><span><?php echo __("Passo a Passo",true) ?></span></a></li>
        <li><a href="#tab3"><span><?php echo __("Alterar Sequência",true) ?></span></a></li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('Receita');?>
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
                echo $jquery->input('nome',array('class'=>'validateRequired','label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('descricao',array('type'=>'textarea','class'=>'validateRequired','label'=>'Descrição*','alt'=>'Descrição','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('ativo',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
        ?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
    <div id="tab2">
        <?php echo $form->create('Receita', array('type'=>'file','url'=>array('action' => 'salvarItemReceita')));?>
            <table cellspacing="0" class="details">
                
                    <?php
                    echo $jquery->input('ItemReceita.nome',array('class'=>'validateRequired','label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                    echo $jquery->input('ItemReceita.descricao',array('type'=>'textarea','class'=>'validateRequired','label'=>'Descrição*','alt'=>'Descrição','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                    echo $jquery->input('ItemReceita.imagem',array('class'=>'validateRequired','label'=>'Imagem*','alt'=>'Imagem','type'=>'file','label'=>'','error' => false,'div'=>false,'before' => '<tr><td class="left">Imagem*','after' => '</td></tr>','between' => '</td><td class="right">'));
            ?>
            <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                    </tr>
            </table>
        <?php echo $form->end();?>
    </div>
    <div id="tab3" style="min-height: 200px;">
        <table>
            <tr>
                <td>
                    <div id="arvoreReceita" style="min-width:200px">
                        <?=$this->element('tree_receita',array('itensReceita'=>$itensReceita, 'nomeReceita'=>$this->data['Receita']['nome']));?>
                    </div>
                </td>
                <td>
                    
                </td>
            </tr>
        </table>
        
    </div>
</div>
