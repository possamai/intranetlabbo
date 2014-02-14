<div class="form-row row-fluid">
    <div class="span12"><?PHP echo $this->Form->input('created', array('type'=>'text', 'disabled'=>'disabled', 'name'=>false, 
                                                                    'label' => array('text'=>'Cadastrado em', 'class' => 'form-label span3')
                                                            )); ?></div>
</div>

<div class="form-row row-fluid">
    <div class="span12"><?PHP echo $this->Form->input('modified', array('type'=>'text', 'disabled'=>'disabled', 'name'=>false, 
                                                                    'label' => array('text'=>'Última edição', 'class' => 'form-label span3')
                                                            )); ?></div>
</div>