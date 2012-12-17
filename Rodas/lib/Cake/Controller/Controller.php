<?php

App::uses('CakeResponse', 'Network');
App::uses('ClassRegistry', 'Utility');
App::uses('ComponentCollection', 'Controller');
App::uses('View', 'View');
App::uses('CakeEvent', 'Event');
App::uses('CakeEventListener', 'Event');
App::uses('CakeEventManager', 'Event');


class Controller extends Object implements CakeEventListener {

	public $name = null;

	public $uses = true;

	public $helpers = array();

	public $request;

	public $response;

	protected $_responseClass = 'CakeResponse';

	public $viewPath = null;

	public $layoutPath = null;

	public $viewVars = array();
	
	public $view = null;

	public $layout = 'default';

	public $autoRender = true;

	public $autoLayout = true;

	public $Components = null;

	public $components = array('Session');

	public $viewClass = 'View';

	public $View;

	public $ext = '.ctp';

	public $plugin = null;

	public $cacheAction = false;

	public $passedArgs = array();

	public $scaffold = false;

	public $methods = array();

	public $modelClass = null;

	public $modelKey = null;

	public $validationErrors = null;

	protected $_mergeParent = 'AppController';

	protected $_eventManager = null;

	public function __construct($request = null, $response = null) {
		if ($this->name === null) {
			$this->name = substr(get_class($this), 0, -10);
		}

		if ($this->viewPath == null) {
			$this->viewPath = $this->name;
		}

		$this->modelClass = Inflector::singularize($this->name);
		$this->modelKey = Inflector::underscore($this->modelClass);
		$this->Components = new ComponentCollection();

		$childMethods = get_class_methods($this);
		$parentMethods = get_class_methods('Controller');

		$this->methods = array_diff($childMethods, $parentMethods);

		if ($request instanceof CakeRequest) {
			$this->setRequest($request);
		}
		if ($response instanceof CakeResponse) {
			$this->response = $response;
		}
		parent::__construct();
	}

	public function __isset($name) {
		switch ($name) {
			case 'base':
			case 'here':
			case 'webroot':
			case 'data':
			case 'action':
			case 'params':
				return true;
		}

		if (is_array($this->uses)) {
			foreach ($this->uses as $modelClass) {
				list($plugin, $class) = pluginSplit($modelClass, true);
				if ($name === $class) {
					return $this->loadModel($modelClass);
				}
			}
		}

		if ($name === $this->modelClass) {
			list($plugin, $class) = pluginSplit($name, true);
			if (!$plugin) {
				$plugin = $this->plugin ? $this->plugin . '.' : null;
			}
			return $this->loadModel($plugin . $this->modelClass);
		}

		return false;
	}

	public function __get($name) {
		switch ($name) {
			case 'base':
			case 'here':
			case 'webroot':
			case 'data':
				return $this->request->{$name};
			case 'action':
				return isset($this->request->params['action']) ? $this->request->params['action'] : '';
			case 'params':
				return $this->request;
			case 'paginate':
				return $this->Components->load('Paginator')->settings;
		}

		if (isset($this->{$name})) {
			return $this->{$name};
		}

		return null;
	}

	public function __set($name, $value) {
		switch ($name) {
			case 'base':
			case 'here':
			case 'webroot':
			case 'data':
				return $this->request->{$name} = $value;
			case 'action':
				return $this->request->params['action'] = $value;
			case 'params':
				return $this->request->params = $value;
			case 'paginate':
				return $this->Components->load('Paginator')->settings = $value;
		}
		return $this->{$name} = $value;
	}


	public function setRequest(CakeRequest $request) {
		$this->request = $request;
		$this->plugin = isset($request->params['plugin']) ? Inflector::camelize($request->params['plugin']) : null;
		$this->view = isset($request->params['action']) ? $request->params['action'] : null;
		if (isset($request->params['pass']) && isset($request->params['named'])) {
			$this->passedArgs = array_merge($request->params['pass'], $request->params['named']);
		}

		if (array_key_exists('return', $request->params) && $request->params['return'] == 1) {
			$this->autoRender = false;
		}
		if (!empty($request->params['bare'])) {
			$this->autoLayout = false;
		}
	}

