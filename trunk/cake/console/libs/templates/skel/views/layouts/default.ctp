<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">		
        <title>Build in Cake 1.2</title>
        
        <!-- Padrão -->
        <link rel="stylesheet" href="<?php echo $this->webroot;?>css/default.css" type="text/css" />
        <script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.3.2.min.js"></script>

		<link type="text/css" href="<?php echo $this->webroot;?>js/jquery.ui/css/redmond/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.ui/jquery-ui-1.7.2.custom.min.js"></script>
        
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.fg-menu/fg.menu.js"></script>
	    <link type="text/css" href="<?php echo $this->webroot;?>js/jquery.fg-menu/fg.menu.css" media="screen" rel="stylesheet" />
        
        <? //echo $jquery->ajaxConfigMsg('ajax_msg'); //Habilitar para usar Ajax ?>
        
    </head>
    
    <body>
    
        <? //echo $jquery->ajaxMsg('Carregando...','ajax_msg'); //Habilitar para usar Ajax ?>
        
        <table cellspacing="0" cellspacing="0" width="100%">
            <tr>
                <td style="background:url(<?php echo $this->webroot;?>img/bg.jpg);height:70px"><img style="margin-left:10px;margin-top:8px;" src="<?php echo $this->webroot;?>img/sbake.png"></td>
            </tr>
        </table>

		<script type="text/javascript">    
	    $(function(){
				$('#menu1').menu({ 
					content: $('#menu1').next().html(), // grab content from this page
					flyOut: true,
				});
	    });
	    </script>

       	<div class="menubar">
	
        	<a tabindex="0" href="#cont-menu1" class="menubutton" id="menu1">Menu1</a>
			<div id="cont-menu1" class="hidden">
				<ul>
					<li><a onclick="location.href='<?php echo $this->webroot;?>pages/help'" href="#">Sub-Menu1: Help</a></li>
					<li><a href="#">Sub-Menu2</a>
						<ul>
							<li><a onclick="location.href='<?php echo $this->webroot;?>pages/home'" href="#">Sub-Item</a></li>
						</ul>
					</li>
				</ul>
			</div>
			
		</div>
        
        <?php if ($session->check('Message.flash') && count($jquery->validationErrors)==0){?>
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
    </body>
</html>
