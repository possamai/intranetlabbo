<?PHP
$title_for_layout = __d('cake', 'Error');

$this->Html->addCrumb('Você está aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));
$this->Html->addCrumb( $title_for_layout );
?> 
<div class="row-fluid">
    <div class="span12">
        <div class="box gradient">
            <div class="title clearfix">
                <h4 class="left">
                    <span class="icon16 icomoon-icon-support "></span>
                    <span><?PHP echo $title_for_layout; ?></span>
                </h4>
            </div>
                <div class="content">
                
                    
                    <div class="alert alert-error">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                    
                        <p class="error">
                        	<strong>: </strong>
                        	<?php echo __d('cake_dev', 'The action %1$s is not defined in controller %2$s', '<em>' . $action . '</em>', '<em>' . $controller . '</em>'); ?>
                        </p>
                        <p class="error">
                        	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
                        	<?php echo __d('cake_dev', 'Create %1$s%2$s in file: %3$s.', '<em>' . $controller . '::</em>', '<em>' . $action . '()</em>', APP_DIR . DS . 'Controller' . DS . $controller . '.php'); ?>
                        </p>
                        <pre>
                        &lt;?php
                        class <?php echo $controller; ?> extends AppController {
                        
                        <strong>
                        	public function <?php echo $action; ?>() {
                        
                        	}
                        </strong>
                        }
                        </pre>
                    
                    </div>
                    
                    <?php
                    if (Configure::read('debug') > 0):
                    	echo $this->element('exception_stack_trace');
                    endif;
                    ?>
                        
                    
                
                
                </div>
            </div><!-- End .box -->
        </div><!-- End .span6 -->
</div>