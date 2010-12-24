<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">		
        <title>Bocazul</title>

        <!-- Padrão -->
        <link rel="stylesheet" href="<?php echo $this->webroot;?>css/default.css" type="text/css" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/bocazumbk.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/menu.css" rel="stylesheet" />

        <!--script type="text/javascript" src="<?php //echo $this->webroot;?>js/jquery.js"></script-->

        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.3.2.min.js"></script>

        <link type="text/css" href="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/css/custom-theme/jquery-ui-1.8.2.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/js/jquery-ui-1.8.2.custom.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.fg-menu/fg.menu.js"></script>
        <link type="text/css" href="<?php echo $this->webroot;?>js/jquery.fg-menu/fg.menu.css" media="screen" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.trule.common-min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.trule-min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/messages.pt-br.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/validate.js"></script>
        <!--script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.dualListBox-1.0.1.min.js"></script-->
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/menu.js"></script>


    </head>

    <body>

        <div class="body">

            <div class="linha-centralizada">
                <div class="topo">

                </div>
                <!--div id="menu">
                    <ul class="menu">
                        <li>
                            <a class="parent" href="<?php echo $this->webroot;?>shopps/index"><span>Home</span></a>
                        </li>
                        <li><a href="#" class="parent"><span>Produto</span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo $this->webroot;?>produtos/add"><span>Novo</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>produtos"><span>Listar</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>itens"><span>Item de Produto</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>grupos"><span>Grupo</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><span>Cadastro</span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo $this->webroot;?>cores/index"><span>Cores</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>situacao_pedidos/index"><span>Situações de Pedidos</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>situacoes/index"><span>Situações de Vendas</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>bancos/index"><span>Bancos</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>bloquetos/index"><span>Bloquetos</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>cedentes/index"><span>Cedentes</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>agencias/index"><span>Agências</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>users"><span>Usuários</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><span>Cliente</span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo $this->webroot;?>clientes/add"><span>Novo</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>clientes"><span>Listar</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><span>Pedidos</span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo $this->webroot;?>pedidos/index"><span>Listar</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $this->webroot;?>users/logout"><span>Sair</span></a>
                        </li>
                    </ul>
                </div-->
                <!--Fim menu-->

           <?php
               $opt_menu = array(
                'Home' => 'shopps',
               'Produtos'=>array(
                    'Novo'=>'produtos/add',
                    'Listar'=>'produtos',
                    'Item de Produto'=>'itens',
                    'Grupo'=>'grupos'
                ),
                'Administrar' => array(
                    'Grupos de Acessos'=>'groups',
                    'Permissões'=>'permissoes',
                    'Usuários'=>'users'
                ),
                'Cadastro' =>array(
                    'Agências'=>'agencias',
                    'Bancos'=>'bancos',
                    'Bloquetos'=>'bloquetos',
                    'Cedentes'=>'cedentes',
                    'Cores'=>'cores',
                    'Receitas'=>'receitas',
                    'Situações de Pedidos'=>'situacao_pedidos',
                    'Situações de Vendas'=>'situacoes'
                ),
                'Cliente'=>array(
                        'Novo'=>'clientes/add',
                        'Listar'=>'clientes'

                ),
                'Pedidos'=>array(
                        'Listar'=>'pedidos'
                ),
                'Sair'=>'users/logout'
        );

        //$telas = array('produtos/add'=>1, 'produtos'=>1, 'permissoes'=>1);
        echo $menu->gerarMenu($telas,$opt_menu);
        ?>

                <script type="text/javascript">
                    $(function(){
                        //                $('#menu1').menu({
                        //                    content: $('#menu1').next().html(), // grab content from this page
                        //                    flyOut: true
                        //                });
                    });

                    $(document).ready(function() {
                        $("#dialog").dialog({
                            bgiframe: true,
                            height: 140,
                            modal: false,
                            autoOpen: false
                        });

                        $('.mensagem').hide();
                        if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){
                            $('#btnForm').addClass('formloginbtnIe');
                        }
                        else
                            $('#btnForm').addClass('formloginbtn');
                    });

                </script>
                <?php if($content_for_layout):?>
                <div class="conteudo" style="padding: 8px;">
                        <?php if ($session->check('Message.flash') && count($jquery->validationErrors)==0) {?>
                    <script>
                        window.onload = function(){
                            setInterval("document.getElementById('msginfo').style.display='none'", 5000);
                        }
                    </script>

                    <div id="msginfo" style="z-index:10000;position:absolute;top:100px;right:35%;left:35%" class="ui-widget">
                        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                            <br>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                    <?php $session->flash();?>
                            <br>
                        </div>
                    </div>
                            <?php } else {?>

                    <!--Div da mensagem de informação. -->
                    <div id="msginfo" style="z-index:10000;position:absolute;top:100px;right:35%;left:35%; display:none;" class="ui-widget mensagem">
                        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                            <br>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <div id="flashMessage"></div>
                            <br>
                        </div>
                    </div>
                            <?php }?>

                    <!--
                    <?php //if(empty ($clienteSession)){?>
                        <div style="font-size: 8px; text-align: left;">
                            <?php //echo $form->create('User', array('controller'=>'users','action'=>'login', 'style'=>'height:16px;'));?>
                            <table cellspacing="0" class="details">
                                    <?php
                                    //echo $form->input('username',array('size'=>'50','label'=>'Email:','error' => false,'div'=>false));
                                    //echo " ".$form->input('password',array('label'=>'Senha:','error' => false,'div'=>false));
                                 ?>
                                    <?php //echo $form->submit(__('Login',true),array('id'=>'btnForm','div'=>false));?>
                                    <?php //echo $form->end(); ?>
                            </table>
                        </div>
                    <?php //}?>
                    -->
                    <?php 
                    if(empty ($clienteSession) && $this->params['controller'] != 'users'){?>
                        <a href="<?php echo $this->webroot;?>users/login" style="color: blue;">Login</a>
                    <?php }?>
                    <table>
                        <!--bloco de exibição das mensagens-->
                        <tr>
                            <td class="ui-widget">
                                    <?php
                                    $tipo = $session->read('Message.mensagem.params.tipo');
                                    if ($tipo) {
                                        if ($tipo == 'S') {
                                            echo '<div id="msgsucesso" class="msg_sucesso">';
                                            $session->flash('mensagem');
                                            echo '</div>';
                                        } else {
                                            echo '<div id="msgerro" class="ui-state-error ui-corner-all">';
                                            echo '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>';
                                            echo '<strong>Atenção:</strong>';
                                            echo '<ul><li class="no_dec">';
                                            $session->flash('mensagem');
                                            echo '</li></ul>';
                                            echo '<p></div>';
                                        }
                                    } else {
                                        echo '<div id="msgerro" style="display:none; align-text:left;" class="ui-state-error ui-corner-all">';
                                        echo '<ul style="margin-top:1px;margin-bottom: 1px;"></ul>';
                                        echo '</div>';
                                        echo '<div id="msgaviso" style="display:none" class="msg_aviso">Verifique o registro antes de confirmar a operação, uma vez confirmado, a operação não poderá ser desfeita.<div>';
                                    }
                                    ?>
                            </td>

                        </tr>
                        <!--fim bloco de exibição das mensagens-->
                    </table>
                    <div id="dialog" title="Carregando..."></div>

                    <span><input id="webroot" type="hidden" value="<?php echo $this->webroot;?>"></span>

                    <div style="padding:8px">                        
                        <?php echo $content_for_layout; ?>
                        <?php echo $cakeDebug?>
                    </div>
                </div>
                <?php endif;?>
            </div><!--Fim div linha centralizada-->
        </div><!--Fim div body-->
    </body>
</html>
