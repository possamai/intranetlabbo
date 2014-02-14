<?PHP
$this->Html->addCrumb('Você está aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));

$this->Html->addCrumb( $title_for_layout, $base_url  );
?>
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
                    <?PHP echo $this->Session->flash(); ?>                          
                    
                    <?PHP
                    echo $this->Form->create("Filter", array(
                                'url' => $base_url,
                                'inputDefaults' => array(
                                    'format' => array('label', 'input'),
                                    'div' => false,
                                    'autocomplete'=>'off'
                                )
                    ));
                    ?>
                                        
                    
                    <?PHP echo $this->element('header_listagem'); ?>                    
                    <table class="table table-bordered">
                        <thead>
                          <tr class="head-table">
                                <th><?PHP echo $this->Paginator->sort('titulo', 'Título<span class="order"></span>', array('escape' => false)); ?></th>        
                                <th><?php echo __('Ações'); ?></th>            
                            </tr>                    
                            <tr class="filter">
                            	<th><?PHP echo $this->Form->input('titulo', array('label'=>false)); ?></th>
                            	<th>&nbsp;</th>              
                            </tr>
                        </thead>
                        <tbody>
                    
        <?php foreach ($niveis as $nivel): ?>
	<tr>
		<td><?php echo h($nivel['Nivel']['titulo']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link( '<i class="icon16 icomoon-icon-pencil mr0"></i>', array('action' => 'cadastro', $nivel['Nivel']['id']), array('title'=>'Editar', 'class'=>'btn','escape' => false)); ?>
			<?php echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i>', array('action' => 'excluir', $nivel['Nivel']['id']), array('title'=>'Excluir', 'class'=>'btn confirmLink', 'escape' => false)); ?>
		</td>
	</tr>
<?php endforeach; ?>
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">                  
                                    <div class="pagination">
                                        <span class="span6"><?PHP echo $this->Paginator->counter(array('format' => 'Exibindo {:start} até {:end} do total de {:count}')); ?></span>
                                        <span class="span6">
                                            <div class="right">
                                                <ul> 
                                                    <?php
                                                    echo $this->Paginator->first( '&laquo;', array('tag' => 'li', 'class'=> 'first', 'escape'=>false), null, array('class' => 'disabled first', 'tag' => 'li', 'escape'=>false));
                                                    echo $this->Paginator->prev( '&lsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled', 'tag' => 'li', 'escape'=>false));
                                                    
                                                    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active','tag' => 'li'));
                                                    
                                                    echo $this->Paginator->next( '&rsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled','tag' => 'li', 'escape'=>false));
                                                    echo $this->Paginator->last( '&raquo;', array('tag' => 'li', 'class'=>'last', 'escape'=>false), null, array('class' => 'disabled last', 'tag' => 'li', 'escape'=>false));
                                                    ?>
                                                    </ul>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        
                    </table>
                    <?PHP echo $this->Form->end(); ?>   
                </div>
            </div><!-- End .box -->
        </div><!-- End .span6 -->
</div>