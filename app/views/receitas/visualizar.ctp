<?php ?>
<script type="text/javascript">
    $(function(){
        navegarPasso();
        $("#anterior").click(function(){
            navegarPasso($(this).attr('value'));
        });
        $("#proximo").click(function(){
            navegarPasso($(this).attr('value'));
        });
    });

    function navegarPasso(sequencia){
        var json = eval('<?php echo $itemReceita; ?>');
        if(sequencia != undefined){
            var anterior = parseInt(sequencia,10)-1;
            var proximo = parseInt(sequencia,10)+1;
            $("#anterior").attr('value',anterior);
            $("#sequencia").val(sequencia);
            $("#proximo").attr('value',proximo);
        }

        var ultimo = 0;
        $.each(json, function(i,item){
            ultimo = i;
        });

        if($("#sequencia").val() < -1){
            $("#anterior").hide();
        }else{
            $("#anterior").show();
        }

        if($("#sequencia").val() == ultimo){
            $("#proximo").hide();
        }else{
            $("#proximo").show();
        }

        $("#imgPasso").hide();
        $("#divDados").hide();
        $("#divSaudacao").hide();
        $("#divDadosEtapa").hide();
        var seqCurrent = parseInt($("#sequencia").val(),10);
        if(seqCurrent < 0){
            if(seqCurrent == -2){
                $("#imgPasso").show();
                $("#divSaudacao").show();
                $("#imgPasso").attr('src',$('#webroot').val()+'img_receitas/'+"<?=$receita['Receita']['imagem'];?>");
            }else{
                $("#divDados").show();
            }
        }else{
            $("#imgPasso").show();
            $("#divDadosEtapa").show();
            $.each(json, function(i,item){
                if(item.sequencia == $("#sequencia").val()){
                    $("#lbNomeEtapa").text(item.nome+":");
                    $("#lbDescricaoEtapa").text(item.descricao);
                    $("#imgPasso").attr('src',$('#webroot').val()+'img_receitas/'+item.imagem);
                }
            });
        }


    }
</script>

<?php if(!empty($receita)):?>
        <label style="font-size: 25px;color: #6C95B1;"><?=$receita['Receita']['nome'];?></label><br/>
        
<?php endif;?>
<br/>
<?php echo $jquery->input('sequencia',array('id'=>'sequencia','type'=>'hidden','value'=>'-2','error' => false,'div'=>false));?>

<div class="divAnterior">
    <?php echo $html->image('anterior.png', array('id'=>'anterior','value'=>-2,'align'=>'center','height'=>'36px','width'=>'36px'));?>
</div>
<div class="divCentral">
    <center>
    <?php echo $html->image('/img_receitas', array('id'=>'imgPasso','align'=>'center','height'=>'240px'));?>
        <div id="divDados" class="divDadosReceita">
            <?php if(!empty($receita['Receita']['modalidade'])):?>
                <label style="font-size: 14px;color: red;">Modalidade:</label><br>
                <?=$receita['Receita']['modalidade'];?>
            <?php endif;?>
            <?php if(!empty($receita['Receita']['obs'])):?>
                <br/><br/>
                <label style="font-size: 14px;color: red;">Obs.:</label><br>
                <?=$receita['Receita']['obs'];?>
            <?php endif;?> 
            <?php if(!empty($receita['Material'])):?>
                <br/><br/>
                <label style="font-size: 14px;color: red;">Materiais:</label><br>
                <ul>
                <?php
                        foreach ($receita['Material'] as $key => $material) {
                            echo "<li>".$material['nome']."</li>";
                        }
                ?>
                </ul>
            <?php endif;?>
        </div>
    </center>
</div>

<div class="divPosterior">
    <?php echo $html->image('proximo.png', array('id'=>'proximo','value'=>-1,'align'=>'center','height'=>'36px','width'=>'36px'));?>
</div>
<div id="divSaudacao" style="margin-top: 255px;">
    <label style="font-size: 16px;color: blue;"><?=$receita['Receita']['saudacao'];?></label>
</div>
<center>
    <div id="divDadosEtapa" class="divDadosEtapa">
        <center><label id="lbNomeEtapa" style="font-size: 12px;color: red;"></label><br/></center>
        <label id="lbDescricaoEtapa" style="font-size: 12px;color: blue;"></label>
    </div>
</center>
