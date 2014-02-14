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
                echo $this->Form->create('Arquivo', array(
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
                ?><?PHP echo $this->Form->input('id'); ?>
                    <div class="form-row row-fluid required">
                        <div class="span12"><?PHP echo $this->Form->input('categoria_arquivo_id', array('empty' => 'Selecione') ); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('titulo', array('label'=> array('text'=>'Título', 'class'=>'form-label span3'))); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('descricao', array('label'=>array('text'=>'Descrição','class' => 'form-label span3'))); ?></div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12"><?PHP echo $this->Form->input('filename', array( 'type' => 'file', 'label'=>array('text'=>'Arquivo','class' => 'form-label span3'))); ?></div>
                    </div>
                    
                    
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            
                            
                            <div class="row-fluid">
                                <label class="form-label span3">Permissão de acesso</label>                                
                                <div class="span8 controls lista_opcoes_checkbox">
                                    <input type="text" class="span12 input_filter" placeholder="Filtrar" />
                        
        <div>
            <dl>
                <?PHP        
                echo '<dd class="marginB5" title=""><input type="checkbox" id="marcar_todos" /> Marcar Todos</dd>';
                
                foreach($grupos as $grupo) {
                    if (count($grupo['children'])>0) {
                        
                        echo '<dt>'. $grupo['Grupo']['titulo'] .'</dt>';                        
                        foreach($grupo['children'] as $childGroup) {
                            
                            if (count($childGroup['Usuario'])>0) {
                                echo '<dd><input type="checkbox" class="marcar_todos" /> <a href="javascript:;" class="bt_abre_opcoes">'. $childGroup['Grupo']['titulo'] . '</a></dd>';
                                
                                echo '<div class="ml20">';
                                foreach($childGroup['Usuario'] as $userGroup) {
                                    echo '
                                        <dd title="'. strtolower($userGroup['nome']) . '">'. 
                                            $this->Form->input('Permissao.usuario_id.', array(
                                                'type'=>'checkbox',
                                                'value'=>$userGroup['id'],
                                                'hiddenField' => false,
                                                'checked'=>((in_array($userGroup['id'],$permissoes))?true:false),
                                                'format' => array('input'))
                                            ) . $userGroup['nome'] . '
                                        </dd>
                                    ';
                                }
                                echo '</div>';
                            }
                                                        
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
                        $('input[name="data[Arquivo][filename]"]').change(function(){
                            var _validFileExtensions = [".jpg", ".gif", ".png", ".pdf", ".xls", ".doc", ".zip", ".rar" ];
                            if (!$(this).hasExtension( _validFileExtensions )) {
                                $(this).val('');
                                dialog('Erro', 'Formato inválido<br />Extensões aceitas: '+ _validFileExtensions.join(', '));
                            }
                        });
                        
                        $('.lista_opcoes_checkbox > input.input_filter').keyup(function(){
                            var search = $(this).val().toLowerCase();
                            if (search!='') {
                                $(this).next('div').find('dd').hide();
                                $(this).next('div').find('dd[title*="' + search +'"]').show();
                                $(this).next('div').find('dd').not('[title]').show();
                            } else {
                                $(this).next('div').find('dd').show();                 
                            }
                        });
                        
                        $('.bt_abre_opcoes').click(function(){
                            $(this).parent('dd').next('div').slideToggle();
                        });
                        
                        $('input[type="checkbox"][name*="data[Permissao][usuario_id]"]').click(function(){
                            if ( $(this).is(':checked') ) {
                                $('input[type="checkbox"][name*="data[Permissao][usuario_id]"][value="'+ $(this).val() +'"]').attr('checked', true);
                            } else {
                                $('input[type="checkbox"][name*="data[Permissao][usuario_id]"][value="'+ $(this).val() +'"]').attr('checked', false);
                            }
                            $.uniform.update();
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