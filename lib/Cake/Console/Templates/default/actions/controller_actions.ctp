<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>


    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', '<?php echo ($singularHumanName); ?>');
    }

	public function <?php echo $admin ?>index() {
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
                            $conditions[] = array('AND' => array("<?php echo ($currentModelName); ?>.{$name} =" => $value)); break;
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
       
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>    
        
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this->paginate());
	}

	public function <?php echo $admin ?>cadastro($id = null) {
	   if ($id<>null) {
            if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
        		throw new NotFoundException(__('<?php echo ($singularHumanName); ?> inválido'));
        	} else {
        	   $<?php echo $currentModelName; ?> = $this-><?php echo $currentModelName; ?>->findById($id);
        	}
    	} else {
    		$<?php echo $currentModelName; ?> = null;
    	}
        
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
    			$this->Session->setFlash(__('<?php echo ($singularHumanName); ?> salvo com sucesso.'), 'flash_ok');
                
                // Direciona o <?php echo ($singularHumanName); ?>
                
                switch( $this->request->data['<?php echo $currentModelName; ?>']['after_action'] ) {
                    case 'edit':
                        $this->redirect(array('action' => 'cadastro', $this-><?php echo $currentModelName; ?>->id )); break;
                    case 'save':
                        $this->redirect(array('action' => 'cadastro')); break;
                    default:
                        $this->redirect(array('action' => 'index')); break;
                }
    		} else {
    			$this->Session->setFlash(__('<?php echo ($singularHumanName); ?> não pode ser salvo. Tente novamente.'), 'flash_error');
    		}
    	} else {
			$this->request->data = $<?php echo $currentModelName; ?>;
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>       
       
       
	}
    
	public function <?php echo $admin; ?>excluir($id = null) {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('<?php echo ($singularHumanName); ?> inválido.'));
		}
		if ($this-><?php echo $currentModelName; ?>->delete()) {
			$this->Session->setFlash(__('<?php echo ($singularHumanName); ?> excluído.'), 'flash_ok');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('<?php echo ($singularHumanName); ?> não pode ser excluído.'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
