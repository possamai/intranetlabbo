<?PHP
$this_page = 'Cadastro';
$this->Html->addCrumb('Você está aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));

$this->Html->addCrumb( $title_for_layout, $base_url );
$this->Html->addCrumb( $this_page );
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="title">
                <h4><span><?php echo __( $this_page ); ?></span></h4>   
            </div>
            
            <div class="content">
                <?php echo $this->Session->flash(); ?>    
                
                <?PHP
                echo $this->Form->create('Produto', array(
                    'class'=>'form-horizontal',
                    'inputDefaults' => array(
                        'class' => 'span9',
                        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                        'div' => false,
                        'label' => array('class' => 'form-label span3'),
                        'before' => '<div class="row-fluid">',
                        'after' => '</div>',
                        'error' => array('attributes' => array('wrap' => 'label', 'class' => 'error')),
                    )
                ));
                ?><?PHP echo $this->Form->input('id'); ?>
                    <div class="form-row row-fluid required">
                        <div class="span12"><?PHP echo $this->Form->input('categoria_produto_id', array('empty' => 'Selecione')); ?></div>
                    </div>
                    <div class="form-row row-fluid required">
                        <div class="span12"><?PHP echo $this->Form->input('grupo_id', array('empty' => 'Selecione')); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('rebaixo_id', array('empty' => 'Selecione')); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('cor_id', array('empty' => 'Selecione')); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('material_id', array('empty' => 'Selecione')); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('lado_adesivo_id', array('empty' => 'Selecione')); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('referencia', array('label'=>array('text'=>'Referência','class' => 'form-label span3'))); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('derivacao', array('label'=>array('text'=>'Derivação','class' => 'form-label span3'))); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('descricao', array('label'=>array('text'=>'Descrição','class' => 'form-label span3'))); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('comprimento'); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('valor'); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('ipi'); ?></div>
                    </div>             
                
                
                <div class="form-actions"><?PHP echo $this->element('botoes_formulario'); ?></div>
                
                <?PHP echo $this->Form->end(array('class' => 'hidden nostyle', 'div'=>false)); ?>   

            </div><!-- End .content -->
        </div><!-- End .box -->
    </div><!-- End .span12 -->
</div>