<?PHP
$this->Html->addCrumb('Voc� est� aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o in�cio', 'class' => 'tip'));

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
                                <th><?PHP echo $this->Paginator->sort('categoria_arquivo_id', 'Categoria Arquivo<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?PHP echo $this->Paginator->sort('titulo', 'T�tulo<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?php echo __('A��es'); ?></th>            
                            </tr>                    
                            <tr class="filter">
                            	<th><?PHP echo $this->Form->input('categoria_arquivo_id', array('label'=>false,'empty' => '')); ?></th>
                            	<th><?PHP echo $this->Form->input('titulo', array('label'=>false)); ?></th>
                                <th>&nbsp;</th>              
                            </tr>
                        </thead>
                        <tbody>
                    
        <?php foreach ($arquivos as $arquivo): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($arquivo['CategoriaArquivo']['titulo'], array('controller' => 'categoria_arquivos', 'action' => 'cadastro', $arquivo['CategoriaArquivo']['id'])); ?>
		</td>
		<td><?php echo h($arquivo['Arquivo']['titulo']); ?>&nbsp;</td>
		<td class="actions">
            
            <?php echo $this->Html->link( '<i class="icon16 icomoon-icon-file-download mr0"></i>', array('action' => 'download', $arquivo['Arquivo']['id']), array('title'=>'Editar', 'class'=>'btn','escape' => false)); ?>
			<?php echo $this->Html->link( '<i class="icon16 icomoon-icon-eye mr0"></i>', array('action' => 'ver', $arquivo['Arquivo']['id']), array('title'=>'Visualizar', 'class'=>'btn','escape' => false)); ?>
            
            
            <?php            
            if (($userLogado['nivel_id']==1) // Eu administrador
                || ($arquivo['Arquivo']['usuario_id']==$userLogado['nivel_id']) // Eu criei
                || (in_array($arquivo['Arquivo']['usuario_id'], $arr_users_group)) // Eu criei
            ) {
                echo $this->Html->link( '<i class="icon16 icomoon-icon-pencil mr0"></i>', array('action' => 'cadastro', $arquivo['Arquivo']['id']), array('title'=>'Editar', 'class'=>'btn','escape' => false));
    			echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i>', array('action' => 'excluir', $arquivo['Arquivo']['id']), array('title'=>'Excluir', 'class'=>'btn confirmLink', 'escape' => false));
            }
            ?>
		</td>
	</tr>
<?php endforeach; ?>
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">                  
                                    <div class="pagination">
                                        <span class="span6"><?PHP echo $this->Paginator->counter(array('format' => 'Exibindo {:start} at� {:end} do total de {:count}')); ?></span>
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