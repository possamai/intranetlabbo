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
                    
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                        
                            <div class="row-fluid">
                                <label class="form-label span3">Endereços:</label>
                                <?PHP
                                echo $this->Html->link( '<i class="icon-file"></i> Novo Endereço', 'javascript:;',
                                            array('title'=>'Iniciar novo cadastro', 'class'=>'btn tip', 'id'=>'bt_endereco', 'escape' => false)
                                );
                                ?>                                
                                <div id="lista_enderecos" class="span8 controls lista_opcoes_checkbox">
                                <?PHP
                                if (count($this->data['Endereco'])>0){
                                    foreach($this->data['Endereco'] as $key => $obj_endereco) {
                                        echo '                                        
                                        <div>
                                            <div class="span12">'. $this->Html->link( '<i class="icon-trash"></i> Remover', 'javascript:;', array('title'=>'Iniciar novo cadastro', 'class'=>'right btn btn-mini btn-danger tip bt_remover_endereco', 'escape' => false)) .'</div>
                                            <input type="hidden" name="data[Endereco]['. $key .'][id]" value="'. $obj_endereco['id'] .'">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="EnderecoTipo">Tipo</label>
                                                    <select name="data[Endereco]['. $key .'][tipo_endereco_id]" id="EnderecoTipo" class="span9">
                                        ';
                                                        foreach($tipos_enderecos as $id => $tipo) {
                                                            echo '<option value ="'. $id .'" '. (($obj_endereco['tipo_endereco_id']==$id)?'selected="selected"':'') .'>'. $tipo .'</option>';
                                                        }
                                        echo '
                                                    </select>
                                                </div>
                                            </div>                                        
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.titulo') .'</div>                                        
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.cep', array('class'=>'cep span4')) . '</div>
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.endereco') . '</div>                                        
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.complemento') . '</div>                                        
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.numero') . '</div>                                        
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.bairro') . '</div>                                        
                                            <div class="span12">'. $this->Form->input('Endereco.'. $key .'.cidade') . '</div>                                    
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="EnderecoEstado">Estado</label>
                                                    '.  $this->Estados->select('Endereco.'. $key .'.estado', $obj_endereco['estado'], array('class'=>'span9')) . '
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    //debug( $this->data['Opcao'] );                                            
                                }
                                ?>                                                                
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
                        
                        
                        $( "input.cep" ).unbind('change');
                        $('.bt_remover_endereco').live('click',function(){
                            $(this).parent('div').parent('div').remove();
                        });
                        $('#bt_endereco').click(function(){
                            var line = $('div#lista_enderecos > div').length;
                            
                            var field = '<div class="endereco_usuario">\
                                    <div class="span12"><?PHP echo $this->Html->link( '<i class="icon-trash"></i> Remover', 'javascript:;', array('title'=>'Iniciar novo cadastro', 'class'=>'right btn btn-mini btn-danger tip bt_remover_endereco', 'escape' => false)); ?></div>\
                                    <div class="span12">\
                                        <div class="row-fluid">\
                                            <label class="form-label span3" for="EnderecoTipo">Tipo</label>\
                                            <select name="data[Endereco][9999][tipo_endereco_id]" id="EnderecoTipo" class="span9">\
                                                <?PHP
                                                foreach($tipos_enderecos as $id => $tipo) {
                                                    echo '<option value ="'. $id .'">'. $tipo .'</option>';
                                                }
                                                ?>
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.titulo'); ?></div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.cep', array('class'=>'cep span4')); ?></div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.endereco'); ?></div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.complemento'); ?></div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.numero'); ?></div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.bairro'); ?></div>\
                                    <div class="span12"><?PHP echo $this->Form->input('Endereco.9999.cidade'); ?></div>\
                                    <div class="span12">\
                                        <div class="row-fluid">\
                                            <label class="form-label span3" for="EnderecoEstado">Estado</label>\
                                            <?PHP
                                            $content =  $this->Estados->select('Endereco.9999.estado', 'SC', array('class'=>'span9'));
                                            echo str_replace("\n", '', $content);
                                            ?>
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                            ';
                            
                            $('div#lista_enderecos').append( field.replace(/9999/g, line) );
                            
                            
                            $( "input.cep:last-child" )
                                .mask("99999-999")
                                .change(function(){
                                    if ($(this).val() != "") {
                                        var name_search = $(this).attr('name').replace('[cep]','');
                            			endereco = buscaEndereco( $(this).val() );
                                        if (endereco) {                    
                                            $(this).closest('div.endereco_usuario').find( 'input[name="'+ name_search + '[endereco]"]' ).val( endereco.logradouro );
                                            $(this).closest('div.endereco_usuario').find( 'input[name="'+ name_search + '[bairro]"]' ).val( endereco.bairro );
                                            $(this).closest('div.endereco_usuario').find( 'input[name="'+ name_search + '[cidade]"]' ).val( endereco.cidade );
                                            $(this).closest('div.endereco_usuario').find( 'select[name="'+ name_search + '[estado]"]' ).val( endereco.uf );
                                        } else {
                                            dialog('Erro', 'Não foi possível localizar este CEP em nosso sistema.');
                                        }	
                            		}	
                                });
                            
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