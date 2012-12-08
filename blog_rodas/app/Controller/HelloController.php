<?php
class HelloController extends AppController {

	public function index() {
		$nomeCompleto = "Carli Taffarel";
		//enviando o conteudo da variavel para view
		$this->set('nome', $nomeCompleto);
	}

	public function contact() {

	}

	public function sobre_mim() {

	}
}