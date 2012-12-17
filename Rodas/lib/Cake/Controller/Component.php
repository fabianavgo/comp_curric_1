<?php

App::uses('ComponentCollection', 'Controller');

class Component extends Object {


	protected $_Collection;

	public $settings = array();

	public $components = array();

	protected $_componentMap = array();

	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->_Collection = $collection;
		$this->settings = $settings;
		$this->_set($settings);
		if (!empty($this->components)) {
			$this->_componentMap = ComponentCollection::normalizeObjectArray($this->components);
		}
	}


	public function __get($name) {
		if (isset($this->_componentMap[$name]) && !isset($this->{$name})) {
			$settings = array_merge((array)$this->_componentMap[$name]['settings'], array('enabled' => false));
			$this->{$name} = $this->_Collection->load($this->_componentMap[$name]['class'], $settings);
		}
		if (isset($this->{$name})) {
			return $this->{$name};
		}
	}

	public function initialize(Controller $controller) {
	}

	public function startup(Controller $controller) {
	}

	public function beforeRender(Controller $controller) {
	}

	public function shutdown(Controller $controller) {
	}

	public function beforeRedirect(Controller $controller, $url, $status = null, $exit = true) {
	}

}
