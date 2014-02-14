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
<?PHP echo "<?PHP
\$this_page = 'Cadastro';
\$this->Html->addCrumb('Você está aqui:');
\$this->Html->addCrumb('<span class=\"icon16 icomoon-icon-screen-2\"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));

\$this->Html->addCrumb( \$title_for_layout, \$base_url );
\$this->Html->addCrumb( \$this_page );
?>
"; ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="title">
                <h4><span><?PHP echo "<?php echo __( \$this_page ); ?>"; ?></span></h4>   
            </div>
            
            <div class="content">
                <?PHP echo "<?php echo \$this->Session->flash(); ?>"; ?>
    
                <?php
                echo "
                <?PHP
                echo \$this->Form->create('{$modelClass}', array(
                    'class'=>'form-horizontal',
                    'inputDefaults' => array(
                        'class' => 'span9',
                        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                        'div' => false,
                        'label' => array('class' => 'form-label span3'),
                        'before' => '<div class=\"row-fluid\">',
                        'after' => '</div>',
                        'error' => array('attributes' => array('wrap' => 'label', 'class' => 'error')),
                    )
                ));
                ?>";
                
        		foreach ($fields as $field) {
        			if (!in_array($field, array('created', 'modified', 'updated'))) {
                        if ($field=='id') {
                            echo"<?PHP echo \$this->Form->input('{$field}'); ?>";
                        } else {
                            echo "
                    <div class=\"form-row row-fluid\">
                        <div class=\"span12\"><?PHP echo \$this->Form->input('{$field}'); ?></div>
                    </div>";
                        }
        				
        			}
        		}
        		if (!empty($associations['hasAndBelongsToMany'])) {
        			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
        				echo "
                    <div class=\"form-row row-fluid\">
                        <div class=\"span12\"><?PHP echo \$this->Form->input('{$field}'); ?></div>
                    </div>";
        			}
        		}
                ?>             
                
                
                <div class="form-actions"><?PHP echo "<?PHP echo \$this->element('botoes_formulario'); ?>"; ?></div>
                
                <?PHP echo "<?PHP echo \$this->Form->end(array('class' => 'hidden nostyle', 'div'=>false)); ?>"; ?>   

            </div><!-- End .content -->
        </div><!-- End .box -->
    </div><!-- End .span12 -->
</div>