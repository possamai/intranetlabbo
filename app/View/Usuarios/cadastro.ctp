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
                echo $this->Form->create('Usuario', array(
                    'type' => 'file',
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
                ?>
                    <?PHP
                    $usuario = $this->request->data['Usuario'];
                    echo $this->Form->input('id');
                    ?>
                
                    <div class="form-row row-fluid required">
                        <div class="span12"><?PHP echo $this->element('select_status', array('label'=>true)); ?></div>
                    </div>
                    <div class="form-row row-fluid required">
                        <div class="span12"><?PHP echo $this->Form->input('nivel_id', array('empty' => 'Selecione', 'label'=> array('text'=>'Nível', 'class'=>'form-label span3')) ); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('login'); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('nome'); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('email', array('class'=>'email span9')); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('password', array('value' => '', 'autocomplete'=>'off', 'label'=> array('text'=>'Senha', 'class'=>'form-label span3'))); ?></div>
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
                                
                                if ($usuario['foto'] && (!empty($usuario['id']))) {
                                ?>
                                <div class="span12">
                                    <label class="form-label span3">&nbsp;</label>
                                    <div class="marginT10 span9">                                    
                                        <?PHP
                                        $img = (($usuario['foto']<>'')?'/files/usuario/foto/'.$usuario['foto']:'/img/logo.png');
                                        echo $this->Timthumb->image($img, array('width' => 80, 'height' => 80, 'zoom_crop'=> 2), array('class'=>'image'));
                                        ?>
                                        <?php echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i> Remover', array('action' => 'remover_foto', $usuario['id']), array('title'=>'Excluir', 'class'=>'btn confirmLink marginT10 ', 'escape' => false)); ?>
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
                                
                                if ($usuario['assinatura'] && (!empty($usuario['id']))) {
                                ?>
                                <div class="span12">
                                    <label class="form-label span3">&nbsp;</label>
                                    <div class="marginT10 span9">
                                        <img src="<?php echo $this->webroot . 'files/usuario/assinatura/' . $usuario['assinatura']; ?>" alt="" class="image"/><br />
                                        <?php echo $this->Html->link( '<i class="icon16 icomoon-icon-remove mr0"></i> Remover', array('action' => 'remover_assinatura', $usuario['id']), array('title'=>'Excluir', 'class'=>'btn confirmLink marginT10 ', 'escape' => false)); ?>
                                    </div>
                                </div>
                                <?PHP } ?>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                        
                            <div class="row-fluid">
                                <label class="form-label span3">Grupos</label>                                
                                <div class="span8 controls lista_opcoes_checkbox">
                                    <input type="text" class="span12 input_filter" placeholder="Filtrar" />
                        
                                    <div>
                                        <dl>
                                            <?PHP
                                            $checked = $this->Form->value('Grupos.Grupos');
                                            foreach($grupos as $grupo) {
                                                if (count($grupo['ChildGrupo'])>0) {
                                                    echo '<dt>'. $grupo['Grupo']['titulo'] .'</dt>';
                                                    
                                                    foreach($grupo['ChildGrupo'] as $childGroup) {
                                                        echo '
                                                        <dd title="'. strtolower($childGroup['titulo']) . '">'. 
                                                            $this->Form->input('Grupos.Grupos.', array(
                                                                'type'=>'checkbox',
                                                                'value'=>$childGroup['id'],
                                                                'hiddenField' => false,
                                                                'checked'=>(isset($checked[$childGroup['id']])?true:false),
                                                                'format' => array('input'))
                                                            ) . $childGroup['titulo'] . '
                                                        </dd>
                                                        ';
                                                    }
                                                }                  
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
                        
                        $('input[name="data[Usuario][foto]"], input[name="data[Usuario][assinatura]"]').change(function(){
                            var _validFileExtensions = [".jpg", ".gif", ".png" ];
                            if (!$(this).hasExtension( _validFileExtensions )) {
                                $(this).val('');
                                dialog('Erro', 'Formato inválido<br />Extensões aceitas: '+ _validFileExtensions.join(', '));
                            }
                        });
                    });
                    </script>     
                    
                    
                <?PHP echo $this->element('historico_cadastro'); ?>
                
                <div class="form-actions"><?PHP echo $this->element('botoes_formulario'); ?></div>
                
                <?PHP echo $this->Form->end(array('class' => 'hidden nostyle', 'div'=>false)); ?>   

            </div><!-- End .content -->
        </div><!-- End .box -->
    </div><!-- End .span12 -->
</div>