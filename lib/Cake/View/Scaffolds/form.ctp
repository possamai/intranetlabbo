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
<div class="row-fluid">
    <div class="span12">
        <div class="social-box">
            <div class="header">
                <h4><?php echo __d('cake', $singularHumanName); ?></h4>
            </div>
            <div class="body">
           
           <?php
            	echo $this->Form->create(null, array(
                        'class'=>'form-horizontal',
                        'inputDefaults' => array(
                            'class' => 'span8',
                            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                            'div' => array('class' => 'control-group'),
                            'label' => array('class' => 'control-label'),
                            'between' => '<div class="controls">',
                            'after' => '</div>',
                            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
                        )
                    ));
            	echo $this->Form->inputs($scaffoldFields, array('created', 'modified', 'updated'));
        		echo $this->Form->end(
                        array(
                            'class' => 'btn btn-primary',
                            'label' => 'Salvar',
                            'div' => array(
                                'class' => 'form-actions',
                            )
                        ) 
                );                
            ?>
                                 
            </div>
        </div>
    </div>
</div>