	public function invokeAction(CakeRequest $request) {
		try {
			$method = new ReflectionMethod($this, $request->params['action']);

			if ($this->_isPrivateAction($method, $request)) {
				throw new PrivateActionException(array(
					'controller' => $this->name . "Controller",
					'action' => $request->params['action']
				));
			}
			return $method->invokeArgs($this, $request->params['pass']);

		} catch (ReflectionException $e) {
			if ($this->scaffold !== false) {
				return $this->_getScaffold($request);
			}
			throw new MissingActionException(array(
				'controller' => $this->name . "Controller",
				'action' => $request->params['action']
			));
		}
	}

	protected function _isPrivateAction(ReflectionMethod $method, CakeRequest $request) {
		$privateAction = (
			$method->name[0] === '_' ||
			!$method->isPublic() ||
			!in_array($method->name,  $this->methods)
		);
		$prefixes = Router::prefixes();

		if (!$privateAction && !empty($prefixes)) {
			if (empty($request->params['prefix']) && strpos($request->params['action'], '_') > 0) {
				list($prefix) = explode('_', $request->params['action']);
				$privateAction = in_array($prefix, $prefixes);
			}
		}
		return $privateAction;
	}

protected function _getScaffold(CakeRequest $request) {
		return new Scaffold($this, $request);
	}

	protected function _mergeControllerVars() {
		$pluginController = $pluginDot = null;
		$mergeParent = is_subclass_of($this, $this->_mergeParent);
		$pluginVars = array();
		$appVars = array();

		if (!empty($this->plugin)) {
			$pluginController = $this->plugin . 'AppController';
			if (!is_subclass_of($this, $pluginController)) {
				$pluginController = null;
			}
			$pluginDot = $this->plugin . '.';
		}

		if ($pluginController) {
			$merge = array('components', 'helpers');
			$this->_mergeVars($merge, $pluginController);
		}

		if ($mergeParent || !empty($pluginController)) {
			$appVars = get_class_vars($this->_mergeParent);
			$uses = $appVars['uses'];
			$merge = array('components', 'helpers');
			$this->_mergeVars($merge, $this->_mergeParent, true);
		}

		if ($this->uses === null) {
			$this->uses = false;
		}
		if ($this->uses === true) {
			$this->uses = array($pluginDot . $this->modelClass);
		}
		if (isset($appVars['uses']) && $appVars['uses'] === $this->uses) {
			array_unshift($this->uses, $pluginDot . $this->modelClass);
		}
		if ($pluginController) {
			$pluginVars = get_class_vars($pluginController);
		}
		if ($this->uses !== false) {
			$this->_mergeUses($pluginVars);
			$this->_mergeUses($appVars);
		} else {
			$this->uses = array();
			$this->modelClass = '';
		}
	}

	protected function _mergeUses($merge) {
		if (!isset($merge['uses'])) {
			return;
		}
		if ($merge['uses'] === true) {
			return;
		}
		$this->uses = array_merge(
			$this->uses,
			array_diff($merge['uses'], $this->uses)
		);
	}

	public function implementedEvents() {
		return array(
			'Controller.initialize' => 'beforeFilter',
			'Controller.beforeRender' => 'beforeRender',
			'Controller.beforeRedirect' => array('callable' => 'beforeRedirect', 'passParams' => true),
			'Controller.shutdown' => 'afterFilter'
		);
	}

	public function constructClasses() {
		$this->_mergeControllerVars();
		$this->Components->init($this);
		if ($this->uses) {
			$this->uses = (array)$this->uses;
			list(, $this->modelClass) = pluginSplit(current($this->uses));
		}
		return true;
	}

	public function getEventManager() {
		if (empty($this->_eventManager)) {
			$this->_eventManager = new CakeEventManager();
			$this->_eventManager->attach($this->Components);
			$this->_eventManager->attach($this);
		}
		return $this->_eventManager;
	}

