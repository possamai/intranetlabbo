<?php
App::uses('AppController', 'Controller');
class ArquivosController extends AppController {
    
    public $components = array('RequestHandler');
    public $base_url = array('controller' => 'arquivos', 'action' => 'index');
        
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Arquivos');
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
                            $conditions[] = array('AND' => array("Arquivo.{$name} LIKE" => '%' . $value . '%') ); break;
                        default:
                            $conditions[] = array('AND' => array("Arquivo.{$name} =" => $value)); break;
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
       
		$categoriaArquivos = $this->Arquivo->CategoriaArquivo->find('list');
		$this->set(compact('categoriaArquivos'));
        
        // Verifica quais pode visualizar
        switch( $this->Auth->user('nivel_id') ) {
            case 1: // Admin = Todos registros
                break;
                
            case 2: // Gerente = Criados + Usuário do grupo criaram + Permissão
                $arr_me_permissions = $this->Permissao->getPermissionList( $this->Arquivo->alias, array('usuario_id' => $this->Auth->user('id') ) ); // Permissão do usuário
                $conditions['OR'] = array(
                    array('Arquivo.usuario_id' => $this->Auth->user('id')), // Criado
                    array('Arquivo.usuario_id' => $this->Grupo->listUserGroup( $this->Auth->user('id') )), // Usuários do grupo criaram
                    array('Arquivo.id' => $arr_me_permissions), // Permissão para visualizar
                );
                break;
                
            case 3: // Operador = Criados + Permissão
                $arr_me_permissions = $this->Permissao->getPermissionList( $this->Arquivo->alias, array('usuario_id' => $this->Auth->user('id') ) ); // Permissão do usuário
                $conditions['OR'] = array(
                    array('Arquivo.usuario_id' => $this->Auth->user('id')), // Criado
                    array('Arquivo.id' => $arr_me_permissions), // Permissão para visualizar
                );
                break;
        }

        if (!isset($limit)) { $limit = 25; }
        $this->paginate = array( 'conditions' => $conditions, 'limit' => $limit );
        
        
        $arr_users_group = $this->Grupo->listUserGroup( $this->Auth->user('id') ); // Usuários do meu grupo
        
		//$this->set('arr_users_group');
       
        $arquivos = $this->paginate();
        
