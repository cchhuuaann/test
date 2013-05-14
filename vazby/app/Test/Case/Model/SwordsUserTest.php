<?php
App::uses('SwordsUser', 'Model');

/**
 * SwordsUser Test Case
 *
 */
class SwordsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.swords_user',
		'app.swords',
		'app.users'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SwordsUser = ClassRegistry::init('SwordsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SwordsUser);

		parent::tearDown();
	}

}
