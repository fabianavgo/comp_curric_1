<?php


App::uses('CakeLogInterface', 'Log');

/**
 * Base log engine class.
 *
 * @package       Cake.Log.Engine
 */
abstract class BaseLog implements CakeLogInterface {

/**
 * Engine config
 *
 * @var string
 */
	protected $_config = array();

/**
 * __construct method
 *
 * @return void
 */
	public function __construct($config = array()) {
		$this->config($config);
	}

/**
 * Sets instance config.  When $config is null, returns config array
 *
 * Config
 *
 * - `types` string or array, levels the engine is interested in
 * - `scopes` string or array, scopes the engine is interested in
 *
 * @param array $config engine configuration
 * @return array
 */
	public function config($config = array()) {
		if (!empty($config)) {
			if (isset($config['types']) && is_string($config['types'])) {
				$config['types'] = array($config['types']);
			}
			$this->_config = $config;
		}
		return $this->_config;
	}

}
