
<? echo $jquery->init_date(); ?>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
</script>

<div id="tabpanel">
    <ul>
        <li>
            <a href="#tab1"><span><?php echo __("Autenticação",true) ?></span></a>
        </li>

    </ul>
    <div id="tab1">

        <?php echo $jquery->create('User', array('controller'=>'users','action'=>'login'));?>

        <table cellspacing="0" class="detailsLogin">
            <?php
            echo $jquery->input('username',array('label'=>'Email','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            echo $jquery->input('password',array('label'=>'Senha','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
            ?>
            <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Entrar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
            </tr>
        </table>
        <?php echo $jquery->end();?>
            <?php echo $html->link('Esqueci minha senha', array('controller'=>'users', 'action'=>'edit'));?><br />
            <?php //echo $html->link('Criar conta', array('controller'=>'clientes', 'action'=>'add'));?>
    </div>
</div>
