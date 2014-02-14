<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Scaffolds
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?PHP
echo "<?PHP
\$this->Html->addCrumb('Você está aqui:');
\$this->Html->addCrumb('<span class=\"icon16 icomoon-icon-screen-2\"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));

\$this->Html->addCrumb( \$title_for_layout, \$base_url  );
?>
"; ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box gradient">
            <div class="title clearfix">
                <h4 class="left">
                    <span class="icon16 icomoon-icon-table "></span>
                    <span>Lista</span>
                </h4>
            </div>
                <div class="content">
                    <?PHP echo "<?PHP echo \$this->Session->flash(); ?>"; ?>
                          
                    <?PHP
                    echo "
                    <?PHP
                    echo \$this->Form->create(\"Filter\", array(
                                'url' => \$base_url,
                                'inputDefaults' => array(
                                    'format' => array('label', 'input'),
                                    'div' => false,
                                    'autocomplete'=>'off'
                                )
                    ));
                    ?>
                    "; ?>
                    
                    
                    <?PHP echo "<?PHP echo \$this->element('header_listagem'); ?>"; ?>
                    
                    <table class="table table-bordered">
                        <thead>
                          <tr class="head-table">
                                <?php foreach ($fields as $field): ?>
<th><?php echo "<?PHP echo \$this->Paginator->sort('{$field}', '". Inflector::humanize($field) ."<span class=\"order\"></span>', array('escape' => false)); ?>"; ?></th>
                                <?php endforeach; ?>            
                                <th style="width: 200px;"><?PHP echo "<?php echo __('Ações'); ?>"; ?></th>            
                            </tr>                    
                            <tr class="filter">
                                <?php foreach ($fields as $field): ?>
<?php echo "<th><?PHP echo \$this->Form->input('{$field}', array('label'=>false". (($field=='id')? ",'class' => 'integer', 'type'=>'number'" :'') .")); ?></th>\n"; ?>
                            	<?php endforeach; ?>
                                <th>&nbsp;</th>              
                            </tr>
                        </thead>
                        <tbody>
                    
        <?php
    	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
    	echo "\t<tr>\n";
    		foreach ($fields as $field) {
    			$isKey = false;
    			if (!empty($associations['belongsTo'])) {
    				foreach ($associations['belongsTo'] as $alias => $details) {
    					if ($field === $details['foreignKey']) {
    						$isKey = true;
    						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
    						break;
    					}
    				}
    			}
    			if ($isKey !== true) {
    				echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
    			}
    		}
    
    		echo "\t\t<td class=\"actions\">\n";
            echo "\t\t\t<?php echo \$this->Html->link( '<i class=\"icon16 icomoon-icon-pencil mr0\"></i>', array('action' => 'cadastro', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('title'=>'Editar', 'class'=>'btn','escape' => false)); ?>\n";
            echo "\t\t\t<?php echo \$this->Html->link( '<i class=\"icon16 icomoon-icon-remove mr0\"></i>', array('action' => 'excluir', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('title'=>'Excluir', 'class'=>'btn confirmLink', 'escape' => false)); ?>\n";
    		echo "\t\t</td>\n";
    	echo "\t</tr>\n";
    
    	echo "<?php endforeach; ?>\n";
    	?>
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="<?PHP echo count($fields)+1; ?>">                  
                                    <div class="pagination">
                                        <span class="span6"><?PHP echo "<?PHP echo \$this->Paginator->counter(array('format' => 'Exibindo {:start} até {:end} do total de {:count}')); ?>"; ?></span>
                                        <span class="span6">
                                            <div class="right">
                                                <ul>
                                                    <?php
                                                    echo "
                                                    <?php
                                                    echo \$this->Paginator->first( '&laquo;', array('tag' => 'li', 'class'=> 'first', 'escape'=>false), null, array('class' => 'disabled first', 'tag' => 'li', 'escape'=>false));
                                                    echo \$this->Paginator->prev( '&lsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled', 'tag' => 'li', 'escape'=>false));
                                                    
                                                    echo \$this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active','tag' => 'li'));
                                                    
                                                    echo \$this->Paginator->next( '&rsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled','tag' => 'li', 'escape'=>false));
                                                    echo \$this->Paginator->last( '&raquo;', array('tag' => 'li', 'class'=>'last', 'escape'=>false), null, array('class' => 'disabled last', 'tag' => 'li', 'escape'=>false));
                                                    ?>
                                                    "; ?>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        
                    </table>
                    <?PHP echo "<?PHP echo \$this->Form->end(); ?>"; ?>   
                </div>
            </div><!-- End .box -->
        </div><!-- End .span6 -->
</div>