<?php
App::uses('AppController', 'Controller');
class CategoriaProdutosController extends AppController {

 
    public $base_url = array('controller' => 'categoria_produtos', 'action' => 'index');
    
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Categorias dos Produtos');
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
                            $conditions[] = array('AND' => array("CategoriaProduto.{$name} LIKE" => '%' . $value . '%') ); break;
                        default:
                            $conditions[] = array('AND' => array("CategoriaProduto.{$name} =" => $value)); break;
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
       
    
        
		$this->CategoriaProduto->recursive = 0;
		$this->set('categoriaProdutos', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->CategoriaProduto->exists($id)) {
        		throw new NotFoundException(__('Categoria do Produto inválido'));
        	} else {
        	   $CategoriaProduto = $this->CategoriaProduto->findById($id);
        	}
    	} else {
    		$CategoriaProduto = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this->CategoriaProduto->save($this->request->data)) {
    			$this->Session->setFlash(__('Categoria do Produto salvo com sucesso.'), 'flash_ok');
                
                // Direciona o Categoria Produto                
                switch( $this->request->data['CategoriaProduto']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->CategoriaProduto->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Categoria do Produto não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $CategoriaProduto;
		}
       
       
       
	}
    
	public function excluir($id = null) {
		$this->CategoriaProduto->id = $id;
		if (!$this->CategoriaProduto->exists()) {
			throw new NotFoundException(__('Categoria do Produto inválido.'));
		}
		if ($this->CategoriaProduto->delete()) {
			$this->Session->setFlash(__('Categoria do Produto excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Categoria do Produto não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
