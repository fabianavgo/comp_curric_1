<?php
class HelloController extends AppController {

	public function index() {
		$nomeCompleto = "Fabiana Ribeiro da Silva";
		
		$this->set('nome', $nomeCompleto);
	}

	public function contact() {

	}

	public function sobre_mim() {

	}
}