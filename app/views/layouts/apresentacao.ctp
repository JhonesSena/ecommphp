<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">		
        <title>Bocazul</title>

        <link rel="stylesheet" href="<?php echo $this->webroot;?>css/default.css" type="text/css" />
        <link type="text/css" href="<?php echo $this->webroot;?>css/bocazumbk.css" rel="stylesheet" />
    </head>

    <body>

        <div class="body">

            <div class="linha-centralizada">
                <div style="margin-top: 20px;">
                    <?php echo $content_for_layout; ?>
                    <?php //echo $cakeDebug?>
                </div>
            </div><!--Fim div linha centralizada-->
        </div><!--Fim div body-->
    </body>
</html>
