<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * Notificacao Model
 *
 * @property TipoAcao $TipoAcao
 * @property Criado $Criado
 * @property Para $Para
 */
class Notificacao extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'model_registro';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tipo_acao_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'criado_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'para_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'id_registro' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser numérico.',
			),
		),
		'model_registro' => array(
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
		'TipoAcao' => array(
			'className' => 'TipoAcao',
			'foreignKey' => 'tipo_acao_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Criado' => array(
			'className' => 'Usuario',
			'foreignKey' => 'criado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Para' => array(
			'className' => 'Usuario',
			'foreignKey' => 'para_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    
    public function saveNotification($model = null, $id_registry = null, $id_tipo_acao = null, $arr_usuarios) {
        if ( (count($arr_usuarios)>0) && ($model) && ($id_registry) && ($id_tipo_acao) ) {                          
            $arr_users = $arr_error = array();
            $id_logged = CakeSession::read("Auth.User.id");
            
            $user = ClassRegistry::init( 'Usuario' );
            
            /** Limpa array Ids */
            if (is_array($arr_usuarios)) {
                foreach( $arr_usuarios as $userId ) {
                    if (!in_array($userId, $arr_users)) { $arr_users[] = $userId; }
                }
            }            
            
            /** Remove os antigos */
            /*$lista = $this->find('list', array('conditions'=>array(
                'model_registro' => $model,
                'id_registro' => $id_registry             
            ) ));*/
            $this->deleteAll(
                array(
                    'model_registro' => $model,
                    'id_registro' => $id_registry             
                ), false
            );
        
            if (count($arr_users)>0) {
                foreach( $arr_users as $userId ) {
                    $data_notificacao = array('Notificacao' => array(
                        'id' => NULL,
                        'model_registro' => $model,
                        'id_registro' => $id_registry,
                        'para_id' => $userId,
                        'criado_id' => $id_logged,
                        'tipo_acao_id' => $id_tipo_acao,
                    ));
                    $this->create();
                    if ( ! $this->save( $data_notificacao ) ) {
                        $arr_error[] = $this->validationErrors;
                    } else {
                        // Get email user
                        $user->id = $userId;
                        $str_email = $user->field('email');
                        $arr_email[] = $str_email;
                    }
                }
                
                if (count($arr_email)>0) {
                    $Email = new CakeEmail();
                    $Email->from(array('nao-responder@desenvolvimentodeintranet.com.br' => 'Não Responder'));
                    $Email->subject('[Intranet] Novidades na intranet');
                    $Email->bcc( $arr_email );
                    $Email->send('Acesse agora mesmo e veja as novidades na intranet.');
                }
            }
        } else { $arr_error[] = 'Faltam campos para cadastrar notificação.'; }
        return $arr_error;
    }
    
    
    public function getNotificationList($arr_conditions = array()) {
        $lista = $this->find('list', array(
            'fields' => 'id_registro',
            'group' => 'id_registro',            
            'conditions'=>array( $arr_conditions )
        ));
        return $lista;
    }
    
    
    
    public function getNotificacoes($arr_conditions = array()) {
        $arr_retorno = array();
        $this->recursive = 0;
        $lista = $this->find('all', array(
            'group' => 'id_registro',            
            'conditions'=>array( $arr_conditions ),
        ));
        
        foreach($lista as $key => $obj) {
            $modelo = ClassRegistry::init( $obj['Notificacao']['model_registro'] );
            $dados = $modelo->find('all', array('conditions'=>array( $obj['Notificacao']['model_registro'].'.id' =>$obj['Notificacao']['id_registro'] )) );
            if (count($dados)>0) {
                array_push( $lista[$key], $dados[0] );
            }
        }
        return $lista;
    }
    
}
