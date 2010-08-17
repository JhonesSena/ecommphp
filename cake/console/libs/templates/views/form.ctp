<?php
/* SVN FILE: $Id: form.ctp 6311 2008-01-02 06:33:52Z phpnut $ */
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

<? 
foreach ($schema as $tipo) {
    if($tipo['type']=='date' || $tipo['type']=='datetime'){
        echo '<? echo $jquery->init_date(); ?>';
        break;
    }
}
?>

<script type="text/javascript">
    $(function(){
        $('#tabpanel').tabs();
    });
</script>

<div class="toolbar">
<?php echo "<?php echo \$html->link(__('Voltar', true), array('action'=>'index'),array('class'=>'linkbutton linkbtn btn_list'));?>";?>
<?php
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
        <li>
	<? if ($action == 'add') {?>
		<a href="#tab1"><span><?echo '<?php echo __("Novo '.$singularHumanName.'",true) ?>'?></span></a>
	<?}else{?>
		<a href="#tab1"><span><?echo '<?php echo __("Editar '.$singularHumanName.'",true) ?>'?></span></a>
	<?}?>
		</li>
	
    </ul>
    <div id="tab1">
        <?php echo "<?php echo \$form->create('{$modelClass}');?>\n";?>
		<?
		echo '
			<? if(!empty($jquery->validationErrors)){ ?>
			<div class="ui-widget">
				<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
					<br>
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
					<? 
					if ($session->check(\'Message.flash\')){
						$session->flash();
						echo "<br>";
					}
					foreach($jquery->validationErrors as $model){
						foreach($model as $campo=>$valor){
							echo $jquery->label($campo).": ".$valor."<br>";
						}
					}
					?>
					<br>
				</div>
			</div>
			<?}?>
		';
		?>
        
        <table cellspacing="0" class="details">
        <?php
                        echo "\t<?php\n";
                        foreach ($fields as $field) {
                                if ($action == 'add' && $field == $primaryKey) {
                                        continue;
                                } elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                                        echo "\t\techo \$jquery->input('{$field}',array('error' => false,'div'=>false,'before' => '<tr><td class=\"left\">','after' => '</td></tr>','between' => '</td><td class=\"right\">'));\n";
                                }
                        }
                        if(!empty($associations['hasAndBelongsToMany'])) {
                                foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                                        echo "\t\techo \$jquery->input('{$assocName}',array('error' => false,'div'=>false,'before' => '<tr><td class=\"left\">','after' => '</td></tr>','between' => '</td><td class=\"right\">'));\n";
                                }
                        }
                        echo "\t?>\n";
        ?>
        <?php
        echo "<tr><td class=\"left\"></td><td class=\"right\"><?php echo \$form->submit(__('Salvar',true),array('style'=>'font-size:11px','class'=>'formbtn btn_salvar'));?></td>\n";
        ?>
                </tr>
        </table>
        <? echo "<?php echo \$form->end();?>\n"; ?>
    </div>
</div>
