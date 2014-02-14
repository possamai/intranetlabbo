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
                echo $this->Form->create('Grupo', array(
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
                    <div class="form-row row-fluid">
                        <div class="span12">
                        <?PHP echo $this->Form->input('parent_id', array('empty' => '', 'label'=>array('text'=>'Grupo Superior','class' => 'form-label span3'))); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('titulo', array('label'=> array('text'=>'Título', 'class'=>'form-label span3'))); ?></div>
                    </div>
                    
                    <div class="form-row row-fluid" id="select_gerente">
                        <div class="span12"><?PHP echo $this->Form->input('usuario_id', array( 'empty' => 'Selecione', 'label' =>array('text'=>'Gerente', 'class' => 'form-label span3') ) ); ?></div>
                    </div>
                                        
                    <div class="form-row row-fluid" id="box_usuarios">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3">Usuários</label>                                
                                <div class="span8 controls lista_opcoes_checkbox">
                                    <input type="text" class="span12 input_filter" placeholder="Filtrar" />
                                    <div>
                                        <dl>
                                            <?PHP                                            
                                            $checked = $this->Form->value('Usuario.Usuario');
                                            foreach($todosUsuarios as $id => $usuario) {
                                                echo '
                                                <dd title="'. strtolower($usuario) . '">'. 
                                                    $this->Form->input('Usuario.Usuario.', array(
                                                        'type'=>'checkbox',
                                                        'value'=>$id,
                                                        'hiddenField' => false,
                                                        'checked'=>(isset($checked[$id])?true:false),
                                                        'format' => array('input'))
                                                    ) . $usuario . '
                                                </dd>
                                                ';
                                            }
                                            ?>
                                        </dl>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 
                    </div>   
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $('.lista_opcoes_checkbox > input.input_filter').keyup(function(){
                            var search = $(this).val().toLowerCase();
                            if (search!='') {
                                $(this).next('div').find('dd').hide();
                                $(this).next('div').find('dd[title*="' + search +'"]').show();
                            } else {
                                $(this).next('div').find('dd').show();                 
                            }
                        });
                        $('#GrupoParentId').change(function(){
                            if ($(this).val()=='') {
                                $('#box_usuarios').hide().find('input[type="checkbox"]').attr('checked', false);
                                $('#select_gerente').hide().removeClass('required').find('select').val('');
                            } else {
                                $('#box_usuarios').show();
                                $('#select_gerente').show().addClass('required');
                            }
                        }).trigger('change');
                    });
                    </script>
                    
                <?PHP echo $this->element('historico_cadastro'); ?>
                
                <div class="form-actions"><?PHP echo $this->element('botoes_formulario'); ?></div>
                
                <?PHP echo $this->Form->end(array('class' => 'hidden nostyle', 'div'=>false)); ?>   

            </div><!-- End .content -->
        </div><!-- End .box -->
    </div><!-- End .span12 -->
</div>