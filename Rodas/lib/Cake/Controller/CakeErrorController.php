<?php

class CakeErrorController extends AppController {

	public $name = 'CakeError';

	public $uses = array();

	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		if (count(Router::extensions())) {
			$this->components[] = 'RequestHandler';
		}
		$this->constructClasses();
		if ($this->Components->enabled('Auth')) {
			$this->Components->disable('Auth');
		}
		if ($this->Components->enabled('Security')) {
			$this->Components->disable('Security');
		}
		$this->startupProcess();

		$this->_set(array('cacheAction' => false, 'viewPath' => 'Errors'));
	}

public function beforeRender() {
		parent::beforeRender();
		foreach ($this->viewVars as $key => $value) {
			if (!is_object($value)) {
				$this->viewVars[$key] = h($value);
			}
		}
	}

}
