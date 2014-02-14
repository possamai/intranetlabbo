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
                                <th><?PHP echo $this->Paginator->sort('categoria_produto_id', 'Categoria<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?PHP echo $this->Paginator->sort('grupo_id', 'Grupo<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?PHP echo $this->Paginator->sort('referencia', 'Referência<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?PHP echo $this->Paginator->sort('derivacao', 'Derivação<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?PHP echo $this->Paginator->sort('valor', 'Valor<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?php echo __('Ações'); ?></th>            
                            </tr>                    
                            <tr class="filter">
                            	<th><?PHP echo $this->Form->input('categoria_produto_id', array('label'=>false,'empty' => '')); ?></th>
                            	<th><?PHP echo $this->Form->input('grupo_id', array('label'=>false,'empty' => '')); ?></th>
                            	<th><?PHP echo $this->Form->input('referencia', array('label'=>false)); ?></th>
                            	<th><?PHP echo $this->Form->input('derivacao', array('label'=>false)); ?></th>
                            	<th><?PHP echo $this->Form->input('valor', array('label'=>false, 'type'=>'number')); ?></th>
                                <th>&nbsp;</th>    
                            </tr>
                        </thead>
                        <tbody>
                    
        <?php foreach ($produtos as $produto): ?>
	<tr>
		<td><?php echo $this->Html->link($produto['CategoriaProduto']['titulo'], array('controller' => 'categoria_produtos', 'action' => 'cadastro', $produto['CategoriaProduto']['id'])); ?></td>
		<td><?php echo $this->Html->link($produto['Grupo']['titulo'], array('controller' => 'grupos', 'action' => 'cadastro', $produto['Grupo']['id'])); ?></td>
		<td><?php echo h($produto['Produto']['referencia']); ?>&nbsp;</td>
		<td><?php echo h($produto['Produto']['derivacao']); ?>&nbsp;</td>
		<td><?php echo h($produto['Produto']['valor']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link( '<i class="icon16 icomoon-icon-pencil mr0"></i>', array('action' => 'cadastro', $produto['Produto']['id']), array('title'=>'Editar', 'class'=>'btn','escape' => false)); ?>
			<?php echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i>', array('action' => 'excluir', $produto['Produto']['id']), array('title'=>'Excluir', 'class'=>'btn confirmLink', 'escape' => false)); ?>
		</td>
	</tr>
<?php endforeach; ?>
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">                  
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