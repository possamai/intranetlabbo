<?php
App::uses('AppController', 'Controller');
class UsuariosController extends AppController {

 
    public $base_url = array('controller' => 'usuarios', 'action' => 'index');
    
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        switch($this->request->params['action']) {
            case 'ramais':
                $this->set('title_for_layout', 'Ramais'); break;
            case 'aniversariantes':
                $this->set('title_for_layout', 'Aniversariantes'); break;
            default:
                $this->set('title_for_layout', 'Usuários'); break;
        }
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
                        case 'nome':
                        case 'email':
                        case 'login':
                            $conditions[] = array('AND' => array("Usuario.{$name} LIKE" => '%' . $value . '%') ); break;
                        case 'grupo': 
                            $conditions[] = array('AND' => array("GruposUsuarios.grupo_id = " => $value)); break;
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
       
		$niveis = $this->Usuario->Nivel->find('list');
        $grupos = $this->Usuario->Grupos->generateTreeList(null, null, null, '- ');
		$this->set(compact('grupos','niveis'));    
                
        if (!isset($limit)) { $limit = 25; }
        $this->paginate = array( 'conditions' => $conditions, 'limit' => $limit,
            'joins' => array(
                array(
                    'table' => 'grupos_usuarios',
                    'alias' => 'GruposUsuarios',
                    'type' => 'left',
                    'conditions' => array(
                        'GruposUsuarios.usuario_id = Usuario.id'
                    )
                ),
            ),
            'group' => array('Usuario.id')
        );
        
