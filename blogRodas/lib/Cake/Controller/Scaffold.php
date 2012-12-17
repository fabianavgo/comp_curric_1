<?php

App::uses('Scaffold', 'View');


class Scaffold {


	public $controller = null;

	public $name = null;


	public $model = null;

	public $viewPath;


	public $layout = 'default';


	public $request;

	protected $_validSession = null;

	protected $_passedVars = array(
		'layout', 'name', 'viewPath', 'request'
	);

	public $scaffoldTitle = null;

	public function __construct(Controller $controller, CakeRequest $request) {
		$this->controller = $controller;

		$count = count($this->_passedVars);
		for ($j = 0; $j < $count; $j++) {
			$var = $this->_passedVars[$j];
			$this->{$var} = $controller->{$var};
		}

		$this->redirect = array('action' => 'index');

		$this->modelClass = $controller->modelClass;
		$this->modelKey = $controller->modelKey;

		if (!is_object($this->controller->{$this->modelClass})) {
			throw new MissingModelException($this->modelClass);
		}

		$this->ScaffoldModel = $this->controller->{$this->modelClass};
		$this->scaffoldTitle = Inflector::humanize(Inflector::underscore($this->viewPath));
		$this->scaffoldActions = $controller->scaffold;
		$title = __d('cake', 'Scaffold :: ') . Inflector::humanize($request->action) . ' :: ' . $this->scaffoldTitle;
		$modelClass = $this->controller->modelClass;
		$primaryKey = $this->ScaffoldModel->primaryKey;
		$displayField = $this->ScaffoldModel->displayField;
		$singularVar = Inflector::variable($modelClass);
		$pluralVar = Inflector::variable($this->controller->name);
		$singularHumanName = Inflector::humanize(Inflector::underscore($modelClass));
		$pluralHumanName = Inflector::humanize(Inflector::underscore($this->controller->name));
		$scaffoldFields = array_keys($this->ScaffoldModel->schema());
		$associations = $this->_associations();

		$this->controller->set(compact(
			'title_for_layout', 'modelClass', 'primaryKey', 'displayField', 'singularVar', 'pluralVar',
			'singularHumanName', 'pluralHumanName', 'scaffoldFields', 'associations'
		));
		$this->controller->set('title_for_layout', $title);

		if ($this->controller->viewClass) {
			$this->controller->viewClass = 'Scaffold';
		}
		$this->_validSession = (
			isset($this->controller->Session) && $this->controller->Session->valid() != false
		);
		$this->_scaffold($request);
	}

	protected function _scaffoldView(CakeRequest $request) {
		if ($this->controller->beforeScaffold('view')) {
			if (isset($request->params['pass'][0])) {
				$this->ScaffoldModel->id = $request->params['pass'][0];
			}
			if (!$this->ScaffoldModel->exists()) {
				throw new NotFoundException(__d('cake', 'Invalid %s', Inflector::humanize($this->modelKey)));
			}
			$this->ScaffoldModel->recursive = 1;
			$this->controller->request->data = $this->ScaffoldModel->read();
			$this->controller->set(
				Inflector::variable($this->controller->modelClass), $this->request->data
			);
			$this->controller->render($this->request['action'], $this->layout);
		} elseif ($this->controller->scaffoldError('view') === false) {
			return $this->_scaffoldError();
		}
	}

	protected function _scaffoldIndex($params) {
		if ($this->controller->beforeScaffold('index')) {
			$this->ScaffoldModel->recursive = 0;
			$this->controller->set(
				Inflector::variable($this->controller->name), $this->controller->paginate()
			);
			$this->controller->render($this->request['action'], $this->layout);
		} elseif ($this->controller->scaffoldError('index') === false) {
			return $this->_scaffoldError();
		}
	}

	protected function _scaffoldForm($action = 'edit') {
		$this->controller->viewVars['scaffoldFields'] = array_merge(
			$this->controller->viewVars['scaffoldFields'],
			array_keys($this->ScaffoldModel->hasAndBelongsToMany)
		);
		$this->controller->render($action, $this->layout);
	}

protected function _scaffoldSave(CakeRequest $request, $action = 'edit') {
		$formAction = 'edit';
		$success = __d('cake', 'updated');
		if ($action === 'add') {
			$formAction = 'add';
			$success = __d('cake', 'saved');
		}

		if ($this->controller->beforeScaffold($action)) {
			if ($action == 'edit') {
				if (isset($request->params['pass'][0])) {
					$this->ScaffoldModel->id = $request['pass'][0];
				}
				if (!$this->ScaffoldModel->exists()) {
					throw new NotFoundException(__d('cake', 'Invalid %s', Inflector::humanize($this->modelKey)));
				}
			}

			if (!empty($request->data)) {
				if ($action == 'create') {
					$this->ScaffoldModel->create();
				}

				if ($this->ScaffoldModel->save($request->data)) {
					if ($this->controller->afterScaffoldSave($action)) {
						$message = __d('cake',
							'The %1$s has been %2$s',
							Inflector::humanize($this->modelKey),
							$success
						);
						return $this->_sendMessage($message);
					} else {
						return $this->controller->afterScaffoldSaveError($action);
					}
				} else {
					if ($this->_validSession) {
						$this->controller->Session->setFlash(__d('cake', 'Please correct errors below.'));
					}
				}
			}

			if (empty($request->data)) {
				if ($this->ScaffoldModel->id) {
					$this->controller->data = $request->data = $this->ScaffoldModel->read();
				} else {
					$this->controller->data = $request->data = $this->ScaffoldModel->create();
				}
			}

			foreach ($this->ScaffoldModel->belongsTo as $assocName => $assocData) {
				$varName = Inflector::variable(Inflector::pluralize(
					preg_replace('/(?:_id)$/', '', $assocData['foreignKey'])
				));
				$this->controller->set($varName, $this->ScaffoldModel->{$assocName}->find('list'));
			}
			foreach ($this->ScaffoldModel->hasAndBelongsToMany as $assocName => $assocData) {
				$varName = Inflector::variable(Inflector::pluralize($assocName));
				$this->controller->set($varName, $this->ScaffoldModel->{$assocName}->find('list'));
			}

			return $this->_scaffoldForm($formAction);
		} elseif ($this->controller->scaffoldError($action) === false) {
			return $this->_scaffoldError();
		}
	}

