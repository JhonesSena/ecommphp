<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Bocazul</title>

        <!-- Padrão -->
        <link rel="stylesheet" href="<?php echo $this->webroot;?>css/default.css" type="text/css" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/bocazumbk.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/linhas.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/menu.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.8.2.custom/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/dropdown.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/menu.js"></script>
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


    </head>

    <body>

        <div class="body">

            <div class="linha-centralizada">
                <div class="topo"><br>

                </div>



                <div id="menu">
                    <ul class="menu">
                        <li>
                            <a href="<?php echo $this->webroot;?>pages/index"><span>Home</span></a>
                        </li>
                        <li><a href="<?php echo $this->webroot;?>pages/empresas"><span>Empresa</span></a></li>
                        <li><a href="#"><span>Produtos</span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo $this->webroot;?>produtos/consultar/1"><span>Linhas e Barbantes</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>produtos/consultar/2"><span>Produto de Limpeza</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->webroot;?>pages/industria"><span>Artigos Técnicos</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $this->webroot;?>receitas/visualizar"><span>Receitas</span></a></li>
                        <li><a href="<?php echo $this->webroot;?>pages/representantes"><span>Representantes</span></a></li>
                        <li><a href="<?php echo $this->webroot;?>contatos"><span>Contatos</span></a></li>
                        <?php if(!empty($clienteSession)):?>
                            <li><a href="<?php echo $this->webroot;?>users/logout"><span>Sair</span></a></li>
                        <?php endif;?>
                    </ul>
                </div>
                <!--Fim menu-->

                <script type="text/javascript">
                    $(function(){
                        //                $('#menu1').menu({
                        //                    content: $('#menu1').next().html(), // grab content from this page
                        //                    flyOut: true
                        //                });
                    });
                </script>

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
                                <?$session->flash();?>
                            <br>
                        </div>
                    </div>
                        <?php }?>
                    <?php
                    if(empty ($clienteSession) && $this->params['controller'] != 'users') {?>
                    <a href="<?php echo $this->webroot;?>users/login" style="color: blue;">Login</a>
                        <?php }?>
                    <div style="padding:8px">
                        <div class="div_miolo">
                            <div class="div_migalha_de_pao"><div class="div_linhas_a-d"></div>
                                <span class="migalha_de_pao">Receitas</span></div>

                            <div class="div_receitas_1_ok"><div class="div_receitas_a_ok"></div>

                                <div class="div_receitas_b_ok">


                                    <br> <br>
                                    <br>
                                    <br>
                                    <br>
                                    <span class="menu_lateral">
                                        <br/>
                                        <br/>
                                    <?php 
                                    foreach ($receitas as $value) :
                                        echo '<a href="'.$this->webroot.'receitas/visualizar/'.$value['Receita']['id'].'">'.$value['Receita']['nome'].'</a><br>';
                                    endforeach;?>
                                    </span>
                                </div>


                                <div class="div_linhas_f"></div>
                                <div style="padding:8px; float: left; width: 528px;">
                                    <input id="webroot" type="hidden" value="<?=$this->webroot;?>"/>
                                    <?php if(!empty($receitas)) echo $content_for_layout; ?>
                                </div>
                            </div>
                            <?php echo $cakeDebug?>
                        </div>


                    </div>
                </div>
            </div><!--Fim div linha centralizada-->
        </div><!--Fim div body-->
    </body>
</html>
