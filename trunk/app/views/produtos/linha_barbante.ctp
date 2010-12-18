<div class="div_linhas_c">

    <span class="titulo_ocre">
        <img src="<?php echo $this->webroot;?>img/ocre.jpg" width="350" height="1" > <br>
        <?php echo $produto['Produto']['descricao'];?>
    </span>
    <br>

    <?php if(isset($produto['Produto']['resumo_tecnico'])):?>
    <br>
        <?php echo $produto['Produto']['resumo_tecnico'];?> <br>
    <br>
    <?php endif;?>
    <?php if(isset($produto['Produto']['composicao'])):?>
    <strong>Composição:</strong><?php echo $produto['Produto']['composicao'];?><br>
    <?php endif;?>

    <?php if(isset($produto['Produto']['utilizacao'])):?>
    <br>
    <strong>Utiliza&ccedil;&atilde;o:</strong> <?php echo $produto['Produto']['utilizacao'];?>.<br>
    <br>
    <?php endif;?>
    <?php if(isset($produto['Produto']['distribuicao'])):?>
    <strong>Distribui&ccedil;&atilde;o:</strong> <?php echo $produto['Produto']['distribuicao'];?> <br><br><br>
    <?php endif;?>

    <table>
        <?php $i=0;
        $col = 10;
        ?>

        <?php foreach ($cores as $cor):
            if(($i % $col) == 0) {
                echo '<tr align="center">';
                $primeiro = true;

            }

            ?>
        <td><?php echo $html->image('/'.$cor['Cor']['diretorio'], array('align'=>'center','height'=>'18px', 'width'=>'30px;')).
                        "<br><center>".$cor['Cor']['codigo']."</center>";?></td>
            <?php if(($i % $col) == 0 && $primeiro == false) {
                echo '</tr>';
            }
            $i++;
            $primeiro = false;
        endforeach;
        ?>

    </table>
</div>
<?php if(isset($produto['Imagem'][0]['nome'])):?>
<div class="div_linhas_d">
    <img src="<?php echo $this->webroot;?>img/1x18px.gif" width="50" height="35">
        <?php echo $html->image('/img_produtos/'.$produto['Imagem'][0]['nome'], array('align'=>'center','width'=>'160px', 'margin'=>'3px'));?>
</div>
<?php endif;?>

<!--div class="div_linhas_e">
    <div class="scrollContainer">
        <table border="0">
            <thead>
                <tr>
                    <th><span>Titulo</span></th>
                    <th><span>Peso aproximado</span></th>
                    <th><span>Metragem</span></th>
                    <th colspan="2"><span>Cores</span></th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($produto['Item'] as $item): ?>
                <tr>
                    <td><span><?php echo $item['titulo']?></span></td>
                    <td><span><?php echo $produto['Produto']['peso_bruto']?></span></td>
                    <td><span><?php echo $item['metragem']?></span></td>
                    <td><span><?php echo $item['Cor']['nome']?></span></td>
                    <td width="10"></td>
                </tr>
<?php endforeach;?>
            </tbody>
        </table>
    </div>
</div-->




<?php if(!empty($produto['Item'])): ?>
    <div class="div_linhas_e">
        <div class="tablebody">
            <div class="linha">

                <div class="coluna4"> Título</div>
                <div class="coluna4"> Peso Aprox.</div>
                <div class="coluna4"> Metragem</div>
                <div class="coluna4"> Cores</div>

            </div>
            <?php if(count($produto['Item']) > 4){ echo '<div class="corpo">';}?>
                <?php
                foreach ($produto['Item'] as $item):?>
                <div class="linha">
                    <div class="coluna-impar4"><?php echo $item['titulo']?></div>
                    <div class="coluna-impar4"><?php echo $produto['Produto']['peso_bruto']?></div>
                    <div class="coluna-impar4"><?php echo $item['metragem']?></div>
                    <div class="coluna-impar4"><?php echo $item['Cor']['nome']?></div>
                </div>
                <?php endforeach;?>
            <?php if(count($produto['Item']) > 4){ echo '</div>';}?>
        </div>
    </div>
<?php endif; ?>