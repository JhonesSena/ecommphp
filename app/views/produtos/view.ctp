
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
        $(".tablesorter").tablesorter(); 
    });
</script>

<div class="toolbar">
    <?php echo $html->link(__('Editar', true), array('action'=>'edit', $produto['Produto']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
    <?php echo $html->link(__('Deletar', true), array('action'=>'delete', $produto['Produto']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $produto['Produto']['id'])); ?>
    <?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li>
            <a href="#tab1"><span><?php echo __("Visualizar Produto",true) ?></span></a>
        </li>
        <li>
            <a href="#tab2"><span><?php echo __("Imagem",true) ?></span></a>
        </li>
    </ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            <tr><td class="left"><?php __('Id'); ?></td><td class="right">
                    <?php echo $produto['Produto']['id']; ?></td></tr>		<tr><td class="left"><?php __('Codigo'); ?></td><td class="right">
                    <?php echo $produto['Produto']['codigo']; ?></td></tr>		<tr><td class="left"><?php __('Descricao'); ?></td><td class="right">
                    <?php echo $produto['Produto']['descricao']; ?></td></tr>		<tr><td class="left"><?php __('Grupo Id'); ?></td><td class="right">
                    <?php echo $produto['Grupo']['nome']; ?></td></tr>		<tr><td class="left"><?php __('Pacote'); ?></td><td class="right">
                    <?php echo $produto['Preco'][0]['pacote']; ?></td></tr>		<tr><td class="left"><?php __('Caixa'); ?></td><td class="right">
                    <?php echo $produto['Produto']['caixa']; ?></td></tr>		<tr><td class="left"><?php __('Peso Bruto'); ?></td><td class="right">
                    <?php echo $produto['Produto']['peso_bruto']; ?></td></tr>		<tr><td class="left"><?php __('Peso Liquido'); ?></td><td class="right">
                    <?php echo $produto['Produto']['peso_liquido']; ?></td></tr>		<tr><td class="left"><?php __('Cubagem'); ?></td><td class="right">
                    <?php echo $produto['Produto']['cubagem']; ?></td></tr>		<tr><td class="left"><?php __('Preco'); ?></td><td class="right">
                    <?php echo $produto['Preco'][0]['preco']; ?></td></tr>		<tr><td class="left"><?php __('Desconto Pacote (%)'); ?></td><td class="right">
                    <?php echo $produto['Preco'][0]['desconto_por_pacote']; ?></td></tr>           <tr><td class="left"><?php __('Obs'); ?></td><td class="right">
                    <?php echo $produto['Produto']['obs']; ?></td></tr>		<tr><td class="left"><?php __('Ativo'); ?></td><td class="right">
                    <?php echo $produto['Produto']['ativo']; ?></td></tr>

        </table>
    </div>

    <div id="tab2">
        <table cellspacing="0" class="details" align="center">
            <?php foreach ($produto['Imagem'] as $key => $value) {
                if(($key)%3 == 0 || $key == 0)
                    echo "<tr>";
                echo "<td align='center'>".$html->image('/img_produtos/'.$value['nome'], array('align'=>'center','height'=>'130px'))."</td>";
            }
            echo "</tr>";
            ?>
        </table>
    </div>




</div>
