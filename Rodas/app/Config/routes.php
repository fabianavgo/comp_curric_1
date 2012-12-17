<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));

	/* Route example */
	Router::connect('/home', array('controller' => 'users', 'action' => 'home'));
	Router::connect('/sign-up', array('controller' => 'users', 'action' => 'register'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));


	CakePlugin::routes();


	require CAKE . 'Config' . DS . 'routes.php';
