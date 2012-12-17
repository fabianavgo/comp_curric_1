<?php
/**

 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */



$config['map'] = array(
	'User' => 'User/username',
	'Role' => 'User/group_id',
);


$config['alias'] = array(
	'Role/4' => 'Role/editor',
);

/**
 * role configuration
 */
$config['roles'] = array(
	'Role/admin' => null,
);

/**
 * rule configuration
 */
$config['rules'] = array(
	'allow' => array(
		'*' => 'Role/admin',
	),
	'deny' => array(),
);
