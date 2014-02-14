<?PHP
echo $this->Form->input('after_action', array('type'=>'hidden', 'id'=>'after_action'));                

echo $this->Html->link( '<i class="icon-circle-arrow-left"></i> Salvar e Voltar', 'javascript:;',
            array('title'=>'Salvar e voltar para listagem', 'id' => 'back', 'class'=>'btn btn-info bt_salvar tip', 'escape' => false)
);
echo $this->Html->link( '<i class="icon-edit"></i> Salvar e Editar', 'javascript:;',
            array('title'=>'Salvar e continuar editando', 'id' => 'edit', 'class'=>'btn btn-info bt_salvar tip', 'escape' => false)
);
echo $this->Html->link( '<i class="icon-ok"></i> Salvar', 'javascript:;',
            array('title'=>'Salvar e começar um novo', 'id' => 'save', 'class'=>'btn btn-info bt_salvar tip', 'escape' => false)
);

$arr_options = array(
    'title'=>'Voltar para listagem',
    'class'=>'btn bt_voltar tip',
    'escape' => false
);
if ($base_url) { $arr_options['location'] = Router::url($base_url); }

echo $this->Html->link( '<i class="icon-circle-arrow-left"></i> Voltar', 'javascript:;', $arr_options );
echo $this->Html->link( '<i class="icon-refresh"></i> Reiniciar', 'javascript:;',
            array('title'=>'Reiniciar formulário', 'id' => 'bt_atualizar', 'class'=>'btn tip', 'escape' => false)
);
echo $this->Html->link( '<i class="icon-file"></i> Novo', array('action' => 'cadastro'),
            array('title'=>'Iniciar novo cadastro', 'class'=>'btn confirmLink tip', 'escape' => false)
);
?>