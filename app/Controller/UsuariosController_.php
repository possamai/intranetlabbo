<?php
App::uses('AppController', 'Controller');
class UsuariosController extends AppController {

 
 public $base_url = array('controller' => 'usuarios', 'action' => 'index');
    
public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Usuario');
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
                        default:
                            $conditions[] = array('AND' => array("Usuario.{$name} =" => $value)); break;
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
                
        if (!isset($limit)) { $limit = 25; }
        $this->paginate = array( 'conditions' => $conditions, 'limit' => $limit );
       
		$gruposes = $this->Usuario->Grupo->find('list');
		$this->set(compact('gruposes'));
    
        
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->Usuario->exists($id)) {
        		throw new NotFoundException(__('Usuario inválido'));
        	} else {
        	   $Usuario = $this->Usuario->findById($id);
        	}
    	} else {
    		$Usuario = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this->Usuario->save($this->request->data)) {
    			$this->Session->setFlash(__('Usuario salvo com sucesso.'), 'flash_ok');
                
                // Direciona o Usuario                
                switch( $this->request->data['Usuario']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->Usuario->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Usuario não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $Usuario;
		}
		$gruposes = $this->Usuario->Grupo->find('list');
		$this->set(compact('gruposes', 'gruposes'));
       
       
       
	}
    
	public function excluir($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuario inválido.'));
		}
		if ($this->Usuario->delete()) {
			$this->Session->setFlash(__('Usuario excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Usuario não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
