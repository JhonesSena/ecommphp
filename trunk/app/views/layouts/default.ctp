<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">		
        <title>Bocazul</title>

        <!-- Padrão -->
        <link rel="stylesheet" href="<?php echo $this->webroot;?>css/default.css" type="text/css" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/bocazumbk.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/dropdown.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.3.2.min.js"></script>

        <link type="text/css" href="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/css/custom-theme/jquery-ui-1.8.2.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/js/jquery-ui-1.8.2.custom.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.fg-menu/fg.menu.js"></script>
        <link type="text/css" href="<?php echo $this->webroot;?>js/jquery.fg-menu/fg.menu.css" media="screen" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.trule.common-min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.trule-min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/messages.pt-br.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/validate.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.dualListBox-1.0.1.min.js"></script>


    </head>

    <body>

        <div class="body">

            <div class="linha-centralizada">
                <div class="topo"><br>

                </div>

                <div class="menu">
                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="two-ddheader">
                            <a href="<?php echo $this->webroot;?>users/logout">Sair</a>
                        </dt>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="four-ddheader" onMouseOver="ddMenu('four',1)" onMouseOut="ddMenu('four',-1)">
                            <a href="#">Venda</a>
                        </dt>
                        <dd class="dropdown_dd" id="four-ddcontent" onMouseOver="cancelHide('four')" onMouseOut="ddMenu('four',-1)">
                            <ul class="dropdown_ul">
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>vendas/index">Listar</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>pedidos/index">Pedidos</a></li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="three-ddheader" onMouseOver="ddMenu('three',1)" onMouseOut="ddMenu('three',-1)">
                            <a href="#">Cliente</a>
                        </dt>
                        <dd class="dropdown_dd" id="three-ddcontent" onMouseOver="cancelHide('three')" onMouseOut="ddMenu('three',-1)">
                            <ul class="dropdown_ul">
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>clientes/add">Novo</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>clientes">Listar</a></li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="two-ddheader" onMouseOver="ddMenu('two',1)" onMouseOut="ddMenu('two',-1)">
                            <a href="#">Cadastro</a>
                        </dt>
                        <dd class="dropdown_dd" id="two-ddcontent" onMouseOver="cancelHide('two')" onMouseOut="ddMenu('two',-1)">
                            <ul class="dropdown_ul">
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>cores/index">Cores</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>situacao_pedidos/index">Situações de Pedido</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>situacao/index">Situações de Venda</a></li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="one-ddheader" onMouseOver="ddMenu('one',1)" onMouseOut="ddMenu('one',-1)">
                            <a href="#">Produto</a>
                        </dt>
                        <dd class="dropdown_dd" id="one-ddcontent" onMouseOver="cancelHide('one')" onMouseOut="ddMenu('one',-1)">
                            <ul class="dropdown_ul">
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>produtos/add">Novo</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>produtos/index">Listar</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>itens/index">Item de Produto</a></li>
                                <li class="dropdown_li"><a href="<?php echo $this->webroot;?>grupos/index">Grupo</a></li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="one-ddheader">
                            <a href="<?php echo $this->webroot;?>shopps/index">Home</a>
                        </dt>
                    </dl>


                </div> <!--Fim menu-->

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
                    <div id="msginfo" style="z-index:10000;position:absolute;top:100px;right:35%;left:35%; display:none;" class="ui-widget">
                        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                            <br>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <div id="flashMessage"></div>
                            <br>
                        </div>
                    </div>
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
                                        echo '<div id="msgerro" style="display:none" class="msg_erro">';
                                        echo '<ul></ul>';
                                        echo '</div>';
                                        echo '<div id="msgaviso" style="display:none" class="msg_aviso">Verifique o registro antes de confirmar a operação, uma vez confirmado, a operação não poderá ser desfeita.<div>';
                                    }
                                    ?>
                            </td>

                        </tr>
                        <!--fim bloco de exibição das mensagens-->
                    </table>
                    <div id="dialog" title="Carregando..."></div>
                    <span><input type="hidden" value="<?php echo $this->webroot;?>"></span>
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
