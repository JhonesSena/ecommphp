<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.jstree/jquery.tree.js"></script>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
        $("#arvoreReceita").tree();

        $("#FormItemReceita").submit(function(){
            salvarItemReceita(this);
            return false;
        });

    });
    $(document).ready(function(){
        
    });

    function salvarItemReceita(form){
        
    }
</script>
<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Editar Receita",true) ?></span></a></li>
        <li><a href="#tab2"><span><?php echo __("Passo à Passo",true) ?></span></a></li>
	
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
        <?php echo $form->create('Receita', array('id'=>'FormItemReceita','action'=>'/ajax/salvarItemReceita'));?>
            <table cellspacing="0" class="details">
                <tr>
                    <td class="left"></td>
                    <td class="right">
                        <div id="arvoreReceita" style="min-width:200px">
                            <?=$this->element('tree_receita',array('receita'=>$this->data));?>
                        </div>
                    </td>
                </tr>
                    <?php
                    echo $jquery->input('ItemReceita.nome',array('class'=>'validateRequired','label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                    echo $jquery->input('ItemReceita.descricao',array('class'=>'validateRequired','label'=>'Descrição*','alt'=>'Descrição','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                    echo $jquery->input('ItemReceita.imagem',array('class'=>'validateRequired','label'=>'Imagem*','alt'=>'Imagem','type'=>'file','label'=>'','error' => false,'div'=>false,'before' => '<tr><td class="left">Imagem*','after' => '</td></tr>','between' => '</td><td class="right">'));
            ?>
            <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                    </tr>
            </table>
        <?php echo $form->end();?>
    </div>
</div>
