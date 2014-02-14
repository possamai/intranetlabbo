<?php
App::uses('AppController', 'Controller');
class GruposController extends AppController {

    public $base_url = array('controller' => 'grupos', 'action' => 'index');
    
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Grupos');
    }

	public function index() {
        $conditions = array();
        $filtro = (($this->Session->check('Filter.List'))  ?  unserialize($this->Session->read('Filter.List'))  :  array()) ;
        $filter_url = array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action'], 'page' => 1);
        
        /** Filtra pela URL */
        if (count($this->params['named'])>0) {
            foreach ($this->params['named'] as $name => $value) {
                if (!in_array($name, array('page','sort', 'direction', 'limit', 'controller', 'action', 'time'))) {                    
                    switch( $name ) {
                        case 'limpar_filtro': $aux_filter[] = array(); break(2);
                        case 'titulo':
                            $conditions[] = array('AND' => array("Grupo.{$name} LIKE" => '%' . $value . '%') ); break;
                        case 'usuario_id':
                            $conditions[] = array('AND' => array("Gerente.nome LIKE" => '%' . $value . '%') ); break;
                        default:
                            $conditions[] = array('AND' => array("Grupo.{$name} =" => $value)); break;
                    }
                    $this->request->data['Filter'][$name] = $value;
                }
                $aux_filter[$name] = urlencode($value);
            }
            $aux_filter['time'] = strtotime('now');
            $filtro[$this->request->params['controller']] = $aux_filter;
        
            $this->Session->write('Filter.List', serialize($filtro));
        
        /** Direciona Form */
        } else if ( isset($this->data['Filter']) ) {
            foreach ($this->data['Filter'] as $name => $value) {
                if ($value) { $filter_url[$name] = urlencode($value); }
            }
            return $this->redirect($filter_url); die;
            
        /** Direciona Session */
        } else if ( isset($filtro[$this->request->params['controller']]) ) {
            if ($filtro[$this->request->params['controller']]['time']>strtotime($this->time_filter)) {
                foreach ($filtro[$this->request->params['controller']] as $name => $value) {
                    if (($value)&&($name<>'time')) { $filter_url[$name] = urlencode($value); }
                }
                return $this->redirect($filter_url); die;                        
            }
        }
       
        $parents = $this->Grupo->ParentGrupo->generateTreeList('Grupo.parent_id IS NULL', null, null, '- ');
		$usuarios = $this->Grupo->Usuario->find('list', array('conditions'=> array('Usuario.status' => 2, 'Usuario.nivel_id' => 2) ));
		$this->set(compact('usuarios', 'parents'));
        
                
        if (!isset($limit)) { $limit = 25; }
        
        $this->paginate = array( 'conditions' => $conditions, 'limit' => $limit,
            'joins' => array(
                array(
                    'table' => 'grupos_usuarios',
                    'alias' => 'GruposUsuarios',
                    'type' => 'left',
                    'conditions' => array(
                        'GruposUsuarios.grupo_id = Grupo.id',
                    )
                ),
                array(
                    'table' => 'usuarios',
                    'alias' => 'Usuario',
                    'type' => 'left',
                    'conditions' => array(
                        'GruposUsuarios.usuario_id = Usuario.id',
                        'Usuario.status' => 2                      
                    )
                ),
            ),
            'group' => array('Grupo.id')
        );
        
		$this->Grupo->recursive = 1;
		$this->set('grupos', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->Grupo->exists($id)) {
        		throw new NotFoundException(__('Grupo inválido'));
        	} else {
        	   $Grupo = $this->Grupo->findById($id);
        	}
    	} else {
    		$Grupo = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
            if (empty($this->request->data['Usuario'])) {
                $this->request->data['Usuario']['Usuario'] = array();
            }
            
    		if ($this->Grupo->saveAll($this->request->data)) {
    			$this->Session->setFlash(__('Grupo salvo com sucesso.'), 'flash_ok');
                
                // Direciona o Grupo                
                switch( $this->request->data['Grupo']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->Grupo->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Grupo não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $Grupo;
		}
        
		$todosUsuarios = $this->Grupo->Usuario->find('list', array('conditions'=>array('Usuario.status' => 2)));
		$usuarios = $this->Grupo->Usuario->find('list', array('conditions'=>array('Usuario.status' => 2, 'Usuario.nivel_id' => 2)));
        $parents = $this->Grupo->ParentGrupo->generateTreeList('Grupo.parent_id IS NULL', null, null, '- ');
        
		$this->set(compact('usuarios', 'parents', 'todosUsuarios'));
	}
    
	public function excluir($id = null) {
		$this->Grupo->id = $id;
		if (!$this->Grupo->exists()) {
			throw new NotFoundException(__('Grupo inválido.'));
		}
		if ($this->Grupo->delete()) {
			$this->Session->setFlash(__('Grupo excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Grupo não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
