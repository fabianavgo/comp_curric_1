<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


Cache::config('default', array('engine' => 'File'));


Configure::write(
	'Application', array(
		'name' => 'CakeStrap',
		'from_email' => 'from@your_app_domain.com',
		'contact_mail' => 'contact@your_app_domain.com'
	)
);


Configure::write(
	'Layout', array(
		'theme' => 'default'
	)
);


App::uses('CakeEmail', 'Network/Email');


Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));


App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'FileLog',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'FileLog',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
