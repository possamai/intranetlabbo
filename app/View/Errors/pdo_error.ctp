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
                                <strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
                                <?php echo $name; ?>
                        </p>
                        <?php if (!empty($error->queryString)) : ?>
                                <p class="notice">
                                        <strong><?php echo __d('cake_dev', 'SQL Query'); ?>: </strong>
                                        <?php echo h($error->queryString); ?>
                                </p>
                        <?php endif; ?>
                        <?php if (!empty($error->params)) : ?>
                                        <strong><?php echo __d('cake_dev', 'SQL Query Params'); ?>: </strong>
                                        <?php echo Debugger::dump($error->params); ?>
                        <?php endif; ?>
                    
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