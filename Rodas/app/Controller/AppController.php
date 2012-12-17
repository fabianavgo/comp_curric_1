<?php

App::uses('Controller', 'Controller');

class AppController extends Controller 
{
	public $components = array('Auth','Session','Error');

	public function beforeFilter()
	{
		$this->Auth->authenticate = array('Form');

		$this->Auth->loginRedirect = array('action' => 'home', 'controller' => 'users');
		$this->Auth->logoutRedirect = array('action' => 'home', 'controller' => 'pages');
		$this->Auth->authError = 'You are not allowed to see that.';

		# To enable portuguese language as main
		Configure::write('Config.language', 'por');
	}	
}


