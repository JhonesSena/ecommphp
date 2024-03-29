<script src="<?php echo $this->webroot;?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
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
                    location.href="<?php echo $html->url(array('action'=>'view'))?>/"+t.id;
                },
                'edit': function(t) {
                    location.href="<?php echo $html->url(array('action'=>'edit'))?>/"+t.id;
                },
                'delete': function(t) {
                    if(confirm("Deseja realmente apagar?")){
                        location.href="<?php echo $html->url(array('action'=>'delete'))?>/"+t.id;
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
	<?php if(empty($empresas)) echo $html->link(__('Nova Empresa',true), 'add',array('class'=>'linkbutton linkbtn btn_add')); ?>
	
	<?
	$total = $paginator->counter(array('format' => '%pages%', true));
	if($total!=1){
		echo "&nbsp;";
		$ant  = $paginator->current()-1; 
		$prox = $paginator->current()+1;

		$sort = isset($paginator->params['named']['sort'])?'/sort:'. $paginator->params['named']['sort']:"";
		$direction = isset($paginator->params['named']['direction'])?'/direction:'. $paginator->params['named']['direction']:"";

		echo $html->link(__(null,true), 'index/page:'.$ant.$sort.$direction,array('class'=>'linkbutton linkbtn btn_back'))."&nbsp;";
		echo '<select style="height:22px;font-size:13px" onchange="location.href=\''. $this->webroot.'cargos/index/page:\'+this.value+\''.$sort.$direction.'\'">';
		for($x=1;$x<=$total;$x++){
			echo $x==$paginator->current()?"<option selected value=\"$x\">".$x."</option>":"<option value=\"$x\">".$x."</option>";
		}
		echo "</select>&nbsp;";
		echo $html->link(__(null,true), 'index/page:'.$prox.$sort.$direction,array('class'=>'linkbutton linkbtn btn_go'));
	}
	?>
	</div>


<div class="contextMenu" id="contextMenuList">
    <ul style="font-size:12px">
      <li id="view"><img src="<?php echo $this->webroot;?>css/img/visualizar.gif"/>Visualizar</li>
      <li id="edit"><img src="<?php echo $this->webroot;?>css/img/edit.gif"/>Editar</li>
      <li id="delete"><img src="<?php echo $this->webroot;?>css/img/delete.gif"/>Excluir</li>
    </ul>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Listar Empresas",true) ?></span></a></li>
    </ul>
    <div id="tab1">

        <table id="myTable" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                                        <th><?php echo $paginator->sort('nome_fantasia');?></th>
                                        <th><?php echo $paginator->sort('cnpj');?></th>
                                        <th><?php echo $paginator->sort('email');?></th>
                                        <th><?php echo $paginator->sort('bairro');?></th>
                                        <th><?php echo $paginator->sort('cidade');?></th>
                                    </tr>
            </thead> 
            <tfoot> 
                <tr>
                                        <th><?php echo $paginator->sort('nome_fantasia');?></th>
                                        <th><?php echo $paginator->sort('cnpj');?></th>
                                        <th><?php echo $paginator->sort('email');?></th>
                                        <th><?php echo $paginator->sort('bairro');?></th>
                                        <th><?php echo $paginator->sort('cidade');?></th>
                                    </tr>
            </tfoot> 
            <tbody> 
            <?php
            $i = 0;
            foreach ($empresas as $empresa):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>
                <td>
			<?php echo $html->link($empresa['Empresa']['nome_fantasia'], array('action'=>'view', $empresa['Empresa']['id'])); ?>
		</td>
		<td>
			<?php echo $empresa['Empresa']['cnpj']; ?>
		</td>
		<td>
			<?php echo $empresa['Empresa']['email']; ?>
		</td>
		<td>
			<?php echo $empresa['Empresa']['bairro']; ?>
		</td>
		<td>
			<?php echo $empresa['Empresa']['cidade']; ?>
		</td>
	</tr>
<?php endforeach; ?>

            </tbody> 
        </table>
        
    </div>
</div>