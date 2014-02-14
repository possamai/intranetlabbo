<?php
App::uses('AppModel', 'Model');
/**
 * TipoEndereco Model
 *
 * @property Endereco $Endereco
 */
class TipoEndereco extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Não pode ser vazio.',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Endereco' => array(
			'className' => 'Endereco',
			'foreignKey' => 'tipo_endereco_id',
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
	);

}
