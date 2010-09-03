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
    <?php echo $html->link(__('Editar', true), array('action'=>'edit', $cedente['Cedente']['id']),array('class'=>'linkbutton linkbtn btn_edit')); ?>
    <?php echo $html->link(__('Deletar', true), array('action'=>'delete', $cedente['Cedente']['id']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), $cedente['Cedente']['id'])); ?>
    <?php echo $html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?php echo __("Visualizar Cedente",true) ?></span></a></li>
    </ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            <tr><td class="left"><?php __('Id'); ?></td>
                <td class="right"><?php echo $cedente['Cedente']['id']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Conta Corrente'); ?></td>
                <td class="right"><?php echo $cedente['Cedente']['conta_corrente']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Agencia'); ?></td>
                <td class="right"><?php echo $cedente['Agencia']['codigo']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Carteira'); ?></td>
                <td class="right"><?php echo $cedente['Bloqueto']['carteira']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Nome'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['nome']; ?></td>
            </tr>
            <?php if(!empty($cedente['PessoaFisica']['id'])):?>
                <tr><td class="left"><?php __('CPF'); ?></td>
                    <td class="right"><?php echo $cedente['PessoaFisica']['cpf']; ?></td>
                </tr>
            <?php endif;?>
            <?php if(!empty($cedente['PessoaJuridica']['id'])):?>
                <tr><td class="left"><?php __('Nome Fantasia'); ?></td>
                    <td class="right"><?php echo $cedente['PessoaJuridica']['nome_fantasia']; ?></td>
                </tr>
                <tr><td class="left"><?php __('CNPJ'); ?></td>
                    <td class="right"><?php echo $cedente['PessoaJuridica']['cnpj']; ?></td>
                </tr>
            <?php endif;?>
            <tr><td class="left"><?php __('Telefone'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['telefone']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Email'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['email']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Logradouro'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['logradouro']; ?></td>
            </tr>
            <tr><td class="left"><?php __('CEP'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['cep']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Bairro'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['bairro']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Cidade'); ?></td>
                <td class="right"><?php echo $cedente['Cliente']['cidade']; ?></td>
            </tr>
            <tr><td class="left"><?php __('Estado'); ?></td>
                <td class="right"><?php echo $estados[$cedente['Cliente']['estado_id']]; ?></td>
            </tr>

        </table>
    </div>
</div>
