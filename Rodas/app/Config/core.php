<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


	Configure::write('debug', 2);

/**
 *
 * @see ErrorHandler for more information on error handling and configuration.
 */
	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

/**
 * @see ErrorHandler for more information on exception handling and configuration.
 */
	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));


	Configure::write('App.encoding', 'UTF-8');


	define('LOG_ERROR', LOG_ERR);


	Configure::write('Session', array(
		'defaults' => 'php'
	));


	Configure::write('Security.level', 'medium');


	Configure::write('Security.salt', 'jhasdJSAHdasdsd8f7s6d5g6fsd89as6sd6fasdf56s8af6dJHSAgdjASGdaJDGS65s43asd');


	Configure::write('Security.cipherSeed', '9876545678928371726351623561287381237612312');

	Configure::write('Asset.timestamp', true);


	Configure::write('Acl.classname', 'DbAcl');
	Configure::write('Acl.database', 'default');


	date_default_timezone_set('UTC');


	Configure::write('Config.language', 'eng'); # eng | por


$engine = 'File';
if (extension_loaded('apc') && function_exists('apc_dec') && (php_sapi_name() !== 'cli' || ini_get('apc.enable_cli'))) {
	$engine = 'Apc';
}

// In development mode, caches should expire quickly.
$duration = '+999 days';
if (Configure::read('debug') >= 1) {
	$duration = '+10 seconds';
}

// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
$prefix = 'myapp_';


Cache::config('_cake_core_', array(
	'engine' => $engine,
	'prefix' => $prefix . 'cake_core_',
	'path' => CACHE . 'persistent' . DS,
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));

Cache::config('_cake_model_', array(
	'engine' => $engine,
	'prefix' => $prefix . 'cake_model_',
	'path' => CACHE . 'models' . DS,
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));
