<?php
App::uses('Sensor', 'Model');

/**
 * Sensor Test Case
 */
class SensorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sensor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sensor = ClassRegistry::init('Sensor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sensor);

		parent::tearDown();
	}

}
