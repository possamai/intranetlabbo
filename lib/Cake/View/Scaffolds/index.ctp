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
echo $this->Html->css(array('../js/plugins/jquery.footable/footable.core.css'), null, array('inline' => false));
?> 

<div class="row-fluid">

    <div class="span12">
      <div class="social-box">       
        <div class="header">
            <div class="btn-group hidden-phone">
                <?php echo $this->Html->link( '<i class="icon-pencil"></i> Novo', array('action' => 'cadastro'), array('title'=>'Novo', 'class'=>'btn btn-primary', 'escape' => false)); ?>
            </div>
        
            <!-- BEGIN TABLE TOOLS
            <div class="tools">
                <button class="btn btn-success" data-toggle="collapse" data-target="#advanced-search"><i class="icon-filter"></i> Advanced Search</button>
                <div class="btn-group">
                    <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i></button>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="#">Print</a></li>
                      <li><a href="#">Save as PDF</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Export to Excel</a></li>
                    </ul>
                </div>
            </div>
            <!-- END TABLE TOOLS -->
        
          </div>
          
          <div class="body">
            <?php echo $this->Session->flash(); ?>
            
            <table class="table table-bordered table-striped table-hover footable">
              <thead>
                <tr>
                
        			<?php foreach ($scaffoldFields as $_field): ?>
                    	<th><?php echo $this->Paginator->sort($_field); ?></th>
                    <?php endforeach; ?>
            
        			<th><?php echo __('Ações'); ?></th>              
                </tr>
              </thead>
              <tbody>
              <?php
                foreach (${$pluralVar} as ${$singularVar}):
                	echo '<tr>';
                		foreach ($scaffoldFields as $_field) {
                			$isKey = false;
                			if (!empty($associations['belongsTo'])) {
                				foreach ($associations['belongsTo'] as $_alias => $_details) {
                					if ($_field === $_details['foreignKey']) {
                						$isKey = true;
                						echo '<td>' . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . '</td>';
                						break;
                					}
                				}
                			}
                			if ($isKey !== true) {
                				echo '<td>' . h(${$singularVar}[$modelClass][$_field]) . '</td>';
                			}
                		}
                
                		echo '<td class="actions">';
                		
                        echo $this->Html->link( '<i class="coloredicon application-edit"></i>', array('action' => 'cadastro', ${$singularVar}[$modelClass][$primaryKey]), array('title'=>'Editar', 'class'=>'btn','escape' => false));
                        echo $this->Html->link( '<i class="coloredicon application-delete"></i>', array('action' => 'excluir', ${$singularVar}[$modelClass][$primaryKey]), array('title'=>'Excluir', 'class'=>'btn confirmLink', 'escape' => false));

                		echo '</td>';
                	echo '</tr>';
                
                endforeach;
                
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5">                  
                    <div class="pagination">
                        <span class="span6">
                            <?php echo $this->Paginator->counter(array('format' => 'Exibindo {:start} até {:end} do total de {:count}')); ?>
                        </span>
                        <span class="span6">
                            <div class="right">
                            <ul>
                            	<?php
                        		echo $this->Paginator->first( '&laquo;', array('tag' => 'li', 'class'=> 'first', 'escape'=>false), null, array('class' => 'disabled first', 'tag' => 'li', 'escape'=>false));
                        		echo $this->Paginator->prev( '&lsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled', 'tag' => 'li', 'escape'=>false));
                                
                        		echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active','tag' => 'li'));
                                
                        		echo $this->Paginator->next( '&rsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled','tag' => 'li', 'escape'=>false));
                        		echo $this->Paginator->last( '&raquo;', array('tag' => 'li', 'class'=>'last', 'escape'=>false), null, array('class' => 'disabled last','tag' => 'li', 'escape'=>false));
                        	   ?>
                            </ul>
                            </div>
                        </span>
                    </div>
                  </td>
                </tr>
              </tfoot>
            </table>

          </div>
      
      
  </div>
</div>
</div>