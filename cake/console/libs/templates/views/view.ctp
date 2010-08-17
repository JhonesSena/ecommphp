<?php
/* SVN FILE: $Id: view.ctp 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.console.libs.templates.views
 * @since			CakePHP(tm) v 1.2.0.5234
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 22:33:52 -0800 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>

<script src="<? echo '<?php echo $this->webroot;?>' ?>js/jquery.contextmenu/jquery.contextmenu.r2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
</script>

<!-- Data Table -->
<link rel="stylesheet" href="<? echo '<?php echo $this->webroot;?>' ?>js/jquery.tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="<? echo '<?php echo $this->webroot;?>' ?>js/jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">            
    $(document).ready(function(){
        $(".tablesorter").tablesorter(); 
    });
</script>

<div class="toolbar">
<?php
	echo "\t\t<?php echo \$html->link(__('Editar', true), array('action'=>'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'linkbutton linkbtn btn_edit')); ?>\n";
	echo "\t\t<?php echo \$html->link(__('Deletar', true), array('action'=>'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'linkbutton linkbtn btn_delete'), sprintf(__('Deseja realmente apagar?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
	echo "\t\t<?php echo \$html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>\n";

	/*
	$done = array();
	foreach ($associations as $type => $data) {
		foreach($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "\t\t<?php echo \$html->link(__('Listar ".Inflector::humanize($details['controller'])."', true), array('controller'=> '{$details['controller']}', 'action'=>'index'),array('class'=>'linkbutton linkbtn btn_list')); ?>\n";
				echo "\t\t<?php echo \$html->link(__('Novo ".Inflector::humanize(Inflector::underscore($alias))."', true), array('controller'=> '{$details['controller']}', 'action'=>'add'),array('class'=>'linkbutton linkbtn btn_add')); ?>\n";
				$done[] = $details['controller'];
			}
		}
	}
	*/
?>
</div>

<div id="tabpanel">
    <ul>
        <li><a href="#tab1"><span><?echo '<?php echo __("Visualizar '.$singularHumanName.'",true) ?>'?></span></a></li><?php
	$done = array();
        $qtd = 2;
        
	foreach ($associations as $type => $data) {
                if($type!="belongsTo"){
                    foreach($data as $alias => $details) {
                            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                                    echo '<li><a href="#tab'.$qtd.'"><span>'.Inflector::humanize($details['controller']).'</span></a></li>';
                                    $qtd++;
                                    $done[] = $details['controller'];
                            }
                    }
                }
	}
        ?></ul>
    <div id="tab1">
        <table cellspacing="0" class="details">
            <?php
            foreach ($fields as $field) {
                    $isKey = false;
                    if(!empty($associations['belongsTo'])) {
                            foreach ($associations['belongsTo'] as $alias => $details) {
                                    if($field === $details['foreignKey']) {
                                            $isKey = true;
                                            echo "\t\t<tr><td class=\"left\"><?php __('".Inflector::humanize(Inflector::underscore($alias))."'); ?></td><td class=\"right\">";
                                            echo "<?php echo \${$singularVar}['{$alias}']['{$details['displayField']}']; ?></td></tr>";
                                            break;
                                    }
                            }
                    }
                    if($isKey !== true) {
                            echo "\t\t<tr><td class=\"left\"><?php __('".Inflector::humanize($field)."'); ?></td><td class=\"right\">";
                            echo "\t\t\n\t\t\t<?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?></td></tr>";
                    }
            }
            ?>
            
            
        </table>
    </div>
    
    <?php
    $qtd = 2;
    
    if(!empty($associations['hasOne'])) :
            foreach ($associations['hasOne'] as $alias => $details): ?>
            <div id="tab<? echo $qtd;$qtd++; ?>">
                 <table cellspacing="0" class="details">
                    <tr>
                        <th colspan="2">Detalhes<th>
                    </tr>
            <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
            <?php
                            foreach ($details['fields'] as $field) {
                                    echo "\t\t<tr><td class=\"left\"><?php __('".Inflector::humanize($field)."');?></td>";
                                    echo "<td class=\"right\"><?php echo \${$singularVar}['{$alias}']['{$field}'];?></td></tr>";
                            }
            ?>
                    
                </table>
                <?php echo "<?php endif; ?>\n";?>            
                <?php echo "<?php echo \$html->link(__('Editar ".Inflector::humanize(Inflector::underscore($alias))."', true), array('controller'=> '{$details['controller']}', 'action'=>'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}']),array('class'=>'linkbutton linkbtn btn_edit')); ?>\n";?>
            </div>
            <?php
            endforeach;
    endif;

    if(empty($associations['hasMany'])) {
            $associations['hasMany'] = array();
    }
    if(empty($associations['hasAndBelongsToMany'])) {
            $associations['hasAndBelongsToMany'] = array();
    }
    $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
    $i = 0;
    foreach ($relations as $alias => $details):
            $otherSingularVar = Inflector::variable($alias);
            $otherPluralHumanName = Inflector::humanize($details['controller']);
            ?>

