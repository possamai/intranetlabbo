<?php
App::uses('AppController', 'Controller');
class TipoEnderecosController extends AppController {

 
    public $base_url = array('controller' => 'tipo_enderecos', 'action' => 'index');
    
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Tipos de Endereços');
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
                            $conditions[] = array('AND' => array("TipoEndereco.{$name} =" => $value)); break;
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
       
    
        
		$this->TipoEndereco->recursive = 0;
		$this->set('tipoEnderecos', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->TipoEndereco->exists($id)) {
        		throw new NotFoundException(__('Tipo de Endereço inválido'));
        	} else {
        	   $TipoEndereco = $this->TipoEndereco->findById($id);
        	}
    	} else {
    		$TipoEndereco = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this->TipoEndereco->save($this->request->data)) {
    			$this->Session->setFlash(__('Tipo de Endereço salvo com sucesso.'), 'flash_ok');
                
                // Direciona o Tipo de Endereço                
                switch( $this->request->data['TipoEndereco']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->TipoEndereco->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Tipo de Endereço não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $TipoEndereco;
		}
       
       
       
	}
    
	public function excluir($id = null) {
		$this->TipoEndereco->id = $id;
		if (!$this->TipoEndereco->exists()) {
			throw new NotFoundException(__('Tipo de Endereço inválido.'));
		}
		if ($this->TipoEndereco->delete()) {
			$this->Session->setFlash(__('Tipo de Endereço excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tipo de Endereço não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
