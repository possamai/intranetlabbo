<?php
App::uses('AppModel', 'Model');
/**
 * Grupo Model
 *
 * @property Usuario $Usuario
 * @property Grupo $ParentGrupo
 * @property Cotacao $Cotacao
 * @property Grupo $ChildGrupo
 * @property Produto $Produto
 * @property Usuario $Usuario
 */
class Grupo extends AppModel {
    public $alias = 'Grupo';
    public $actsAs = array('Tree');
	public $displayField = 'titulo';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'usuario_id' => array(
			'manager' => array(
				'rule' => array('verifyManager', 'parent_id'),
				'message' => 'Não pode ser vazio.',
			),
		),
		'lft' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'rght' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Não pode ser vazio.',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Gerente' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentGrupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
 
	public $hasMany = array(
		'ChildGrupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        /*
		'Cotacao' => array(
			'className' => 'Cotacao',
			'foreignKey' => 'grupo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'grupo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
        */
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'joinTable' => 'grupos_usuarios',
			'foreignKey' => 'grupo_id',
			'associationForeignKey' => 'usuario_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
    
    
    
    public function verifyManager($check, $field) {
        $value = array_values($check);
        return (($this->data[$this->alias][$field]<>'')&&($value[0]<>'') || ($this->data[$this->alias][$field]=='')&&($value[0]==''));
    }
    
    
    
    public function listUserGroup( $id_gerente = null ) {
        $arr_user = array();
        
        if ($id_gerente<>null) {
            $arr_groups = $this->find('all', array('conditions'=>array(
                'Grupo.usuario_id' => $id_gerente
            ) ));
            
            if (count($arr_groups)>0) {
                foreach($arr_groups as $group) {
                    if (count($group['Usuario'])>0) {
                        foreach($group['Usuario'] as $user) {
                            $arr_user[$user['id']] = $user['id'];
                        }
                    }
                }
            }
        }
        
        return $arr_user;
    }

}
