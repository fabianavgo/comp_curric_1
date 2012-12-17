<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {
	public $name = 'Pages';

	public $helpers = array('Html', 'Session');

	public $uses = array();

	public function beforeFilter()
	{
		parent::beforeFilter();

		$this->Auth->allow('home');
	}
	public function display() {

	}
	/* Public page to login */
	public function home()
	{
		if( AuthComponent::user('id') ) 
		{
			$this->redirect(array('controller' => 'users','action' => 'home'));
		}
	}
}
