<?php
App::uses('Clanky', 'Model');

/**
 * Clanky Test Case
 *
 */
class ClankyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.clanky'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Clanky = ClassRegistry::init('Clanky');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Clanky);

		parent::tearDown();
	}

}
