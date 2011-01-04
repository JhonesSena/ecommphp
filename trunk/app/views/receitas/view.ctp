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
    });
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">            
    $(document).ready(function(){
        $(".tablesorter").tablesorter(); 
    });
</script>

<div class="toolbar">
		<?php echo $html->link(__('Editar', true), array('action'=>'edit', $receita['Receita']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
		<?php echo $html->link(__('Deletar', true), array('action'=>'delete', $receita['Receita']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $receita['Receita']['id'])); ?>
		<?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Receita",true) ?></span></a></li><li><a href="#tab2"><span>Item Receitas</span></a></li></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            		<tr><td class="left"><?php __('Id'); ?></td><td class="right">		
			<?php echo $receita['Receita']['id']; ?></td></tr>		<tr><td class="left"><?php __('Nome'); ?></td><td class="right">		
			<?php echo $receita['Receita']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Modalidade'); ?></td><td class="right">		
			<?php echo $receita['Receita']['modalidade']; ?></td></tr>		<tr><td class="left"><?php __('Obs'); ?></td><td class="right">		
			<?php echo $receita['Receita']['obs']; ?></td></tr>		<tr><td class="left"><?php __('Imagem'); ?></td><td class="right">		
			<?php echo $html->image('/img_receitas/'.$receita['Receita']['imagem'], array('align'=>'center','height'=>'100px'));?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">
			<?php if($receita['Receita']['ativo']==1) echo 'Sim';else echo 'Não'; ?></td></tr>
            
        </table>
    </div>
    
    
            
    <div id="tab2">
        <div id="arvoreReceita" style="min-width:200px">
            <?=$this->element('tree_receita',array('itensReceita'=>$receita['ItemReceita'], 'nomeReceita'=>$this->data['Receita']['nome']));?>
        </div>
    
    </div>
        
    
    
</div>
