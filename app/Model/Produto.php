<?php
App::uses('AppModel', 'Model');
/**
 * Produto Model
 *
 * @property CategoriaProduto $CategoriaProduto
 * @property Grupo $Grupo
 * @property Rebaixo $Rebaixo
 * @property Cor $Cor
 * @property Material $Material
 * @property LadoAdesivo $LadoAdesivo
 */
class Produto extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'referencia';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'categoria_produto_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'grupo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'rebaixo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
                'allowEmpty' => true,
			),
		),
		'cor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
                'allowEmpty' => true,
			),
		),
		'material_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
                'allowEmpty' => true,
			),
		),
		'lado_adesivo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
                'allowEmpty' => true,
			),
		),
		'valor' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'ipi' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'referencia' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Não pode ser vazio.',
			),
		),
		'derivacao' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Não pode ser vazio.',
			),
		),
		'descricao' => array(
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
		'CategoriaProduto' => array(
			'className' => 'CategoriaProduto',
			'foreignKey' => 'categoria_produto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Grupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'grupo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Rebaixo' => array(
			'className' => 'Rebaixo',
			'foreignKey' => 'rebaixo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cor' => array(
			'className' => 'Cor',
			'foreignKey' => 'cor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'material_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LadoAdesivo' => array(
			'className' => 'LadoAdesivo',
			'foreignKey' => 'lado_adesivo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
