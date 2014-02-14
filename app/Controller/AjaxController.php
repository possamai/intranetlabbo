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
		$param = $this->request->data;        
        parse_str( file_get_contents("http://cep.republicavirtual.com.br/web_cep.php?formato=query_string&cep=". $param['cep']), $arr_retorno);
        foreach($arr_retorno as $key=>$val) {
            $arr_retorno[$key] = utf8_encode($arr_retorno[$key]);
        }
        echo json_encode($arr_retorno); die;
	}
}
