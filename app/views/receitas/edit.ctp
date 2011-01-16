<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.jstree/jquery.tree.js"></script>
<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
        $("#arvoreReceita").tree({
            callback : {
                onmove : function (NODE,REF_NODE,TYPE,TREE_OBJ,RB) {
                    parent = TREE_OBJ.parent(NODE);
                    if(parent == -1){
                        $('#flashMessage').html("Não é possível mover para este nível.");
                        $('#msginfo').fadeIn(500);
                        setTimeout("$('#msginfo').fadeOut(500)",4000);
                        $('html, body').animate({scrollTop: 0});
                        $.tree.rollback(RB);
                        return;
                    }
                    var children = TREE_OBJ.children(parent);
                    vetor = new Array();
                    $.each(children, function(i,child){
                       vetor[i] = $(child).attr('id')+";"+i;
                    });
                    
                    
                    if(updateSequencia(arr2jsonToBase64(vetor))==false){
                        $('#flashMessage').html("Não foi possível alterar sequência do passo a passo.");
                        $('#msginfo').fadeIn(500);
                        setTimeout("$('#msginfo').fadeOut(500)",4000);
                        $('html, body').animate({scrollTop: 0});
                        $.tree.rollback(RB);
                    }
                },
                ondblclk : function(NODE, TREE_OBJ, EV) {
                    TREE_OBJ.toggle_branch.call(TREE_OBJ, NODE);
                    TREE_OBJ.select_branch.call(TREE_OBJ, NODE);


                    obj = TREE_OBJ.get_node(NODE);
                    $("#idItem").val($(obj).attr('id'));
                    $("#nomeItem").val($(obj).attr('nome'));
                    $("#descricaoItem").val($(obj).attr('descricao'));
                    $(".editar").show();
                    $("#salvar").attr('value','Salvar Alterações');
                    $("#imagemItem").attr('disabled','disabled');
                    if($(obj).attr('imagem')!=undefined){
                        $("#trArquivoImagem").hide();
                        $("#trImagem").show();
                        $("#imagemItem").attr('disabled','disabled');
                        $("#mostraImagem").attr('src',($('#webroot').val()+'/img_receitas/'+$(obj).attr('imagem')));
                        $("#imgHide").val($(obj).attr('imagem'));
                    }else{
                        limparCampos();
                    }
                }
            },
            rule : {
                use_max_use_max_depth: false
            },
            types : {
                "default" : {
                    clickable	: false,
                    renameable	: false,
                    deletable	: true,
                    creatable	: false,
                    draggable	: false,
                    max_children	: -1,
                    max_depth	: 0,
                    valid_children	: "item"
                },
                "item" : {
                    max_children	: -1,
                    max_depth	: -1,
                    draggable : false,
                    deletable : false,
                    valid_children : ["subitem"],
                    icon : {
                        image : $("#webroot").val()+"js/jquery.jstree/item.gif"
                    }
                },
                "subitem" : {
                    clickable	: true,
                    draggable : true,
                    max_children	: 0,
                    valid_children : ["subitem"],
                    icon : {
                        image : $("#webroot").val()+"js/jquery.jstree/subitem.gif"
                    }
                }
            }
        });

        $("#limpar").click(function(){
            limparCampos();
        });

        $("#btn_excluir").click(function(){
            if(confirm("Deseja excluir o Item da Receita?")){
                window.location="<?php echo $html->url('/'.$this->params['controller'].'/excluirItemReceita/'.$this->data['Receita']['id'])?>/"+$("#idItem").val();
            }
        });

    });
    
    $(document).ready(function(){
        $('html, body').animate({scrollTop: 0});
        $("#imagemItem").val("");
        if($("#idItem").val()==""){
            $("#trImagem").hide();
            $(".editar").hide();
        }else{
            $("#trArquivoImagem").hide();
            $("#imagemItem").val("");
            $("#mostraImagem").attr('src',($('#webroot').val()+'/img_receitas/'+$("#imgHide").val()));
        }
    });

    function arr2jsonToBase64($arr){
        var $ret = '{';
        var $key,$chave,$val;
        for($key in $arr){
            $val = $arr[$key];
            $key = $key.replace("'","\\'");
            $val = $val.replace("'","\\'");

            if(isNaN($key)){
                $chave = "'" + $key + "'";
            }else{
                $chave=$key;
            }
            $ret += " " + $chave + ":'" + $val + "',";
        }
        $ret = $ret.substring(0,$ret.length-1);
        $ret += '}';
        $ret = $.base64Encode($ret);
        return $ret;
    }

    function updateSequencia(vetor){
        var receitaId = "<?=$this->data['Receita']['id']?>";
        var retorno = $.ajax({
            type: "get",
            async: false,
            url: $('#webroot').val() + 'ajax' +'/update_sequencia_receita/'+receitaId+'/'+vetor
        }).responseText;

        return retorno;
    };
    function limparCampos(){
        $("#idItem").val("");
        $("#nomeItem").val("");
        $("#descricaoItem").val("");
        $("#trArquivoImagem").show();
        $("#imagemItem").attr('disabled','');
        $("#trImagem").hide();
        $("#salvar").attr('value','Salvar');
        $(".editar").hide();
    }

