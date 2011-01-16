
<?php echo $jquery->init_date(); ?>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
        $('#confirmaSenha').val($('#senha').val());

        $('#alterar_senha').click(function(){
            if($(this).attr('checked')){
                $(".senha").show();
            }else{
                $(".senha").hide();
            }
        });
    });

    $(document).ready(function(){
        
        $('#confirmaSenha').val($('#senha').val());

        if($("#alterar_senha").attr('checked')){
            $(".senha").show();
        }else{
            $(".senha").hide();
        }

        $('form').submit(function(){
            if($("#alterar_senha").attr('checked')){
                if($('#senha').val()==''){
                    alert("A senha é um campo obrigatório.");
                    return false;
                }else{
                    if($('#senha').val() != $('#confirmaSenha').val()){
                        alert("A confirmação da senha não confere.");
                        return false;
                    }else{
                        return true;
                    }
                }
                
            }
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
        <?php echo $jquery->create('User', array('controller'=>'users','action'=>'edit_user', $this->data['User']['id']));?>
        <?php if($this->data):?>
            <table cellspacing="0" class="detailsLogin">
                <?php
                echo $jquery->input('id',array('type'=>'hidden','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('Cliente.id',array('error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('Cliente.nome',array('class'=>'validateRequired','label'=>'Nome*','alt'=>'Nome','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('username',array('disabled','label'=>'Email','class'=>'validateRequired', 'label'=>'Email*','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                if($jquery->verificaPermissao(array('users/campo_group_id'), $session->read('UserTelas'))):
                    echo $jquery->input('group_id',array('class'=>'validateRequired','label'=>'Grupo de Acesso*','alt'=>'Grupo de Acesso','empty'=>'Selecione','error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                endif;
                echo $jquery->input('alterar_senha',array('id'=>'alterar_senha','type'=>'checkbox','checked'=>false,'error' => false,'div'=>false,'before' => '<tr><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('senha',array('id'=>'senha','name'=>'data[User][password]', 'type'=>'password','error' => false,'div'=>false,'before' => '<tr class="senha"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
                echo $jquery->input('redigite_senha',array('id'=>'confirmaSenha', 'type'=>'password', 'label'=>'Confirmação Senha','error' => false,'div'=>false,'before' => '<tr class="senha"><td class="left">','after' => '</td></tr>','between' => '</td><td class="right">'));
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
