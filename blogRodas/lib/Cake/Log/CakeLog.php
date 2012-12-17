<?php


App::uses('LogEngineCollection', 'Log');

class CakeLog {


	protected static $_Collection;

	protected static $_defaultLevels = array(
		LOG_EMERG => 'emergency',
		LOG_ALERT => 'alert',
		LOG_CRIT => 'critical',
		LOG_ERR => 'error',
		LOG_WARNING => 'warning',
		LOG_NOTICE => 'notice',
		LOG_INFO => 'info',
		LOG_DEBUG => 'debug',
	);


	protected static $_levels;

	protected static $_levelMap;

protected static function _init() {
		self::$_levels = self::defaultLevels();
		self::$_Collection = new LogEngineCollection();
	}


	public static function config($key, $config) {
		if (!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $key)) {
			throw new CakeLogException(__d('cake_dev', 'Invalid key name'));
		}
		if (empty($config['engine'])) {
			throw new CakeLogException(__d('cake_dev', 'Missing logger classname'));
		}
		if (empty(self::$_Collection)) {
			self::_init();
		}
		self::$_Collection->load($key, $config);
		return true;
	}

	public static function configured() {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		return self::$_Collection->attached();
	}


	public static function levels($levels = array(), $append = true) {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		if (empty($levels)) {
			return self::$_levels;
		}
		$levels = array_values($levels);
		if ($append) {
			self::$_levels = array_merge(self::$_levels, $levels);
		} else {
			self::$_levels = $levels;
		}
		self::$_levelMap = array_flip(self::$_levels);
		return self::$_levels;
	}


	public static function defaultLevels() {
		self::$_levels = self::$_defaultLevels;
		self::$_levelMap = array_flip(self::$_levels);
		return self::$_levels;
	}


	public static function drop($streamName) {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		self::$_Collection->unload($streamName);
	}
	public static function enabled($streamName) {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		if (!isset(self::$_Collection->{$streamName})) {
			throw new CakeLogException(__d('cake_dev', 'Stream %s not found', $streamName));
		}
		return self::$_Collection->enabled($streamName);
	}

	public static function enable($streamName) {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		if (!isset(self::$_Collection->{$streamName})) {
			throw new CakeLogException(__d('cake_dev', 'Stream %s not found', $streamName));
		}
		self::$_Collection->enable($streamName);
	}


	public static function disable($streamName) {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		if (!isset(self::$_Collection->{$streamName})) {
			throw new CakeLogException(__d('cake_dev', 'Stream %s not found', $streamName));
		}
		self::$_Collection->disable($streamName);
	}

	public static function stream($streamName) {
		if (empty(self::$_Collection)) {
			self::_init();
		}
		if (!empty(self::$_Collection->{$streamName})) {
			return self::$_Collection->{$streamName};
		}
		return false;
	}

	protected static function _autoConfig() {
		self::$_Collection->load('default', array(
			'engine' => 'FileLog',
			'path' => LOGS,
		));
	}


	public static function write($type, $message, $scope = array()) {
		if (empty(self::$_Collection)) {
			self::_init();
		}

		if (is_int($type) && isset(self::$_levels[$type])) {
			$type = self::$_levels[$type];
		}
		if (is_string($type) && empty($scope) && !in_array($type, self::$_levels)) {
			$scope = $type;
		}
		$logged = false;
		foreach (self::$_Collection->enabled() as $streamName) {
			$logger = self::$_Collection->{$streamName};
			$types = null;
			$scopes = array();
			if ($logger instanceof BaseLog) {
				$config = $logger->config();
				if (isset($config['types'])) {
					$types = $config['types'];
				}
				if (isset($config['scopes'])) {
					$scopes = $config['scopes'];
				}
			}
			if (is_string($scope)) {
				$inScope = in_array($scope, $scopes);
			} else {
				$intersect = array_intersect($scope, $scopes);
				$inScope = !empty($intersect);
			}
			if (empty($types) || in_array($type, $types) || in_array($type, $scopes) && $inScope) {
				$logger->write($type, $message);
				$logged = true;
			}
		}
		if (!$logged) {
			self::_autoConfig();
			self::stream('default')->write($type, $message);
		}
		return true;
	}


	public static function emergency($message, $scope = array()) {
		return self::write(self::$_levelMap['emergency'], $message, $scope);
	}

	public static function alert($message, $scope = array()) {
		return self::write(self::$_levelMap['alert'], $message, $scope);
	}

public static function critical($message, $scope = array()) {
		return self::write(self::$_levelMap['critical'], $message, $scope);
	}

	public static function error($message, $scope = array()) {
		return self::write(self::$_levelMap['error'], $message, $scope);
	}

	public static function warning($message, $scope = array()) {
		return self::write(self::$_levelMap['warning'], $message, $scope);
	}

	public static function notice($message, $scope = array()) {
		return self::write(self::$_levelMap['notice'], $message, $scope);
	}

	public static function debug($message, $scope = array()) {
		return self::write(self::$_levelMap['debug'], $message, $scope);
	}

	public static function info($message, $scope = array()) {
		return self::write(self::$_levelMap['info'], $message, $scope);
	}

}
