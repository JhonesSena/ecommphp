
<script src="<?php echo $this->webroot;?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();

        $("#divItens").dialog({
            bgiframe: true,
            height: 450,
            width: 680,
            modal: true,
            autoOpen: false,
            autoClose: false
        });

        reload();
    });
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".tablesorter").tablesorter();

        $('.dialogItens').click(function(){
            carregarItens($(this).attr('value'));
        });

        $('#verCarrinho').click(function(){
            location.href = "<?php echo $html->url(array('action'=>'visualizarCarrinho'))?>";
//            window.location = $('#webroot').val()+"shopps/carrinho";
        });

        $().ajaxStart(function() {
            $('#dialog').dialog('open');
        });

        $().ajaxStop(function() {
            $('#dialog').dialog('close');
        });
    });

    function direcionar(){
        var grupo_id = $('#ControleFilterID').val();

        window.location="<?php echo $html->url('/'.$this->params['controller'].'/index')?>/"+grupo_id;
    }

    function carregarItens(id){
        $.ajax({
            type: "get",
            async: true,
            beforeSend: function(){
                $('#dialog').html("<div style='text-align:center;' ><img src='<?php echo $this->webroot;?>img/ajax_preloader.gif'/></div>");
                $('#dialog').dialog('open');
            },
            complete: function(){
                $('#dialog').dialog('close');
            },
            error: function(){
                location.href="";
            },
            url: '<?php echo $this->webroot;?>ajax/carrega_itens_by_produto/'+id,
            success: function(msg){
                $('#divItens').html(msg);
                var height = parseInt($('#qtdeItem').val())*20 + 270;
                if(height > 450)
                    height = 450;
                $("#divItens").dialog({
                    height: height
                });
                $('#divItens').dialog('open');
                reload();
            }
        });
    }
    function reload(){
        $("form").submit(function() {
            $.ajax({
                type: 'post',
                async:false,
                data: $(this).serialize(),
                url: $(this).attr('action'),
                beforeSend: function(){
                    $('#dialog').dialog('open');
                },
                complete: function(){
                    $('#dialog').dialog('close');
                },
                success: function(data){
                    $('#divItens').dialog('close');
                }
            });
            return false;
        });
    }
</script>

<!-- Div de janela modal para listagem de itens.-->
<div id="divItens" title="Itens">
</div>
<div id="tabpanel">
    
    <!--Filtro de busca-->
    <div style="float: right" >
        <?php echo $form->create(array('action'=>'index'))?>
        <table>
            <tr>
                <td><?php echo $jquery->input('inativo',array('id'=>'ControleFilterID', 'value'=>$grupo, 'empty'=>'Todos','label'=>'Grupo ', 'class'=>'filter_select','options'=>$grupos,'showEmpty'=>false,'alt'=>'Filtro','error' => false,'div'=>false, 'onchange'=>'direcionar()'));?></td>
                <!--<td class="left"></td><td class="right"><input type="button" id="next" value="Pesquisar" style="font-size:11px" class="linkbtn btn_buscar"></td>-->
            </tr>
        </table>
        <?php echo $form->end();?>
    </div>
    <table cellspacing="0" class="details">
        <tr><td colspan="2" style="text-align: center;">
                <label style="font-size: 20px; margin-bottom: 20px; color: #2E6E9E;">
                    Simule uma compra
                </label>
            </td>
        </tr>
        <?php
        $i = 0;
        $col = 2;
        ?>
        <?php echo "<td align='center' colspan='2'>".$html->image('/img/shoppingcart_lg_wht.gif', array('id'=>'verCarrinho','style'=>'cursor: pointer;','align'=>'center','height'=>'60px','alt'=>'Ver carrinho'))."<br/><b style='color: blue;'>Carrinho</b></td>";?>
        <?php foreach ($produtos as $key => $produto) { ?>
            <?php if(($i % $col) == 0) echo '<tr align="center">';
            $primeiro = true;?>
        <td style="font-weight: bold"><br/><br/><br/>
                <?php
                $id = $produto['Produto']['id'];
                $msgDesconto = '';
                
                if(number_format(str_replace(',','.',$produto['Preco'][0]['desconto_por_pacote'])) > 0){
                    $desconto = $produto['Preco'][0]['desconto_por_pacote'];
                    $pacote = $produto['Preco'][0]['pacote'];
                    $msgDesconto = "<br/><b style='color:red'>Desconto de $desconto % por cada pacote fechado com $pacote unidades.</b>";
                }


                if(isset($produto['Imagem']['0'])) {
                    echo $html->image('/'.$produto['Imagem']['0']['diretorio'].'/'.$produto['Imagem']['0']['nome'], array('value'=>$id, 'class'=>'dialogItens', 'align'=>'center','height'=>'100px'))
                            .'<br/>Cód.'.$produto['Produto']['codigo'].' '.$produto['Produto']['descricao']
                            .'<br/>'.$produto['Preco'][0]['preco']
                            .$msgDesconto
                            ."<br/> <a style='cursor: pointer; color:blue' value='$id' class='dialogItens'>Comprar</a>";
                }
                else {
                    echo $html->image('/img/sem_imagem.jpg', array('value'=>$id, 'class'=>'dialogItens','align'=>'center','height'=>'100px', 'width'=>'100px;'))
                            .'<br/>Cód.'.$produto['Produto']['codigo'].' '.$produto['Produto']['descricao']
                            .'<br/>'.$produto['Preco'][0]['preco']
                            .$msgDesconto
                            ."<br/> <a style='color:blue' value='$id' class='dialogItens'>Comprar</a>";
                }

                ?>
            <br/><br/><br/>
        </td>
            <?php if(($i % $col) == 0 && $primeiro == false) echo '</tr>';?>
            <?php $i++;
            $primeiro = false;
        }?>
        <tr>
            <td colspan="<?php echo $col;?>" align="center">
                <?
                $total = $paginator->counter(array('format' => '%pages%', true));
                if($total!=1) {
                    echo "&nbsp;";
                    $ant  = $paginator->current()-1;
                    $prox = $paginator->current()+1;

                    $sort = isset($paginator->params['named']['sort'])?'/sort:'. $paginator->params['named']['sort']:"";
                    $direction = isset($paginator->params['named']['direction'])?'/direction:'. $paginator->params['named']['direction']:"";

                    echo $html->link(__(null,true), 'index/'.$grupo.'/page:'.$ant.$sort.$direction,array('class'=>'linkbutton linkbtn btn_back'))."&nbsp;";
                    echo '<select style="height:22px;font-size:13px" onchange="location.href=\''. $this->webroot.'shopps/index/'.$grupo.'/page:\'+this.value+\''.$sort.$direction.'\'">';
                    for($x=1;$x<=$total;$x++) {
                        echo $x==$paginator->current()?"<option selected value=\"$x\">".$x."</option>":"<option value=\"$x\">".$x."</option>";
                    }
                    echo "</select>&nbsp;";
                    echo $html->link(__(null,true), 'index/'.$grupo.'/page:'.$prox.$sort.$direction,array('class'=>'linkbutton linkbtn btn_go'));
                }
                ?>
            </td>
        </tr>
    </table>
</div>
