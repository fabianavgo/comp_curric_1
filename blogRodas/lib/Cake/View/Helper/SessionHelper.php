<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Helper
 * @since         CakePHP(tm) v 1.1.7.3328
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppHelper', 'View/Helper');
App::uses('CakeSession', 'Model/Datasource');

/**
 * Session Helper.
 *
 * Session reading from the view.
 *
 * @package       Cake.View.Helper
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/session.html
 */
class SessionHelper extends AppHelper {

/**
  * @param string $name the name of the session key you want to read
 * @return mixed values from the session vars
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/session.html#SessionHelper::read
 */
	public function read($name = null) {
		return CakeSession::read($name);
	}

/**
 * Used to check is a session key has been set
 *
 * In your view: `$this->Session->check('Controller.sessKey');`
 *
 * @param string $name
 * @return boolean
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/session.html#SessionHelper::check
 */
	public function check($name) {
		return CakeSession::check($name);
	}

/**
 * @return string last error
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/session.html#displaying-notifcations-or-flash-messages
 */
	public function error() {
		return CakeSession::error();
	}

/**
 * Used to render the message set in Controller::Session::setFlash()
 * @param string $key The [Message.]key you are rendering in the view.
 * @param array $attrs Additional attributes to use for the creation of this flash message.
 *    Supports the 'params', and 'element' keys that are used in the helper.
 * @return string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/session.html#SessionHelper::flash
 */
	public function flash($key = 'flash', $attrs = array()) {
		$out = false;

		if (CakeSession::check('Message.' . $key)) {
			$flash = CakeSession::read('Message.' . $key);
			$message = $flash['message'];
			unset($flash['message']);

			if (!empty($attrs)) {
				$flash = array_merge($flash, $attrs);
			}

			if ($flash['element'] == 'default') {
				$class = 'message';
				if (!empty($flash['params']['class'])) {
					$class = $flash['params']['class'];
				}
				$out = '<div id="' . $key . 'Message" class="' . $class . '">' . $message . '</div>';
			} elseif ($flash['element'] == '' || $flash['element'] == null) {
				$out = $message;
			} else {
				$options = array();
				if (isset($flash['params']['plugin'])) {
					$options['plugin'] = $flash['params']['plugin'];
				}
				$tmpVars = $flash['params'];
				$tmpVars['message'] = $message;
				$out = $this->_View->element($flash['element'], $tmpVars, $options);
			}
			CakeSession::delete('Message.' . $key);
		}
		return $out;
	}

/**
 * Used to check is a session is valid in a view
 *
 * @return boolean
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/session.html#SessionHelper::valid
 */
	public function valid() {
		return CakeSession::valid();
	}

}
