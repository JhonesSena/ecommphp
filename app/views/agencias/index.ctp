
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

<div class="toolbar">
	<?php echo $html->link(__('Nova Agencia',true), 'add',array('class'=>'linkbutton linkbtn btn_add')); ?>	<a href="#" onclick="location.href='<?php echo $this->webroot;?>/agencias/deleteselected/'+selecionados()" class="linkbutton linkbtn btn_delete">Excluir Vários</a>
	
	<?
	$total = $paginator->counter(array('format' => '%pages%', true));
	if($total!=1){
		echo "&nbsp;";
		$ant  = $paginator->current()-1; 
		$prox = $paginator->current()+1;

		$sort = isset($paginator->params['named']['sort'])?'/sort:'. $paginator->params['named']['sort']:"";
		$direction = isset($paginator->params['named']['direction'])?'/direction:'. $paginator->params['named']['direction']:"";

		echo $html->link(__(null,true), 'index/page:'.$ant.$sort.$direction,array('class'=>'linkbutton linkbtn btn_back'))."&nbsp;";
		echo '<select style="height:22px;font-size:13px" onchange="location.href=\''. $this->webroot.$this->params['controller'].'/index/page:\'+this.value+\''.$sort.$direction.'\'">';
		for($x=1;$x<=$total;$x++){
			echo $x==$paginator->current()?"<option selected value=\"$x\">".$x."</option>":"<option value=\"$x\">".$x."</option>";
		}
		echo "</select>&nbsp;";
		echo $html->link(__(null,true), 'index/page:'.$prox.$sort.$direction,array('class'=>'linkbutton linkbtn btn_go'));
	}
	?>
	</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Listar Agencias",true) ?></span></a></li>
    </ul>
    <div id="tab1">

        <table id="myTable" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                                        <th><?php echo $paginator->sort('codigo');?></th>
                                        <th><?php echo $paginator->sort('conta_corrente');?></th>
                                        <th><?php echo $paginator->sort('contrato');?></th>
                                        <th><?php echo $paginator->sort('convenio_cobranca');?></th>
                                        <th><?php echo $paginator->sort('bairro');?></th>
                                        <th><?php echo $paginator->sort('cidade_id');?></th>
                                        <th><?php echo $paginator->sort('telefone');?></th>
                                        <th><?php echo $paginator->sort('banco_id');?></th>
                                        <th><?php echo $paginator->sort('ativo');?></th>
                                    </tr>
            </thead> 
            <tfoot> 
                <tr>
                                        <th><?php echo $paginator->sort('codigo');?></th>
                                        <th><?php echo $paginator->sort('conta_corrente');?></th>
                                        <th><?php echo $paginator->sort('contrato');?></th>
                                        <th><?php echo $paginator->sort('convenio_cobranca');?></th>
                                        <th><?php echo $paginator->sort('bairro');?></th>
                                        <th><?php echo $paginator->sort('cidade_id');?></th>
                                        <th><?php echo $paginator->sort('telefone');?></th>
                                        <th><?php echo $paginator->sort('banco_id');?></th>
                                        <th><?php echo $paginator->sort('ativo');?></th>
                                    </tr>
            </tfoot> 
            <tbody> 
            <?php
            $i = 0;
            foreach ($agencias as $agencia):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>

                <td>
			<?php echo $html->link($agencia['Agencia']['codigo'], array('action'=>'view', $agencia['Agencia']['id'])); ?>
		</td>
		<td>
			<?php echo $agencia['Agencia']['codigo_cedente']; ?>
		</td>
		<td>
			<?php echo $agencia['Agencia']['contrato']; ?>
		</td>
                <td>
			<?php echo $agencia['Agencia']['convenio_cobranca']; ?>
		</td>
                <td>
			<?php echo $agencia['Agencia']['bairro']; ?>
		</td>
		<td>
			<?php echo $agencia['Agencia']['cidade']; ?>
		</td>
		<td>
			<?php echo $agencia['Agencia']['telefone']; ?>
		</td>
		<td>
			<?php echo $agencia['Banco']['nome']; ?>
		</td>
		<td>
			<?php echo $agencia['Agencia']['ativo']; ?>
		</td>
	</tr>
<?php endforeach; ?>

            </tbody> 
        </table>
        
    </div>
</div>