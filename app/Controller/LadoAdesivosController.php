<?php
App::uses('AppController', 'Controller');
class LadoAdesivosController extends AppController {

 
    public $base_url = array('controller' => 'lado_adesivos', 'action' => 'index');
    
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Lados dos Adesivos');
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
                            $conditions[] = array('AND' => array("LadoAdesivo.{$name} LIKE" => '%' . $value . '%') ); break;
                        default:
                            $conditions[] = array('AND' => array("LadoAdesivo.{$name} =" => $value)); break;
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
       
    
        
		$this->LadoAdesivo->recursive = 0;
		$this->set('ladoAdesivos', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->LadoAdesivo->exists($id)) {
        		throw new NotFoundException(__('Lado do Adesivo inválido'));
        	} else {
        	   $LadoAdesivo = $this->LadoAdesivo->findById($id);
        	}
    	} else {
    		$LadoAdesivo = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this->LadoAdesivo->save($this->request->data)) {
    			$this->Session->setFlash(__('Lado do Adesivo salvo com sucesso.'), 'flash_ok');
                
                // Direciona o Lado Adesivo                
                switch( $this->request->data['LadoAdesivo']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->LadoAdesivo->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Lado do Adesivo não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $LadoAdesivo;
		}
       
       
       
	}
    
	public function excluir($id = null) {
		$this->LadoAdesivo->id = $id;
		if (!$this->LadoAdesivo->exists()) {
			throw new NotFoundException(__('Lado do Adesivo inválido.'));
		}
		if ($this->LadoAdesivo->delete()) {
			$this->Session->setFlash(__('Lado do Adesivo excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lado do Adesivo não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
