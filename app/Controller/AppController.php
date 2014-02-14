<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    var $uses = array('Grupo', 'Permissao', 'Notificacao');
    
    public $time_filter = '-1 minutes'; // Tempo que gravará o filtro da pesquisa
    public $helpers = array( 'Timthumb.Timthumb' );
    public $components = array(
        'Session',
        'Auth' => array(
            'loginAction' => array('controller' => 'usuarios', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'login'),
            'autoRedirect' => true,
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array('username' => 'login'),
                    'scope' => array('Usuario.status' => 2)
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter() {
        
        $usuario = ClassRegistry::init('Usuario');
        $usuario = $usuario->findById( $this->Auth->user('id') );
        $this->set('userLogado', ((count($usuario)>0)?$usuario['Usuario']:null));
        
        $this->layout = 'intranet';        
        $this->Auth->deny();
        $this->Auth->allow('logout');
        
        /**
        if (isset($this->params['admin'])) {
            $this->set('auth', $this->Auth->user());
            
            $this->Auth->deny();
        } else {
            $this->Auth->allow();
        }
        //$this->Auth->allow('index', 'ver', 'display');
        //$this->Auth->allow();
        
        $this->Auth->allow('home');
        
        if ((isset($this->params['admin']))) {
            $this->set('auth', $this->Auth->user());
            
            $this->layout = 'admin';
        }
        */
    }
    
    public function isAuthorized($user) {
        return true;
    }
    
}
