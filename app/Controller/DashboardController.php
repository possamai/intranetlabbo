<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DashboardController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Dashboard';
	public $uses = array();
    public $base_url = array('controller' => 'dashboard', 'action' => 'index');
        
    public function beforeRender() {                
        $this->set('base_url', $this->base_url );
        $this->set('title_for_layout', 'Início');
    }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function index() {
        $id_user = $this->Auth->user('id');
        $this->set('notificacoes', ClassRegistry::init('Notificacao')->getNotificacoes(array('para_id'=>$id_user)));
        $this->set('aniversariantes', ClassRegistry::init('Usuario')->getAniversariantesSemana());
        
	}
        
}
