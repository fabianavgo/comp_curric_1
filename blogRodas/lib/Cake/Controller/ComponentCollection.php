<?php

App::uses('ObjectCollection', 'Utility');
App::uses('Component', 'Controller');
App::uses('CakeEventListener', 'Event');


class ComponentCollection extends ObjectCollection implements CakeEventListener {

	protected $_Controller = null;

	public function init(Controller $Controller) {
		if (empty($Controller->components)) {
			return;
		}
		$this->_Controller = $Controller;
		$components = ComponentCollection::normalizeObjectArray($Controller->components);
		foreach ($components as $name => $properties) {
			$Controller->{$name} = $this->load($properties['class'], $properties['settings']);
		}
	}

	public function getController() {
		return $this->_Controller;
	}


	public function load($component, $settings = array()) {
		if (is_array($settings) && isset($settings['className'])) {
			$alias = $component;
			$component = $settings['className'];
		}
		list($plugin, $name) = pluginSplit($component, true);
		if (!isset($alias)) {
			$alias = $name;
		}
		if (isset($this->_loaded[$alias])) {
			return $this->_loaded[$alias];
		}
		$componentClass = $name . 'Component';
		App::uses($componentClass, $plugin . 'Controller/Component');
		if (!class_exists($componentClass)) {
			throw new MissingComponentException(array(
				'class' => $componentClass,
				'plugin' => substr($plugin, 0, -1)
			));
		}
		$this->_loaded[$alias] = new $componentClass($this, $settings);
		$enable = isset($settings['enabled']) ? $settings['enabled'] : true;
		if ($enable) {
			$this->enable($alias);
		}
		return $this->_loaded[$alias];
	}

	public function implementedEvents() {
		return array(
			'Controller.initialize' => array('callable' => 'trigger'),
			'Controller.startup' => array('callable' => 'trigger'),
			'Controller.beforeRender' => array('callable' => 'trigger'),
			'Controller.beforeRedirect' => array('callable' => 'trigger'),
			'Controller.shutdown' => array('callable' => 'trigger'),
		);
	}

}
