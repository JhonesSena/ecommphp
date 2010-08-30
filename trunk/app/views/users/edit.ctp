
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
            ?>
            <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Enviar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
            </tr>
        </table>
        <?php echo $jquery->end();?>
    </div>
</div>