<?/*            
<!-- ContextMenu -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.ctxmenu-tab<? echo $qtd ?>').contextMenu('contextMenuList-tab<? echo $qtd ?>', {
            bindings: {
                'view': function(t) {
                    location.href="<? echo '<?php echo $html->url(array(\'controller\'=> \''.$details['controller'].'\', \'action\'=>\'view\'))?>' ?>/"+t.id;
                },
                'edit': function(t) {
                    location.href="<? echo '<?php echo $html->url(array(\'controller\'=> \''.$details['controller'].'\', \'action\'=>\'edit\'))?>' ?>/"+t.id;
                },
                'delete': function(t) {
                    if(confirm("Deseja realmente apagar?")){
                        location.href="<? echo '<?php echo $html->url(array(\'controller\'=> \''.$details['controller'].'\', \'action\'=>\'delete\'))?>' ?>/"+t.id;
                    }
                }
            }
        });
    });
</script>

<div class="contextMenu" id="contextMenuList-tab<? echo $qtd ?>">
    <ul>
      <li id="view"><img src="<? echo '<?php echo $this->webroot;?>' ?>css/img/visualizar.gif"/>Visualizar</li>
      <li id="edit"><img src="<? echo '<?php echo $this->webroot;?>' ?>css/img/edit.gif"/>Editar</li>
      <li id="delete"><img src="<? echo '<?php echo $this->webroot;?>' ?>css/img/delete.gif"/>Excluir</li>
    </ul>
</div>
*/?>            
    <div id="tab<? echo $qtd ?>">
            <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
            <table id="myTable<? echo $qtd; ?>" class="tablesorter" cellspacing="1"> 
            <thead> 
               <tr>
                <?php
                    foreach ($details['fields'] as $field) {
                            echo "<th><?php __('".Inflector::humanize($field)."'); ?></th>";
                    }
                ?>
                </tr>
            </thead> 
            <tfoot> 
                <tr>
                <?php
                    foreach ($details['fields'] as $field) {
                            echo "<th><?php __('".Inflector::humanize($field)."'); ?></th>";
                    }
                ?>
                </tr>
            </tfoot> 
            <tbody>
    <?php
    echo "<?php
                    \$i = 0;
                    foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}):
                            \$class = null;
                            if (\$i++ % 2 == 0) {
                                    \$class = ' class=\"altrow\"';
                            }
                    ?>\n";
                    echo "<tr<?php echo \$class;?>>";

                                    foreach ($details['fields'] as $field) {
											/*
                                            if($details['displayField']==$field){
                                                echo "<td><?php echo \$html->link(\${$otherSingularVar}['{$field}'], array('controller'=>'".$details['controller']."','action'=>'view', \${$otherSingularVar}['{$details['primaryKey']}']), array('class'=>'ctxmenu-tab{$qtd}','id'=>\${$otherSingularVar}['{$details['primaryKey']}'])); ?></td>\n";
                                            }else{
                                                echo "<td><?php echo \${$otherSingularVar}['{$field}'];?></td>\n";
                                            }
											*/
											echo "<td><?php echo \${$otherSingularVar}['{$field}'];?></td>\n";
                                    }

                            echo "</tr>\n";

    echo "\t<?php endforeach;?>";$qtd++;
    ?>
            </tbody>
            </table>
    <?php echo "<?php endif; ?>\n\n";?>
            
    <?/*php echo "<?php echo \$html->link(__('Novo ".Inflector::humanize(Inflector::underscore($alias))."', true), array('controller'=> '{$details['controller']}', 'action'=>'add'),array('class'=>'linkbutton linkbtn btn_add'));?>";*/?>

    </div>
    <?php endforeach;?>
    
    
    
</div>
