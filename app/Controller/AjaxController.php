<?php
App::uses('AppController', 'Controller');

/**
 * Ajax Controller
 *
 * @property Usuario $Usuario
 */
class AjaxController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Ajax';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();


	public function buscaCep() {
        $this->autoRender = false;
		$param = $this->request->data;
                
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=". $param['cep']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        echo $retorno = curl_exec($ch);
        curl_close($ch);
        die;
        //echo json_encode($retorno); die;
	}
}
