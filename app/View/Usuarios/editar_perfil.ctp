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
                    <span>Perfil</span>
                </h4>
            </div>
                <div class="content">
                    
                    <?php echo $this->Session->flash(); ?>    
                
                    <?PHP
                    echo $this->Form->create('Usuario', array(
                        'type' => 'file',
                        'class'=>'form-horizontal seperator',
                        'inputDefaults' => array(
                            'class' => 'span4',
                            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                            'div' => false,
                            'label' => array('class' => 'form-label span3'),
                            'before' => '<div class="row-fluid">',
                            'after' => '</div>',
                            'error' => array('attributes' => array('wrap' => 'label', 'class' => 'error')),
                        )
                    ));
                    $usuario = $this->request->data['Usuario'];
                    ?>
                    
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('login', array('disabled'=>'disabled', 'name'=>false)); ?></div>
                            </div>
                            
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('nome'); ?></div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('email', array('class'=>'email span4')); ?></div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('password', array('value' => '', 'autocomplete'=>'off')); ?></div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('telefone', array('class'=>'telefone span4')); ?></div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('celular', array('class'=>'telefone span4')); ?></div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12"><?PHP echo $this->Form->input('ramal', array('class'=>'span4')); ?></div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <?PHP echo $this->Form->input('data_nascimento', 
                                            array(
                                               'class'=>'datepicker span4',
                                               'type'=>'text'
                                            )); ?>
                                </div>                   
                            </div>
                            
                            <div class="form-row row-fluid">
                                    <div class="row-fluid">
                                        <?PHP echo $this->Form->input('foto', array( 'type' => 'file',
                                                                                    'class' => 'marginR10',
                                                                                    'label' => array('text'=>'Foto','class' => 'form-label span3'),
                                                                                    'before' => false,
                                                                                    'after' => false
                                        ));
                                        
                                        if ($usuario['foto']) {
                                        ?>
                                        <div class="span12">
                                            <label class="form-label span3">&nbsp;</label>
                                            <div class="marginT10 span9">
                                                <img src="<?php echo $this->webroot . 'files/usuario/foto/' . $usuario['foto']; ?>" alt="" class="image"/><br />
                                                <?php echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i> Remover', array('action' => 'remover_foto_perfil'), array('title'=>'Excluir', 'class'=>'btn confirmLink marginT10 ', 'escape' => false)); ?>
                                            </div>
                                        </div>
                                        <?PHP } ?>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                    <div class="row-fluid">
                                        <?PHP echo $this->Form->input('assinatura', array( 'type' => 'file',
                                                                                    'class' => 'marginR10',
                                                                                    'label' => array('text'=>'Assinatura digital','class' => 'form-label span3'),
                                                                                    'before' => false,
                                                                                    'after' => false
                                        ));
                                        
                                        if ($usuario['assinatura']) {
                                        ?>
                                        <div class="span12">
                                            <label class="form-label span3">&nbsp;</label>
                                            <div class="marginT10 span9">
                                                <img src="<?php echo $this->webroot . 'files/usuario/assinatura/' . $usuario['assinatura']; ?>" alt="" class="image"/><br />
                                                <?php echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i> Remover', array('action' => 'remover_assinatura_perfil'), array('title'=>'Excluir', 'class'=>'btn confirmLink marginT10 ', 'escape' => false)); ?>
                                            </div>
                                        </div>
                                        <?PHP } ?>
                                </div>
                            </div>
                            
                            
                            
                            <?PHP echo $this->element('historico_cadastro'); ?>
                            
                            <div class="form-row row-fluid">        
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="form-actions">
                                        <div class="span3"></div>
                                        <div class="span4 controls">
                                            <?PHP
                                            echo $this->Html->link( '<i class="icon-ok"></i> Salvar', 'javascript:;',
                                                        array('title'=>'Salvar e começar um novo', 'id' => 'save', 'class'=>'btn btn-info bt_salvar tip', 'escape' => false)
                                            );                            
                                            echo $this->Html->link( '<i class="icon-circle-arrow-left"></i> Voltar', 'javascript:;', 
                                                        array(
                                                            'title'=>'Voltar para listagem',
                                                            'class'=>'btn bt_voltar tip',
                                                            'escape' => false,
                                                            'location'=> Router::url(array('controller'=>'dashboard', 'action'=>'index'))
                                                        )
                                            );
                                            ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            
                    <?PHP echo $this->Form->end(array('class' => 'hidden nostyle', 'div'=>false)); ?> 
                   
                    
                </div>
            </div><!-- End .box -->
        </div><!-- End .span6 -->
</div>