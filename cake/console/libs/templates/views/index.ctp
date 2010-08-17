<script src="<?php echo '<?php echo $this->webroot;?>' ?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<?php echo '<?php echo $this->webroot;?>' ?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo '<?php echo $this->webroot;?>' ?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">            
    $(document).ready(function(){
        //$(".tablesorter").tablesorter(); //criar ordenação no grid
    });
</script>

<!-- ContextMenu -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.ctxmenu').contextMenu('contextMenuList', {
            bindings: {
                'view': function(t) {
                    location.href="<?php echo '<?php echo $html->url(array(\'action\'=>\'view\'))?>' ?>/"+t.id;
                },
                'edit': function(t) {
                    location.href="<?php echo '<?php echo $html->url(array(\'action\'=>\'edit\'))?>' ?>/"+t.id;
                },
                'delete': function(t) {
                    if(confirm("Deseja realmente apagar?")){
                        location.href="<?php echo '<?php echo $html->url(array(\'action\'=>\'delete\'))?>' ?>/"+t.id;
                    }
                }
            }
        });
    });
</script>

<script>
	function selecionados(){
		chs = $(".chk").get();
		saida = "";
		for(i=0;i<chs.length;i++){
			saida = chs[i].checked?saida+","+chs[i].value:saida;
		}
		return saida.substring(1,saida.length);
	}
	function selecionarTodos(){
		chs = $(".chk").get();
		saida = "";
		for(i=0;i<chs.length;i++){
			if(chs[i].checked){
				chs[i].checked=false;
			}else{
				chs[i].checked=true;
			}
		}
	}
</script>

<div class="toolbar">
	<?php echo '<?php echo $html->link(__(\'Novo '.$singularHumanName.'\',true), \'add\',array(\'class\'=>\'linkbutton linkbtn btn_add\')); ?>' ?>
	<a href="#" onclick="location.href='<?php echo '<?php echo $this->webroot;?>' ?>/<?php echo strtolower($pluralHumanName);?>/deleteselected/'+selecionados()" class="linkbutton linkbtn btn_delete">Excluir Vários</a>
	<?php echo '
	<?
	$total = $paginator->counter(array(\'format\' => \'%pages%\', true));
	if($total!=1){
		echo "&nbsp;";
		$ant  = $paginator->current()-1; 
		$prox = $paginator->current()+1;

		$sort = isset($paginator->params[\'named\'][\'sort\'])?\'/sort:\'. $paginator->params[\'named\'][\'sort\']:"";
		$direction = isset($paginator->params[\'named\'][\'direction\'])?\'/direction:\'. $paginator->params[\'named\'][\'direction\']:"";

		echo $html->link(__(null,true), \'index/page:\'.$ant.$sort.$direction,array(\'class\'=>\'linkbutton linkbtn btn_back\'))."&nbsp;";
		echo \'<select style="height:22px;font-size:13px" onchange="location.href=\\\'\'. $this->webroot.\'cargos/index/page:\\\'+this.value+\\\'\'.$sort.$direction.\'\\\'">\';
		for($x=1;$x<=$total;$x++){
			echo $x==$paginator->current()?"<option selected value=\"$x\">".$x."</option>":"<option value=\"$x\">".$x."</option>";
		}
		echo "</select>&nbsp;";
		echo $html->link(__(null,true), \'index/page:\'.$prox.$sort.$direction,array(\'class\'=>\'linkbutton linkbtn btn_go\'));
	}
	?>
	' ?>
</div>


<div class="contextMenu" id="contextMenuList">
    <ul style="font-size:12px">
      <li id="view"><img src="<?php echo '<?php echo $this->webroot;?>' ?>css/img/visualizar.gif"/>Visualizar</li>
      <li id="edit"><img src="<?php echo '<?php echo $this->webroot;?>' ?>css/img/edit.gif"/>Editar</li>
      <li id="delete"><img src="<?php echo '<?php echo $this->webroot;?>' ?>css/img/delete.gif"/>Excluir</li>
    </ul>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?echo '<?php echo __("Listar '.$pluralHumanName.'",true) ?>'?></span></a></li>
    </ul>
    <div id="tab1">

        <table id="myTable" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
				    <th align="center" style="width:20px;padding: 0px 0px 0px 0px"><input type="checkbox" onclick="selecionarTodos()"></th>
                    <?php  foreach ($fields as $field):?>
                    <th><?php echo "<?php echo \$paginator->sort('{$field}');?>";?></th>
                    <?php endforeach;?>
                </tr>
            </thead> 
            <tfoot> 
                <tr>
					<th style="width:20px"></th>
                    <?php  foreach ($fields as $field):?>
                    <th><?php echo "<?php echo \$paginator->sort('{$field}');?>";?></th>
                    <?php endforeach;?>
                </tr>
            </tfoot> 
            <tbody> 
            <?php
            echo "<?php
            \$i = 0;
            foreach (\${$pluralVar} as \${$singularVar}):
                    \$class = null;
                    if (\$i++ % 2 == 0) {
                            \$class = ' class=\"altrow\"';
                    }
            ?>\n";
                    echo "\t<tr<?php echo \$class;?>>\n";


					echo "
						<td align=\"center\" style=\"padding: 0px 0px 0px 0px\">
							<input type=\"checkbox\" class=\"chk\" value=\"<?=\${$singularVar}['{$modelClass}']['{$primaryKey}']?>\">
						</td>
					";

                            foreach ($fields as $field) {
                                    $isKey = false;
                                    if(!empty($associations['belongsTo'])) {
                                            foreach ($associations['belongsTo'] as $alias => $details) {
                                                    if($field === $details['foreignKey']) {
                                                            $isKey = true;
                                                            /*echo "\t\t<td>\n\t\t\t<?php echo \$html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller'=> '{$details['controller']}', 'action'=>'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";*/
															echo "\t\t<td>\n\t\t\t<?php echo \${$singularVar}['{$alias}']['{$details['displayField']}']; ?>\n\t\t</td>\n";
                                                            break;
                                                    }
                                            }
                                    }
                                    if($isKey !== true) {
                                            //Igor Takenami - Se o campo for o displayfiled
                                            if($displayField==$field){
                                                                      
                                                echo "\t\t<td>\n\t\t\t<?php echo \$html->link(\${$singularVar}['{$modelClass}']['{$field}'], array('action'=>'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'ctxmenu','id'=>\${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n\t\t</td>\n";
                                            }else{
                                                echo "\t\t<td>\n\t\t\t<?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>\n\t\t</td>\n";
                                            }
                                    }
                            }
                    echo "\t</tr>\n";

            echo "<?php endforeach; ?>\n";
            ?>

            </tbody> 
        </table>
        
    </div>
</div>