	public function startupProcess() {
		$this->getEventManager()->dispatch(new CakeEvent('Controller.initialize', $this));
		$this->getEventManager()->dispatch(new CakeEvent('Controller.startup', $this));
	}

	public function shutdownProcess() {
		$this->getEventManager()->dispatch(new CakeEvent('Controller.shutdown', $this));
	}

	public function httpCodes($code = null) {
		return $this->response->httpCodes($code);
	}

	public function loadModel($modelClass = null, $id = null) {
		if ($modelClass === null) {
			$modelClass = $this->modelClass;
		}

		$this->uses = ($this->uses) ? (array)$this->uses : array();
		if (!in_array($modelClass, $this->uses)) {
			$this->uses[] = $modelClass;
		}

		list($plugin, $modelClass) = pluginSplit($modelClass, true);

		$this->{$modelClass} = ClassRegistry::init(array(
			'class' => $plugin . $modelClass, 'alias' => $modelClass, 'id' => $id
		));
		if (!$this->{$modelClass}) {
			throw new MissingModelException($modelClass);
		}
		return true;
	}


	public function redirect($url, $status = null, $exit = true) {
		$this->autoRender = false;

		if (is_array($status)) {
			extract($status, EXTR_OVERWRITE);
		}
		$event = new CakeEvent('Controller.beforeRedirect', $this, array($url, $status, $exit));
		
		list($event->break, $event->breakOn, $event->collectReturn) = array(true, false, true);
		$this->getEventManager()->dispatch($event);

		if ($event->isStopped()) {
			return;
		}
		$response = $event->result;
		extract($this->_parseBeforeRedirect($response, $url, $status, $exit), EXTR_OVERWRITE);

		if ($url !== null) {
			$this->response->header('Location', Router::url($url, true));
		}

		if (is_string($status)) {
			$codes = array_flip($this->response->httpCodes());
			if (isset($codes[$status])) {
				$status = $codes[$status];
			}
		}

		if ($status) {
			$this->response->statusCode($status);
		}

		if ($exit) {
			$this->response->send();
			$this->_stop();
		}
	}


	protected function _parseBeforeRedirect($response, $url, $status, $exit) {
		if (is_array($response) && isset($response[0])) {
			foreach ($response as $resp) {
				if (is_array($resp) && isset($resp['url'])) {
					extract($resp, EXTR_OVERWRITE);
				} elseif ($resp !== null) {
					$url = $resp;
				}
			}
		} elseif (is_array($response)) {
			extract($response, EXTR_OVERWRITE);
		}
		return compact('url', 'status', 'exit');
	}

	public function header($status) {
		$this->response->header($status);
	}

	public function set($one, $two = null) {
		if (is_array($one)) {
			if (is_array($two)) {
				$data = array_combine($one, $two);
			} else {
				$data = $one;
			}
		} else {
			$data = array($one => $two);
		}
		$this->viewVars = $data + $this->viewVars;
	}

	public function setAction($action) {
		$this->request->params['action'] = $action;
		$this->view = $action;
		$args = func_get_args();
		unset($args[0]);
		return call_user_func_array(array(&$this, $action), $args);
	}

	public function validate() {
		$args = func_get_args();
		$errors = call_user_func_array(array(&$this, 'validateErrors'), $args);

		if ($errors === false) {
			return 0;
		}
		return count($errors);
	}

public function validateErrors() {
		$objects = func_get_args();

		if (empty($objects)) {
			return false;
		}

		$errors = array();
		foreach ($objects as $object) {
			if (isset($this->{$object->alias})) {
				$object = $this->{$object->alias};
			}
			$object->set($object->data);
			$errors = array_merge($errors, $object->invalidFields());
		}

		return $this->validationErrors = (!empty($errors) ? $errors : false);
	}


