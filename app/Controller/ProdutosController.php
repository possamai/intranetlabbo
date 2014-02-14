<?php
App::uses('AppController', 'Controller');
class ProdutosController extends AppController {

 
    public $base_url = array('controller' => 'produtos', 'action' => 'index');
    
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Produtos');
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
                        case 'referencia':
                        case 'derivacao':
                            $conditions[] = array('AND' => array("Produto.{$name} LIKE" => '%' . $value . '%') ); break;
                        default:
                            $conditions[] = array('AND' => array("Produto.{$name} =" => $value)); break;
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
       
		$categoriaProdutos = $this->Produto->CategoriaProduto->find('list');
        $grupos = $this->Grupo->ParentGrupo->generateTreeList('Grupo.parent_id IS NULL', null, null, '- ');
		$this->set(compact('categoriaProdutos', 'grupos'));
    
        
		$this->Produto->recursive = 0;
		$this->set('produtos', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->Produto->exists($id)) {
        		throw new NotFoundException(__('Produto inválido'));
        	} else {
        	   $Produto = $this->Produto->findById($id);
        	}
    	} else {
    		$Produto = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this->Produto->save($this->request->data)) {
    			$this->Session->setFlash(__('Produto salvo com sucesso.'), 'flash_ok');
                
                // Direciona o Produto                
                switch( $this->request->data['Produto']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->Produto->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Produto não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $Produto;
		}
        
		$rebaixos = $this->Produto->Rebaixo->find('list');
		$cores = $this->Produto->Cor->find('list');
		$materiais = $this->Produto->Material->find('list');
		$ladoAdesivos = $this->Produto->LadoAdesivo->find('list');
        
		$categoriaProdutos = $this->Produto->CategoriaProduto->find('list');
        $grupos = $this->Grupo->generateTreeList('Grupo.parent_id IS NULL', null, null, '- ');
		$this->set(compact('categoriaProdutos', 'grupos', 'rebaixos', 'cores', 'materiais', 'ladoAdesivos'));
       
       
       
	}
    
	public function excluir($id = null) {
		$this->Produto->id = $id;
		if (!$this->Produto->exists()) {
			throw new NotFoundException(__('Produto inválido.'));
		}
		if ($this->Produto->delete()) {
			$this->Session->setFlash(__('Produto excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Produto não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
