<?php
/**
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('View', 'View');
App::uses('Xml', 'Utility');

/**
 * @package       Cake.View
 * @since         CakePHP(tm) v 2.1.0
 */
class XmlView extends View {

/**
 * The subdirectory.  XML views are always in xml.
 *
 * @var string
 */
	public $subDir = 'xml';

/**
 * Constructor
 *
 * @param Controller $controller
 */
	public function __construct(Controller $controller = null) {
		parent::__construct($controller);

		if (isset($controller->response) && $controller->response instanceof CakeResponse) {
			$controller->response->type('xml');
		}
	}

/**
  * @param string $view The view being rendered.
 * @param string $layout The layout being rendered.
 * @return string The rendered view.
 */
	public function render($view = null, $layout = null) {
		if (isset($this->viewVars['_serialize'])) {
			$serialize = $this->viewVars['_serialize'];
			if (is_array($serialize)) {
				$data = array('response' => array());
				foreach ($serialize as $key) {
					$data['response'][$key] = $this->viewVars[$key];
				}
			} else {
				$data = isset($this->viewVars[$serialize]) ? $this->viewVars[$serialize] : null;
				if (is_array($data) && Set::numeric(array_keys($data))) {
					$data = array('response' => array($serialize => $data));
				}
			}
			$content = Xml::fromArray($data)->asXML();
			return $content;
		}
		if ($view !== false && $viewFileName = $this->_getViewFileName($view)) {
			if (!$this->_helpersLoaded) {
				$this->loadHelpers();
			}
			$content = $this->_render($viewFileName);
			$this->Blocks->set('content', (string)$content);
			return $content;
		}
	}

}
