<?php ?>
<div style="min-height: 510px;">
    <div class="div_migalha_de_pao">
        <div class="div_linhas_a-d"></div>
        <span class="migalha_de_pao">Representantes</span> </div>
    <div>
        <?=$html->image('/img/1x18px.gif', array('height'=>'6px','width'=>'100px'));?>
    </div>
    <div class="div_representantes_1e3"> </div>
    <div class="div_representantes_2"> <br>
        <span class="titulo_azul">Fale com nosso representante!</span> <br>
        <br>
        Possuímos representantes em diversos estados no  Brasil (verifique as áreas
        escuras do mapa).
        <br>
        <br>
        Entre em contato conosco.<br>
        <br>
        <?php if(!empty($empresa['ContatosEmpresa'])):
        foreach ($empresa['ContatosEmpresa'] as $key => $contato) :?>
            <strong><?=$contato['tipo'];?>:</strong> <?=$contato['valor'];?><strong> </strong>
            <br/><br/>
        <?php endforeach;
        endif;
        ?>
    </div>
    <div class="div_representantes_4">
        <?=$html->image('/img/mapa.gif', array('height'=>'485px','width'=>'477px'));?>
    </div>
    <!--div class="div_representantes_1e3"> </div-->
</div>