	public function render($view = null, $layout = null) {
		$event = new CakeEvent('Controller.beforeRender', $this);
		$this->getEventManager()->dispatch($event);
		if ($event->isStopped()) {
			$this->autoRender = false;
			return $this->response;
		}

		if (!empty($this->uses) && is_array($this->uses)) {
			foreach ($this->uses as $model) {
				list($plugin, $className) = pluginSplit($model);
				$this->request->params['models'][$className] = compact('plugin', 'className');
			}
		}

		$viewClass = $this->viewClass;
		if ($this->viewClass != 'View') {
			list($plugin, $viewClass) = pluginSplit($viewClass, true);
			$viewClass = $viewClass . 'View';
			App::uses($viewClass, $plugin . 'View');
		}

		$View = new $viewClass($this);

		$models = ClassRegistry::keys();
		foreach ($models as $currentModel) {
			$currentObject = ClassRegistry::getObject($currentModel);
			if (is_a($currentObject, 'Model')) {
				$className = get_class($currentObject);
				list($plugin) = pluginSplit(App::location($className));
				$this->request->params['models'][$currentObject->alias] = compact('plugin', 'className');
				$View->validationErrors[$currentObject->alias] =& $currentObject->validationErrors;
			}
		}

		$this->autoRender = false;
		$this->View = $View;
		$this->response->body($View->render($view, $layout));
		return $this->response;
	}

	public function referer($default = null, $local = false) {
		if ($this->request) {
			$referer = $this->request->referer($local);
			if ($referer == '/' && $default != null) {
				return Router::url($default, true);
			}
			return $referer;
		}
		return '/';
	}

public function disableCache() {
		$this->response->disableCache();
	}


	public function flash($message, $url, $pause = 1, $layout = 'flash') {
		$this->autoRender = false;
		$this->set('url', Router::url($url));
		$this->set('message', $message);
		$this->set('pause', $pause);
		$this->set('page_title', $message);
		$this->render(false, $layout);
	}


	public function postConditions($data = array(), $op = null, $bool = 'AND', $exclusive = false) {
		if (!is_array($data) || empty($data)) {
			if (!empty($this->request->data)) {
				$data = $this->request->data;
			} else {
				return null;
			}
		}
		$cond = array();

		if ($op === null) {
			$op = '';
		}

		$arrayOp = is_array($op);
		foreach ($data as $model => $fields) {
			foreach ($fields as $field => $value) {
				$key = $model . '.' . $field;
				$fieldOp = $op;
				if ($arrayOp) {
					if (array_key_exists($key, $op)) {
						$fieldOp = $op[$key];
					} elseif (array_key_exists($field, $op)) {
						$fieldOp = $op[$field];
					} else {
						$fieldOp = false;
					}
				}
				if ($exclusive && $fieldOp === false) {
					continue;
				}
				$fieldOp = strtoupper(trim($fieldOp));
				if ($fieldOp === 'LIKE') {
					$key = $key . ' LIKE';
					$value = '%' . $value . '%';
				} elseif ($fieldOp && $fieldOp != '=') {
					$key = $key . ' ' . $fieldOp;
				}
				$cond[$key] = $value;
			}
		}
		if ($bool != null && strtoupper($bool) != 'AND') {
			$cond = array($bool => $cond);
		}
		return $cond;
	}


	public function paginate($object = null, $scope = array(), $whitelist = array()) {
		return $this->Components->load('Paginator', $this->paginate)->paginate($object, $scope, $whitelist);
	}


	public function beforeFilter() {
	}

	public function beforeRender() {
	}


	public function beforeRedirect($url, $status = null, $exit = true) {
	}

	public function afterFilter() {
	}

	public function beforeScaffold($method) {
		return true;
	}


	protected function _beforeScaffold($method) {
		return $this->beforeScaffold($method);
	}

	public function afterScaffoldSave($method) {
		return true;
	}

	protected function _afterScaffoldSave($method) {
		return $this->afterScaffoldSave($method);
	}


	public function afterScaffoldSaveError($method) {
		return true;
	}

	protected function _afterScaffoldSaveError($method) {
		return $this->afterScaffoldSaveError($method);
	}


	public function scaffoldError($method) {
		return false;
	}


	protected function _scaffoldError($method) {
		return $this->scaffoldError($method);
	}

}
