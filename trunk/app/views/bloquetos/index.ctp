
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
	<?php echo $html->link(__('Novo Bloqueto',true), 'add',array('class'=>'linkbutton linkbtn btn_add')); ?>
	
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

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Listar Bloquetos",true) ?></span></a></li>
    </ul>
    <div id="tab1">

        <table id="myTable" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                                        <th width="120"><?php echo $paginator->sort('nome');?></th>
                                        <th><?php echo $paginator->sort('banco_id');?></th>
                                        <th><?php echo $paginator->sort('carteira');?></th>
                                        <th><?php echo $paginator->sort('local_pagamento');?></th>
                                        <th><?php echo $paginator->sort('taxa_boleto');?></th>
                                        <th><?php echo $paginator->sort('dias_prazo_pagamento');?></th>
                                        <th><?php echo $paginator->sort('tipo');?></th>
                                        <th><?php echo $paginator->sort('ativo');?></th>
                                    </tr>
            </thead> 
            <tfoot> 
                <tr>
                                        <th width="120"><?php echo $paginator->sort('nome');?></th>
                                        <th><?php echo $paginator->sort('banco_id');?></th>
                                        <th><?php echo $paginator->sort('carteira');?></th>
                                        <th><?php echo $paginator->sort('local_pagamento');?></th>
                                        <th><?php echo $paginator->sort('taxa_boleto');?></th>
                                        <th><?php echo $paginator->sort('dias_prazo_pagamento');?></th>
                                        <th><?php echo $paginator->sort('tipo');?></th>
                                        <th><?php echo $paginator->sort('ativo');?></th>
                                    </tr>
            </tfoot> 
            <tbody> 
            <?php
            $i = 0;
            foreach ($bloquetos as $bloqueto):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
	<tr<?php echo $class;?>>

		<td>
                    <?php echo $html->link($bloqueto['Bloqueto']['nome'], array('action'=>'view', $bloqueto['Bloqueto']['id'])); ?>
		</td>
                <td>
			<?php echo $bloqueto['Banco']['nome']; ?>
		</td>
                <td>
			<?php echo $bloqueto['Bloqueto']['carteira']; ?>
		</td>
		<td>
			<?php echo $bloqueto['Bloqueto']['local_pagamento']; ?>
		</td>
                <td>
			<?php echo $bloqueto['Bloqueto']['taxa_boleto']; ?>
		</td>
                <td>
			<?php echo $bloqueto['Bloqueto']['dias_prazo_pagamento']; ?>
		</td>
		<td>
			<?php echo $bloqueto['Bloqueto']['tipo']; ?>
		</td>
		<td>
			<?php echo $bloqueto['Bloqueto']['ativo']; ?>
		</td>
	</tr>
<?php endforeach; ?>

            </tbody> 
        </table>
        
    </div>
</div>