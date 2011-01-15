
<?php echo $jquery->init_date(); ?>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });

    $(document).ready(function(){
        $('#senha').val('');
        $('#confirmaSenha').val('');

        $('form').submit(function(){
            if($('#senha').val() != $('#confirmaSenha').val()){
                alert("A confirmação da senha não confere.");
                return false;
            }
            else
                return true;
        });
        
    });
</script>
<div class="toolbar">
		<?php echo $html->link(__('Voltar', true), array('action'=>'login'),array('class'=>'linkbutton linkbtn btn_list')); ?>
</div>
<div id="tabpanel">
    <ul>
        <li>
            <a href="#tab1"><span><?php echo __("Autenticação",true) ?></span></a>
        </li>

    </ul>
    <div id="tab1">
        <?php echo $jquery->create('User', array('controller'=>'users','action'=>'edit', $this->data['User']['autenticacao']));?>
        <?php if($this->data):?>
            <table cellspacing="0" class="detailsLogin">
                <?php
                echo $jquery->input('autenticacao',array('type'=>'hidden', 'value'=>$this->data['User']['autenticacao'],'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('username',array('label'=>'Email','class'=>'validateRequired', 'label'=>'Email*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));                
                echo $jquery->input('senha',array('id'=>'senha','name'=>'data[User][password]', 'type'=>'password','label'=>'Senha*', 'value'=>'','class'=>'validateRequired','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('redigite_senha',array('id'=>'confirmaSenha','class'=>'validateRequired', 'type'=>'password', 'label'=>'Confirmação Senha*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                ?>
                <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Entrar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
            </table>
        <?php  else: ?>
            <table cellspacing="0" class="detailsLogin">
                <?php
                    echo $jquery->input('username',array('size'=>30,'label'=>'Email','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                ?>
                <tr><td class="left"></td><td class="right"><?php echo $form->submit(__('Enviar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>
                </tr>
            </table>
        <?php endif;?>
        <?php echo $jquery->end();?>
    </div>
</div>
