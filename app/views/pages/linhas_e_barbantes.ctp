<link type="text/css" href="<?php echo $this->webroot;?>css/linhas.css" rel="stylesheet" />

<div class="div_miolo">
    <div class="div_migalha_de_pao"><div class="div_linhas_a-d"></div>
        <span class="migalha_de_pao">Produtos  >  Linhas e Barbantes</span></div>

    <div class="div_linhas_1"><div class="div_linhas_a"></div>


        <div class="div_linhas_b">


            <br> <br>
            <br>
            <br>
            <br>
            <span class="menu_lateral"><a href="finissima.html">Fin&iacute;ssima</a><br>
                <a href="iris.html">&Iacute;ris</a><br>
                <a href="super.html">Super</a><br>

                <a href="rabo_de_rato.html">“rabo de rato” - 100m</a><br>
                <br>
                <br>
                <br><br><br>
                <a href="novelo_colorido.html">novelo - colorido</a><br>
                <a href="novelo_natural.html">novelo - natural 4/3</a><br>
                <a href="tubete_bicolor.html">tubete - bicolor</a><br>
                <a href="tubete_natural_100g.html">tubete - natural 100g</a><br>

                <a href="tubete_natural_200g.html">tubete - natural 200g</a><br>
                <a href="tubinho_escolar.html">tubinho escolar</a><br>
                <a href="cone_natural_400g.html">cone - natural 400g</a><br>
                <a href="cone_natural_660g.html">cone - natural 660g</a><br>
                <a href="cone_natural_700g.html">cone - natural 700g</a><br>
                <a href="cone_colorido_4.html">cone - colorido n&ordm; 4</a><br>
                <a href="cone_colorido_8.html">cone - colorido n&ordm; 8</a><br>
                <a href="cone_colorido_6.html">cone - colorido n&ordm; 6</a><br>
                <a href="cone_natureza.html">cone - Natureza</a><br>
            </span></div>


        <div class="div_linhas_f"></div>
        <div class="div_linhas_a2"></div>
        <div class="div_linhas_c">

            <span class="titulo_ocre"><img src="<?php echo $this->webroot;?>img/ocre.jpg" width="350" height="1"> <br>
                Linha Raionyl Fin&iacute;ssima
                para tric&ocirc; e croch&ecirc;</span>
            <br>

            <br>
            Fabricada com fio de alt&iacute;ssima qualidade e  maciez, a linha Fin&iacute;ssima &eacute; indicada para tric&ocirc;, croch&ecirc; e trabalhos artesanais em geral. Tem espessura de  800/2 dtex. <br>
            <br>
            <strong>Composi&ccedil;&atilde;o:</strong> 100% polipropileno.<br>

            <br>
            <strong>Utiliza&ccedil;&atilde;o:</strong> Artesanato em geral e confec&ccedil;&atilde;o.<br>
            <br>
            <strong>Distribui&ccedil;&atilde;o:</strong> Armarinhos, aviamentos, supermercados,  atacadistas, etc. <br>

            <br>
            <br>

            <table>
                <?php $i=0;
                    $col = 10;
                ?>
                
                <?php foreach ($cores as $cor):
                    if(($i % $col) == 0){ echo '<tr align="center">';
                        $primeiro = true;

                    }

                    ?>
                    <td><?php echo $html->image('/'.$cor['Cor']['diretorio'], array('align'=>'center','height'=>'18px', 'width'=>'30px;')).
                        "<br><center>".$cor['Cor']['codigo']."</center>";?></td>
                <?php if(($i % $col) == 0 && $primeiro == false){ echo '</tr>';}
                $i++;
                $primeiro = false;
                endforeach;
                ?>

            </table>
        </div>
        <div class="div_linhas_d"><img src="<?php echo $this->webroot;?>img/1x18px.gif" width="50" height="35"><img src="<?php echo $this->webroot;?>img/finissima-.png" alt="Finíssima" width="156" height="350"></div>

        <div class="div_linhas_e">
            <div class="linha">

                <div class="coluna4"> t&iacute;tulo</div>
                <div class="coluna4"> peso aprox.</div>
                <div class="coluna4"> metragem</div>
                <div class="coluna4"> cores</div>

            </div>

            <div class="linha">
                <div class="coluna-impar4">800/2 dtex</div>
                <div class="coluna-impar4">80g</div>
                <div class="coluna-impar4">440m</div>
                <div class="coluna-impar4">diversas</div>
            </div></div> </div>



</div>