		$this->Arquivo->recursive = 0;
		$this->set(compact('arquivos', 'arr_users_group'));
	}

	public function cadastro($id = null) {
	   if ($id<>null) {
            if (!$this->Arquivo->exists($id)) {
        		throw new NotFoundException(__('Arquivo inválido'));
        	} else {
                $Arquivo = $this->Arquivo->findById($id);
                $boo_permissao = $this->Grupo->Usuario->verificaPermissao( $this->Arquivo->alias, $Arquivo['Arquivo']['id'], $Arquivo['Arquivo']['usuario_id'], false);
                if ($boo_permissao) {
                    $this->set(compact( 'Arquivo' ));
                } else {
                    throw new NotFoundException(__('Sem permissão para acesso.'));
                }
        	}
    	} else {
    		$Arquivo = null;
    	}
        
        $_old_file = (($Arquivo<>null) ? $this->Arquivo->getPathFile() . $Arquivo['Arquivo']['filename'] : '');
        
    	if ($this->request->is('post') || $this->request->is('put')) {
           
    	   // Guarda nome do arquivo
           if (!empty($this->request->data['Arquivo']['filename']['name'])) {
                $this->request->data['Arquivo']['arquivo'] = $this->request->data['Arquivo']['filename']['name'];
           } else {
                unset( $this->request->data['Arquivo']['arquivo'] );
           }
           
           $this->request->data['Arquivo']['usuario_id'] = $this->Auth->user('id'); // Usuário que criou
           if ($this->Arquivo->save($this->request->data)) {
                if ( count( $this->Arquivo->error_permission )==0 ) {
                    
                    $notificacao = ClassRegistry::init('Notificacao');
                    $arr_error = $notificacao->saveNotification($this->Arquivo->alias, $this->Arquivo->id, 1, $this->request->data['Permissao']['usuario_id']);
                    
                    if ( count( $arr_error )==0 ) {
                        $this->Session->setFlash(__('Arquivo salvo com sucesso.'), 'flash_ok');
                    } else {
                        $this->Session->setFlash(__('Arquivo salvo, mas não foi possível cadastrar as notificações.'), 'flash_error');
                    }
                } else {
                    $this->Session->setFlash(__('Arquivo salvo, mas não foi possível cadastrar as permissões de acesso.'), 'flash_error');
                }
                
                // Remove arquivo antigo
                if ((is_file($_old_file))&&(!empty($this->request->data['Arquivo']['filename']['name']))) { unlink($_old_file); }
                
                // Direciona o Arquivo                
                switch( $this->request->data['Arquivo']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this->Arquivo->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('Arquivo não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $Arquivo;
		}
        
        // Grupos Permissão
		$grupos = $this->Grupo->find('threaded');
        $permissoes = $this->Permissao->find('list', array('fields'=>'usuario_id', 'conditions'=>array(
            'model_registro' => $this->Arquivo->alias,
            'id_registro' => $id,             
        ) ));
        
		$categoriaArquivos = $this->Arquivo->CategoriaArquivo->find('list');
		$this->set(compact('categoriaArquivos', 'grupos', 'permissoes'));
	}
    
	public function excluir($id = null) {
		$this->Arquivo->id = $id;
		if (!$this->Arquivo->exists()) {
			throw new NotFoundException(__('Arquivo inválido.'));
		} else {
            $Arquivo = $this->Arquivo->findById($id);
            
            $boo_permissao = $this->Grupo->Usuario->verificaPermissao( $this->Arquivo->alias, $Arquivo['Arquivo']['id'], $Arquivo['Arquivo']['usuario_id'], false);
            if ($boo_permissao) {
                if ($this->Arquivo->delete()) {
        			$this->Session->setFlash(__('Arquivo excluído.'), 'flash_ok');
        			$this->redirect(array('action' => 'index'));
        		}
                
            } else {
                throw new NotFoundException(__('Sem permissão para acesso.'));
            }
		}
		
		$this->Session->setFlash(__('Arquivo não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
    
	public function download($id = null) {
        $this->autoRender = false;
		$this->Arquivo->id = $id;
		if (!$this->Arquivo->exists()) {
			throw new NotFoundException(__('Arquivo inválido.'));
		} else {
            $Arquivo = $this->Arquivo->findById($id);
            
            $boo_permissao = $this->Grupo->Usuario->verificaPermissao( $this->Arquivo->alias, $Arquivo['Arquivo']['id'], $Arquivo['Arquivo']['usuario_id']);
            if ($boo_permissao) {
                $path = $this->Arquivo->getPathFile() . $Arquivo['Arquivo']['filename'];
                $this->response->file($path, array('download' => true, 'name' => $Arquivo['Arquivo']['arquivo']));
                
            } else {
                throw new NotFoundException(__('Sem permissão para acesso.'));
            }
		}
	}
    
	public function ver($id = null) {
		$this->Arquivo->id = $id;
		if (!$this->Arquivo->exists()) {
			throw new NotFoundException(__('Arquivo inválido.'));
		} else {
            $Arquivo = $this->Arquivo->findById($id);
            
            $boo_permissao = $this->Grupo->Usuario->verificaPermissao( $this->Arquivo->alias, $Arquivo['Arquivo']['id'], $Arquivo['Arquivo']['usuario_id']);
            if ($boo_permissao) {
                $this->set(compact( 'Arquivo' ));
            } else {
                throw new NotFoundException(__('Sem permissão para acesso.'));
            }
		}
	}
    
        
}
