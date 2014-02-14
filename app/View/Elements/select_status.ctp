<?PHP
$arr_opt = array(
    'options' => array(1=>'Inativo', 2=>'Ativo', 3=>'Excluído'),
    'empty' => 'Selecione',
);

if (!isset($label)) { $arr_opt['label'] = false; }

echo $this->Form->input('status', $arr_opt);
?>