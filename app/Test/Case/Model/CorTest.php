<?php
App::uses('Cor', 'Model');

/**
 * Cor Test Case
 *
 */
class CorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cor',
		'app.produto',
		'app.categoria_produto',
		'app.grupo',
		'app.usuario',
		'app.nivel',
		'app.grupos_usuario',
		'app.rebaixo',
		'app.material',
		'app.lado_adesivo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cor = ClassRegistry::init('Cor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cor);

		parent::tearDown();
	}

}
