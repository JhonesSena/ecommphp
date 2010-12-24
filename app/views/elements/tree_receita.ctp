<?php
echo '<ul>
        <li id="phtml_1" class="open" rel="item"><a href="#"><ins> </ins>'.$receita['Receita']['nome'].'</a>
            <ul>';
    foreach ($receita['ItemReceita'] as $value){
       echo '<li id="'.$value['id'].'" rel="subitem"><a href="#"><ins> </ins>'.$value['nome'].'</a></li>';
    }
    echo '</ul>
            </li>
          </ul>';
?>