	protected function _scaffoldDelete(CakeRequest $request) {
		if ($this->controller->beforeScaffold('delete')) {
			if (!$request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$id = false;
			if (isset($request->params['pass'][0])) {
				$id = $request->params['pass'][0];
			}
			$this->ScaffoldModel->id = $id;
			if (!$this->ScaffoldModel->exists()) {
				throw new NotFoundException(__d('cake', 'Invalid %s', Inflector::humanize($this->modelClass)));
			}
			if ($this->ScaffoldModel->delete()) {
				$message = __d('cake', 'The %1$s with id: %2$s has been deleted.', Inflector::humanize($this->modelClass), $id);
				return $this->_sendMessage($message);
			} else {
				$message = __d('cake',
					'There was an error deleting the %1$s with id: %2$s',
					Inflector::humanize($this->modelClass),
					$id
				);
				return $this->_sendMessage($message);
			}
		} elseif ($this->controller->scaffoldError('delete') === false) {
			return $this->_scaffoldError();
		}
	}

	protected function _sendMessage($message) {
		if ($this->_validSession) {
			$this->controller->Session->setFlash($message);
			$this->controller->redirect($this->redirect);
		} else {
			$this->controller->flash($message, $this->redirect);
		}
	}

	protected function _scaffoldError() {
		return $this->controller->render('error', $this->layout);
	}

	protected function _scaffold(CakeRequest $request) {
		$db = ConnectionManager::getDataSource($this->ScaffoldModel->useDbConfig);
		$prefixes = Configure::read('Routing.prefixes');
		$scaffoldPrefix = $this->scaffoldActions;

		if (isset($db)) {
			if (empty($this->scaffoldActions)) {
				$this->scaffoldActions = array(
					'index', 'list', 'view', 'add', 'create', 'edit', 'update', 'delete'
				);
			} elseif (!empty($prefixes) && in_array($scaffoldPrefix, $prefixes)) {
				$this->scaffoldActions = array(
					$scaffoldPrefix . '_index',
					$scaffoldPrefix . '_list',
					$scaffoldPrefix . '_view',
					$scaffoldPrefix . '_add',
					$scaffoldPrefix . '_create',
					$scaffoldPrefix . '_edit',
					$scaffoldPrefix . '_update',
					$scaffoldPrefix . '_delete'
				);
			}

			if (in_array($request->params['action'], $this->scaffoldActions)) {
				if (!empty($prefixes)) {
					$request->params['action'] = str_replace($scaffoldPrefix . '_', '', $request->params['action']);
				}
				switch ($request->params['action']) {
					case 'index':
					case 'list':
						$this->_scaffoldIndex($request);
					break;
					case 'view':
						$this->_scaffoldView($request);
					break;
					case 'add':
					case 'create':
						$this->_scaffoldSave($request, 'add');
					break;
					case 'edit':
					case 'update':
						$this->_scaffoldSave($request, 'edit');
					break;
					case 'delete':
						$this->_scaffoldDelete($request);
					break;
				}
			} else {
				throw new MissingActionException(array(
					'controller' => $this->controller->name,
					'action' => $request->action
				));
			}
		} else {
			throw new MissingDatabaseException(array('connection' => $this->ScaffoldModel->useDbConfig));
		}
	}

	protected function _associations() {
		$keys = array('belongsTo', 'hasOne', 'hasMany', 'hasAndBelongsToMany');
		$associations = array();

		foreach ($keys as $key => $type) {
			foreach ($this->ScaffoldModel->{$type} as $assocKey => $assocData) {
				$associations[$type][$assocKey]['primaryKey'] =
					$this->ScaffoldModel->{$assocKey}->primaryKey;

				$associations[$type][$assocKey]['displayField'] =
					$this->ScaffoldModel->{$assocKey}->displayField;

				$associations[$type][$assocKey]['foreignKey'] =
					$assocData['foreignKey'];

				$associations[$type][$assocKey]['controller'] =
					Inflector::pluralize(Inflector::underscore($assocData['className']));

				if ($type == 'hasAndBelongsToMany') {
					$associations[$type][$assocKey]['with'] = $assocData['with'];
				}
			}
		}
		return $associations;
	}

}
