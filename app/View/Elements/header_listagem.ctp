<div class="clearfix">
    <div class="btn-group span6">
        <?PHP echo $this->Html->link( '<i class="icon-pencil"></i> Novo', array('action' => 'cadastro'), array('title'=>'Novo', 'class'=>'btn', 'escape' => false)); ?>
    </div>    
          
    <div class="right header_filtro">
        <label class="left">
            <?PHP
            $arr_paginator = $this->Paginator->params();                    
            echo $this->Form->input('limit', array(
                'options' => array(1=>1,2=>2,10=>10, 25=>25, 50=>50, 100=>100),
                'class' => 'select_limit',
                'selected' => $arr_paginator['limit'],
                'label'=> false,
            ));
            ?> por página
        </label>
        <?PHP echo $this->Form->submit("Filtrar", array('class' => 'btn btn-success nostyle', 'div'=>false)); ?>
        <?PHP echo $this->Html->link( 'Limpar Filtro', array('limpar_filtro'=>true), array('class'=>'btn btn-success right') ); ?>
    </div> 
</div>