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
            $("#anterior").attr('value',parseInt(sequencia-1),10);
            $("#sequencia").val(sequencia);
            $("#proximo").attr('value',parseInt(sequencia+1),10);
        }

        $.each(json, function(i,item){
            ultimo = i;
        });

        if($("#sequencia").val() == 0){
            $("#anterior").hide();
        }else{
            $("#anterior").show();
        }

        if($("#sequencia").val() == ultimo){
            $("#proximo").hide();
        }else{
            $("#proximo").show();
        }

        $.each(json, function(i,item){
            if(item.sequencia == $("#sequencia").val()){
                $("#imgPasso").attr('src',$('#webroot').val()+'img_receitas/'+item.imagem);
            }
        });


    }
</script>

<?php if(!empty($receita)):?>
        <label style="font-size: 25px;color: #6C95B1;"><?=$receita['Receita']['nome'];?></label><br/>
        
<?php endif;?>
<br/>
<?php echo $jquery->input('sequencia',array('id'=>'sequencia','type'=>'hidden','value'=>'0','error' => false,'div'=>false));?>

<div class="divAnterior">
    <?php echo $html->image('anterior.png', array('id'=>'anterior','value'=>0,'align'=>'center','height'=>'36px','width'=>'36px'));?>
</div>
<div class="divCentral">
    <?php echo $html->image('/img_receitas', array('id'=>'imgPasso','align'=>'center','height'=>'240px'));?>
</div>
<div class="divPosterior">
    <?php echo $html->image('proximo.png', array('id'=>'proximo','value'=>1,'align'=>'center','height'=>'36px','width'=>'36px'));?>
</div>