		$this->Usuario->recursive = 1;
		$this->set('usuarios', $this->paginate());
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->Usuario->exists($id)) {
        		throw new NotFoundException(__('Usuário inválido'));
        	} else {
        	   $Usuario = $this->Usuario->findById($id);
        	}
    	} else {
    		$Usuario = null;
    	}
        
        $_old_foto = (($Usuario<>null) ? $this->Usuario->getPathFile('foto') . $Usuario['Usuario']['foto'] : '');
        $_old_assinatura = (($Usuario<>null) ? $this->Usuario->getPathFile('assinatura') . $Usuario['Usuario']['assinatura'] : '');
        
    	if ($this->request->is('post') || $this->request->is('put')) {
            if (($this->request->data['Usuario']['password']=='')||($this->request->data['Usuario']['password']==null)) {
                unset($this->request->data['Usuario']['password']);
            }
            if (empty($this->request->data['Grupos'])) {
                $this->request->data['Grupos']['Grupos'] = array();
            }
            
    		if ($this->Usuario->saveAll($this->request->data)) {
    			$this->Session->setFlash(__('Usuário salvo com sucesso.'), 'flash_ok');
                
                // Remove arquivos antigos
                if ((is_file($_old_foto))&&(!empty($this->request->data['Usuario']['foto']['name']))) { unlink($_old_foto); }
                if ((is_file($_old_assinatura))&&(!empty($this->request->data['Usuario']['assinatura']['name']))) { unlink($_old_assinatura); }
                
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
    			$this->Session->setFlash(__('Usuário não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $Usuario;
		}
                
		$niveis = $this->Usuario->Nivel->find('list');
		$grupos = $this->Usuario->Grupos->find('threaded');
		$this->set(compact('grupos','niveis','path_foto', 'path_assinatura'));
       
       
       
	}
    
    public function remover($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		} else {
    	   $Usuario = $this->Usuario->findById($id);
    	}
        
        if (count($Usuario['Gerencia'])==0) {
            if ($this->Usuario->saveField('status', 3)) {
        		$this->Session->setFlash(__('Usuário removido.'), 'flash_ok');
        		$this->redirect(array('action' => 'index'));
        	}
    		$this->Session->setFlash(__('Usuário não pode ser removido.'), 'flash_error');
    		$this->redirect(array('action' => 'index'));
        } else {
    		$this->Session->setFlash(__('Usuário é gerente de algum grupo.'), 'flash_error');
    		$this->redirect(array('action' => 'index'));   
        }
	}
    
    public function ativar($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->Usuario->saveField('status', 2)) {
			$this->Session->setFlash(__('Usuário ativado.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Usuário não pode ser ativado.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
    
	public function excluir($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
		if ($this->Usuario->delete()) {
			$this->Session->setFlash(__('Usuário excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Usuário não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
    
    public function login() {
        if ($this->Auth->loggedIn()) {
            $this->redirect(array(  'controller' => 'dashboard', 'action' => 'index'));
        }        
        
        //$this->layout = 'intranet_login';
        if ($this->request->is('post')) {            
            if ($this->Auth->login()) {
                $this->redirect(array(  'controller' => 'dashboard', 'action' => 'index'));              
            } else {
                $this->Session->setFlash(__('Usuário ou senha inválidos.'), 'flash_error');
            }
        }
    }
    
    public function logout() {
        $this->Session->destroy();
        session_destroy();
        $this->redirect($this->Auth->logout());
    } 
    
    public function remover_foto($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
        
        $Usuario = $this->Usuario->findById($id);
        $path = $this->Usuario->getPathFile('foto') . $Usuario['Usuario']['foto'];
        
        if (is_file($path)) {
            unlink($path);
            if ($this->Usuario->saveField('foto', '')) {
    			$this->Session->setFlash(__('Foto removida.'), 'flash_ok');
                $this->redirect(array('action' => 'cadastro', $Usuario['Usuario']['id'] ));
    		}
        }		
		$this->Session->setFlash(__('Não foi possível remover a foto.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}      
    
    public function remover_assinatura($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
        
        $Usuario = $this->Usuario->findById($id);
        $path = $this->Usuario->getPathFile('assinatura') . $Usuario['Usuario']['assinatura'];
        
        if (is_file($path)) {
            unlink($path);
            if ($this->Usuario->saveField('assinatura', '')) {
    			$this->Session->setFlash(__('Assinatura removida.'), 'flash_ok');
                $this->redirect(array('action' => 'cadastro', $Usuario['Usuario']['id'] ));
    		}
        }		
		$this->Session->setFlash(__('Não foi possível remover a assinatura.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
    
    public function remover_foto_perfil() {
		$this->Usuario->id = $this->Auth->user('id');
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
        
        $Usuario = $this->Usuario->findById($this->Auth->user('id'));
        $path = $this->Usuario->getPathFile('foto') . $Usuario['Usuario']['foto'];
        
        if (is_file($path)) {
            unlink($path);
            if ($this->Usuario->saveField('foto', '')) {
    			$this->Session->setFlash(__('Foto removida.'), 'flash_ok');
                $this->redirect(array('action' => 'editar_perfil' ));
    		}
        }		
		$this->Session->setFlash(__('Não foi possível remover a foto.'), 'flash_error');
        $this->redirect(array('action' => 'editar_perfil' ));
	}      
    
    public function remover_assinatura_perfil() {
		$this->Usuario->id = $this->Auth->user('id');
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
        
        $Usuario = $this->Usuario->findById($this->Auth->user('id'));
        $path = $this->Usuario->getPathFile('assinatura') . $Usuario['Usuario']['assinatura'];
        
        if (is_file($path)) {
            unlink($path);
            if ($this->Usuario->saveField('assinatura', '')) {
    			$this->Session->setFlash(__('Assinatura removida.'), 'flash_ok');
                $this->redirect(array('action' => 'editar_perfil' ));
    		}
        }		
		$this->Session->setFlash(__('Não foi possível remover a assinatura.'), 'flash_error');
        $this->redirect(array('action' => 'editar_perfil' ));
	}
    
    

	public function aniversariantes() {
        $conditions = $opt = array(); $sort = null;
        $filtro = (($this->Session->check('Filter.List'))  ?  unserialize($this->Session->read('Filter.List'))  :  array()) ;
        $filter_url = array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action'], 'page' => 1);
        
        /** Filtra pela URL */
        if (count($this->params['named'])>0) {
            foreach ($this->params['named'] as $name => $value) {
                if (!in_array($name, array('page','sort', 'direction', 'limit', 'controller', 'action', 'time'))) {                    
                    switch( $name ) {
                        case 'limpar_filtro': $aux_filter[] = array(); break(2);
                        case 'nome':
                        case 'email':
                            $conditions[] = array('AND' => array("Usuario.{$name} LIKE" => '%' . $value . '%') ); break;
                        case 'data_nascimento':
                            $conditions[] = array('AND' => array("DATE_FORMAT(Usuario.{$name}, '%m')" => $value) ); break;
                        case 'grupo': 
                            $conditions[] = array('AND' => array("GruposUsuarios.grupo_id = " => $value)); break;
                        default:
                            $conditions[] = array('AND' => array("Usuario.{$name} =" => $value)); break;
                    }
                    $this->request->data['Filter'][$name] = $value;
                } else if ($name=='sort') {
                    switch( $value ) {
                        case 'data_nascimento':
                            $sort = array('nascimento_order' => 'ASC'); break;
                    }
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
       
        $grupos = $this->Usuario->Grupos->generateTreeList(null, null, null, '- ');
		$this->set(compact('grupos'));
        
        $conditions[] = array('Usuario.data_nascimento IS NOT NULL');
        $conditions[] = array('Usuario.status = 2');
        if (!isset($limit)) { $limit = 25; }
        $opt = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('Usuario.foto', 'Usuario.nome', 'Usuario.email', 'Usuario.ramal', 'Usuario.data_nascimento', 'DATE_FORMAT(Usuario.data_nascimento, "%m%d") as nascimento_order'),
            'joins' => array(
                array(
                    'table' => 'grupos_usuarios',
                    'alias' => 'GruposUsuarios',
                    'type' => 'left',
                    'conditions' => array(
                        'GruposUsuarios.usuario_id = Usuario.id'
                    )
                ),
            ),
            'group' => array('Usuario.id')
        );
        if ($sort) { $opt['order'] = $sort; }
        
        $this->Usuario->virtualFields = array('nascimento_order' => 'DATE_FORMAT(Usuario.data_nascimento, "%m%d")');
        $this->paginate = $opt;
        
		$this->Usuario->recursive = 1;
		$this->set('usuarios', $this->paginate());
        $this->set('title_for_layout', 'Aniversariantes');
	}
    
    
    
	public function ramais() {
        $this->set('title_for_layout', 'Ramais');
        
        $conditions = array();
        $filtro = (($this->Session->check('Filter.List'))  ?  unserialize($this->Session->read('Filter.List'))  :  array()) ;
        $filter_url = array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action'], 'page' => 1);
        
        /** Filtra pela URL */
        if (count($this->params['named'])>0) {
            foreach ($this->params['named'] as $name => $value) {
                if (!in_array($name, array('page','sort', 'direction', 'limit', 'controller', 'action', 'time'))) {                    
                    switch( $name ) {
                        case 'limpar_filtro': $aux_filter[] = array(); break(2);
                        case 'nome':
                        case 'email':
                        case 'ramal':
                            $conditions[] = array('AND' => array("Usuario.{$name} LIKE" => '%' . $value . '%') ); break;
                        case 'grupo': 
                            $conditions[] = array('AND' => array("GruposUsuarios.grupo_id = " => $value)); break;
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
       
       
        $grupos = $this->Usuario->Grupos->generateTreeList(null, null, null, '- ');
		$this->set(compact('grupos'));
        
        $conditions[] = array('Usuario.ramal IS NOT NULL');
        $conditions[] = array('Usuario.status = 2');
                
        if (!isset($limit)) { $limit = 25; }
        $this->paginate = array( 'conditions' => $conditions, 'limit' => $limit,
            'joins' => array(
                array(
                    'table' => 'grupos_usuarios',
                    'alias' => 'GruposUsuarios',
                    'type' => 'left',
                    'conditions' => array(
                        'GruposUsuarios.usuario_id = Usuario.id'
                    )
                ),
            ),
            'group' => array('Usuario.id')
        );
        
		$this->Usuario->recursive = 1;
		$this->set('usuarios', $this->paginate());
	}
    
    
    public function perfil($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
        
        $Usuario = $this->Usuario->findById($id);
		$this->set('usuario', $Usuario);        
	}   
          
    public function editar_perfil() {
		$this->Usuario->id = $this->Auth->user('id');
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Usuário inválido.'));
		}
        
        $Usuario = $this->Usuario->findById( $this->Auth->user('id') );
        
        $_old_foto = (($Usuario<>null) ? $this->Usuario->getPathFile('foto') . $Usuario['Usuario']['foto'] : '');
        $_old_assinatura = (($Usuario<>null) ? $this->Usuario->getPathFile('assinatura') . $Usuario['Usuario']['assinatura'] : '');
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if (($this->request->data['Usuario']['password']=='')||($this->request->data['Usuario']['password']==null)) {
                unset($this->request->data['Usuario']['password']);
            }
            
    		if ($this->Usuario->save($this->request->data)) {          
    			$this->Session->setFlash(__('Perfil salvo com sucesso.'), 'flash_ok');
                
                // Remove arquivos antigos
                if ((is_file($_old_foto))&&(!empty($this->request->data['Usuario']['foto']['name']))) { unlink($_old_foto); }
                if ((is_file($_old_assinatura))&&(!empty($this->request->data['Usuario']['assinatura']['name']))) { unlink($_old_assinatura); }
                
                // Direciona o Usuario
                $this->redirect(array('action' => 'editar_perfil' )); break;
    		} else {
    			$this->Session->setFlash(__('Usuário não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $Usuario;
		}  
	}  
}
