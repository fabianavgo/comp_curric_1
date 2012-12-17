<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console
 * @since         CakePHP(tm) v 2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Object wrapper for interacting with stdin
 *
 * @package       Cake.Console
 */
class ConsoleInput {

/**
 * Input value.
 *
 * @var resource
 */
	protected $_input;

/**
 * Constructor
 *
 * @param string $handle The location of the stream to use as input.
 */
	public function __construct($handle = 'php://stdin') {
		$this->_input = fopen($handle, 'r');
	}

/**
 * Read a value from the stream
 *
 * @return mixed The value of the stream
 */
	public function read() {
		return fgets($this->_input);
	}

}
