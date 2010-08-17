<?php if($sucesso == true):?>
<table cellspacing="0" class="details">
        <?php echo $jquery->input('Imagem.0',array('type'=>'file','label'=>'','error' => false,'div'=>false,'before' => '<tr><td class="left">Arquivo','after' => '</td></tr>','between' => '</td><td class="right" id="arquivo">'));?>
    <tr><td class="left"><a id="novoArquivo" href="#" class="linkbutton linkbtn btn_add" style="background-position: 50%"></a></td><td class="right"><?php echo $form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td></tr>
</table>
<table cellspacing="0" class="details" align="center">
        <?php foreach ($result['Imagem'] as $key => $value) {
            if(($key)%3 == 0 || $key == 0)
                echo "<tr>";
            echo "<td align='center'>".$html->image('/img_produtos/'.$value['nome'], array('align'=>'center','height'=>'130px', 'width'=>'130px;', 'margin'=>'3px'))."";
            echo " <a value='".$value['id']."' class='excluirImg linkbutton linkbtn btn_delete' style='background-position: 50%'></a></td>";
            if(($key)%3 == 0 || $key == 0)
                echo "<tr>";
        }
        ?>
</table>
<?php endif;?>