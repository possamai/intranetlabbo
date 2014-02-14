<?php
App::uses('AppModel', 'Model');
App::uses('Permissao', 'Model');
/**
 * Arquivo Model
 *
 * @property CategoriaArquivo $CategoriaArquivo
 */
class Arquivo extends AppModel {

    public $actsAs = array(
        'Upload.Upload' => array(
            'filename' => array(
                'path'=>'{ROOT}webroot{DS}files{DS}{model}{DS}',
                'pathMethod'=>'flat',
                'customName' => '{!getNewName}'
            ),
        )
    );
	public $displayField = 'titulo';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'categoria_arquivo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Não pode ser vazio.',
			),
		),
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Não pode ser vazio.',
			),
		),
		'filename' => array(
			'notempty' => array(
				'rule' => array('isValidExtension', array('jpg', 'gif', 'png', 'pdf', 'xls', 'doc', 'zip', 'rar')),
                'message' => 'Extensão inválida',
                'on' => 'create'
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
		'CategoriaArquivo' => array(
			'className' => 'CategoriaArquivo',
			'foreignKey' => 'categoria_arquivo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    public function getNewName($filename = ''){
        return uniqid();
    }
    
    public function getPathFile(){
        return $this->Behaviors->Upload->settings[$this->alias]['filename']['path'];
    }
    
    public function afterSave($created, $options) {
        $permissao = new Permissao();
        $permissao->savePermission( $this->data, $this->alias, $this->id );
        if ( count($permissao->validationErrors)>0 ) {
            $this->error_permission = $permissao->validationErrors;
        }
    }
}
