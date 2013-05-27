<?php
App::uses('Uzivatele', 'Model');

/**
 * Uzivatele Test Case
 *
 */
class UzivateleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.uzivatele'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Uzivatele = ClassRegistry::init('Uzivatele');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Uzivatele);

		parent::tearDown();
	}

}
