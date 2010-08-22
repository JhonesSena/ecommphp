<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">		
        <title>Build in Cake 1.2</title>

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
                    <dl class="dropdown"><dt class ="dropdown5_dt" id="one-ddheader" onMouseOver="ddMenu('one',1)" onMouseOut="ddMenu('one',-1)"><a href="contato.php">Contato</a></dt>
                    </dl>

                    <dl class="dropdown">
                        <dt class="dropdown_dt" id="two-ddheader" onMouseOver="ddMenu('two',1)" onMouseOut="ddMenu('two',-1)"><a href="receitas.html">Receitas</a></dt>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown3_dt" id="three-ddheader" onMouseOver="ddMenu('three',1)" onMouseOut="ddMenu('three',-1)"><a href="representantes.html">Representantes</a></dt>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown2_dt" id="four-ddheader" onMouseOver="ddMenu('four',1)" onMouseOut="ddMenu('four',-1)"><a href="orcamento.html">Or&ccedil;amento</a></dt>

                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="five-ddheader" onMouseOver="ddMenu('five',1)" onMouseOut="ddMenu('five',-1)">
                            <a href="http://www.bocazul.com.br/produtos.html">Produtos</a></dt>
                        <dd class="dropdown_dd" id="five-ddcontent" onMouseOver="cancelHide('five')" onMouseOut="ddMenu('five',-1)">
                            <ul class="dropdown_ul">
                                <li class="dropdown_li"><a href="http://www.bocazul.com.br/linhas_e_barbantes.html">Linhas e Barbantes</a></li>
                                <li class="dropdown_li"><a href="http://www.bocazul.com.br/limpeza.html">Produtos de Limpeza</a></li>
                                <li class="dropdown_li"><a href="http://www.bocazul.com.br/industria.html">Artigos T&eacute;cnicos</a></li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="dropdown">
                        <dt class ="dropdown4_dt" id="six-ddheader" onMouseOver="ddMenu('six',1)" onMouseOut="ddMenu('six',-1)"><a href="empresa.html">Empresa</a></dt>
                    </dl>

                </div> <!--Fim menu-->

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

                    <div style="padding:8px">
                        <?php echo $content_for_layout; ?>
                        <?php echo $cakeDebug?>

                    </div>
                </div>
            </div><!--Fim div linha centralizada-->
        </div><!--Fim div body-->
    </body>
</html>
