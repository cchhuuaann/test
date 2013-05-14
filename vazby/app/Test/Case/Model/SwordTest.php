<?php
App::uses('Sword', 'Model');

/**
 * Sword Test Case
 *
 */
class SwordTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sword',
		'app.user',
		'app.swords_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sword = ClassRegistry::init('Sword');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sword);

		parent::tearDown();
	}

}
