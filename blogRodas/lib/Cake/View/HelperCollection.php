<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View
 * @since         CakePHP(tm) v 2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('ObjectCollection', 'Utility');
App::uses('CakeEventListener', 'Event');

/**
 * Helpers collection is used as a registry for loaded helpers and handles loading
 * and constructing helper class objects.
 *
 * @package       Cake.View
 */
class HelperCollection extends ObjectCollection implements CakeEventListener {

/**
 * View object to use when making helpers.
 *
 * @var View
 */
	protected $_View;

/**
 * Constructor
 *
 * @param View $view
 */
	public function __construct(View $view) {
		$this->_View = $view;
	}

/**
 * Tries to lazy load a helper based on its name, if it cannot be found
 * in the application folder, then it tries looking under the current plugin
 * if any
 *
 * @param string $helper The helper name to be loaded
 * @return boolean wheter the helper could be loaded or not
 * @throws MissingHelperException When a helper could not be found.
 *    App helpers are searched, and then plugin helpers.
 */
	public function __isset($helper) {
		if (parent::__isset($helper)) {
			return true;
		}

		try {
			$this->load($helper);
		} catch (MissingHelperException $exception) {
			if ($this->_View->plugin) {
				$this->load($this->_View->plugin . '.' . $helper);
				return true;
			}
		}

		if (!empty($exception)) {
			throw $exception;
		}

		return true;
	}

/**
 * Provide public read access to the loaded objects
 *
 * @param string $name Name of property to read
 * @return mixed
 */
	public function __get($name) {
		if ($result = parent::__get($name)) {
			return $result;
		}
		if ($this->__isset($name)) {
			return $this->_loaded[$name];
		}
		return null;
	}

/**
 * @param string $helper Helper name to load
 * @param array $settings Settings for the helper.
 * @return Helper A helper object, Either the existing loaded helper or a new one.
 * @throws MissingHelperException when the helper could not be found
 */
	public function load($helper, $settings = array()) {
		if (is_array($settings) && isset($settings['className'])) {
			$alias = $helper;
			$helper = $settings['className'];
		}
		list($plugin, $name) = pluginSplit($helper, true);
		if (!isset($alias)) {
			$alias = $name;
		}

		if (isset($this->_loaded[$alias])) {
			return $this->_loaded[$alias];
		}
		$helperClass = $name . 'Helper';
		App::uses($helperClass, $plugin . 'View/Helper');
		if (!class_exists($helperClass)) {
			throw new MissingHelperException(array(
				'class' => $helperClass,
				'plugin' => substr($plugin, 0, -1)
			));
		}
		$this->_loaded[$alias] = new $helperClass($this->_View, $settings);

		$vars = array('request', 'theme', 'plugin');
		foreach ($vars as $var) {
			$this->_loaded[$alias]->{$var} = $this->_View->{$var};
		}
		$enable = isset($settings['enabled']) ? $settings['enabled'] : true;
		if ($enable) {
			$this->enable($alias);
		}
		return $this->_loaded[$alias];
	}

/**
 * Returns a list of all events that will fire in the View during it's lifecycle.
 *
 * @return array
 */
	public function implementedEvents() {
		return array(
			'View.beforeRenderFile' => 'trigger',
			'View.afterRenderFile' => 'trigger',
			'View.beforeRender' => 'trigger',
			'View.afterRender' => 'trigger',
			'View.beforeLayout' => 'trigger',
			'View.afterLayout' => 'trigger'
		);
	}

/**
  * @param string $callback|CakeEvent Method to fire on all the objects. Its assumed all the objects implement
 *   the method you are calling. If an instance of CakeEvent is provided, then then Event name will parsed to
 *   get the callback name. This is done by getting the last word after any dot in the event name
 *   (eg. `Model.afterSave` event will trigger the `afterSave` callback)
 * @param array $params Array of parameters for the triggered callback.
 * @param array $options Array of options.
 * @return mixed Either the last result or all results if collectReturn is on.
 * @throws CakeException when modParams is used with an index that does not exist.
 */
	public function trigger($callback, $params = array(), $options = array()) {
		if ($callback instanceof CakeEvent) {
			$callback->omitSubject = true;
		}
		return parent::trigger($callback, $params, $options);
	}

}