//    function selecionados(){
//		chs = $(".chk").get();
//		saida = "";
//		for(i=0;i<chs.length;i++){
//			saida = chs[i].checked?saida+","+chs[i].value:saida;
//		}
//		return saida.substring(1,saida.length);
//	}
//	function selecionarTodos(){
//		chs = $(".chk").get();
//		saida = "";
//		for(i=0;i<chs.length;i++){
//			if(chs[i].checked){
//				chs[i].checked=false;
//			}else{
//				chs[i].checked=true;
//			}
//		}
//	}
</script>
<div class="toolbar">
<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?></div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Editar Receita",true) ?></span></a></li>
        <li><a href="#tab2"><span><?php echo __("Etapas",true) ?></span></a></li>
        <li><a href="#tab3"><span><?php echo __("Materiais",true) ?></span></a></li>
	
    </ul>
    <div id="tab1">
        <?php echo $form->create('Receita', array('type'=>'file'));?>
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
                echo $jquery->input('saudacao',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('modalidade',array('type'=>'textarea','class'=>'validateRequired','label'=>'Modalidade*','alt'=>'Modalidade','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
		echo $jquery->input('obs',array('type'=>'textarea','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                if(!empty($this->data['Receita']['imagem'])){
                    echo '<tr><td class="left">Imagem produto final</td><td class="right">';
                    echo $html->image('/img_receitas/'.$this->data['Receita']['imagem'], array('align'=>'center','height'=>'100px'));
                    echo $html->image('/css/img/delete.gif', array('url'=>array('controller'=>'receitas','action'=>'excluirImagem',$this->data['Receita']['id']),'border'=>'none','value'=>$this->data['Receita']['id'],'align'=>'center','height'=>'16px','width'=>'16px'));
                    echo '</td></tr>';
                    
                }else{
                    echo $jquery->input('imagem',array('type'=>'file','class'=>'validateRequired','label'=>'Imagem produto final*','alt'=>'Imagem produto final','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                }
                echo $jquery->input('ativo',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
        ?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
    </div>
    <div id="tab2" style="min-height: 200px;">
        <table>
            <tr>
                <td width="35%" valign="top">
                    <label style="font-weight: bold; color: #1D5987;">Clique duas vezes para editar</label>
                    <div id="arvoreReceita" style="min-width:200px; margin-top: 10px;">
                        <?=$this->element('tree_receita',array('itensReceita'=>$itensReceita, 'nomeReceita'=>$this->data['Receita']['nome']));?>
                    </div>
                </td>
                <td width="65%" valign="top">
                    <?php echo $form->create('Receita', array('type'=>'file','url'=>array('action' => 'salvarItemReceita')));?>
                        <table cellspacing="0" class="details">
                            
                                <?php
                                echo $jquery->input('ItemReceita.imgHide',array('id'=>'imgHide','type'=>'hidden','value'=>'','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                                echo $jquery->input('ItemReceita.id',array('id'=>'idItem','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                                echo $jquery->input('ItemReceita.nome',array('id'=>'nomeItem','class'=>'validateRequired','label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                                echo $jquery->input('ItemReceita.descricao',array('id'=>'descricaoItem','type'=>'textarea','class'=>'validateRequired','label'=>'Descrição*','alt'=>'Descrição','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                                echo $jquery->input('ItemReceita.imagem',array('id'=>'imagemItem','type'=>'file','label'=>'','error' => false,'div'=>false,'before' => '<tr id="trArquivoImagem"><td class="left">Imagem*','after' => '</td></tr>','between' => '</td><td class="right">'));
                                echo '<tr id="trImagem"><td class="left"></td><td class="right">'.$html->image('/img_receitas/x.jpg', array('id'=>'mostraImagem','align'=>'center','height'=>'100px')).'</td></tr>';
                        ?>
                        <tr><td class="left">
                                <input type="button" id="limpar" style="font-size:11px" class="formbtn btn_excluir editar" value="Limpar">
                            </td>
                            <td class="right">
                                <table>
                                    <td class="left">
                                        <input type="button" id="btn_excluir" style="font-size:11px" class="formbtn btn_delete editar" value="Excluir">
                                    </td>
                                    <td class="right">
                                        <?php echo $form->submit(__('Salvar',true),array('id'=>'salvar','style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?>
                                    </td>
                                </table>
                            </td>
                        </tr>
                        </table>
                    <?php echo $form->end();?>
                </td>
            </tr>
        </table>
        
    </div>

    <div id="tab3">
        <?php echo $form->create('Material',array('url'=>array('action' => 'add',$this->data['Receita']['id'])));?>
        <table cellspacing="0" class="details">
                <?php echo $jquery->input('nome',array('class'=>'validateRequired','label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));?>
        <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
        </table>
        <?php echo $form->end();?>
        <?php if(!empty($this->data['Material'])):?>
        <br/>
        
        <table id="myTable" class="tablesorter" cellspacing="1">
            <thead>
               <tr>
                    <th><?php echo __('Nome');?></th>
                    <th><?php echo __('Excluir');?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php echo __('nome');?></th>
                    <th><?php echo __('Excluir');?></th>
                </tr>
            </tfoot>
            <tbody>
            <?php
            $i = 0;
            foreach ($this->data['Material'] as $material):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $material['nome']; ?>
		</td>
		<td>
                        <?php echo $html->image("/css/img/delete.gif", array('border'=>'none',"alt" => "Excluir",
                               'url' => array('controller' => 'materiais', 'action' => 'delete', $material['id'],$this->data['Receita']['id']))); ?>

		</td>
	</tr>
<?php endforeach; ?>

            </tbody>
        </table>
        <?php endif;?>
    </div>
    
</div>
