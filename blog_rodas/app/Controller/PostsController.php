<?php

	class PostsController extends AppController {
		public $helpers = array ("Html","Form");
		public $components = array("Session");
		//action
		// /posts/index
		public function index() {
			$todosAsPostagens = $this->Post->find('all');

			//vai para a view
			$this->set('posts', $todosAsPostagens);
		}

		
		public function view($id = null) {
			
			$this->Post->id = $id;
	
			$p = $this->Post->read();

			$this->set('post', $p);
		}

		// post/add
		public function add() {
			//se for enviado um post salvar os dados inseridos nos formularios e enviar para o banco
			if ($this->request->is('post')) {
				//
				$dadosDoFormulario = $this->request->data;

				//tentar salvar os dados no banco
				//se conseguir salvar , mostrar uma mensagem e redicionar para o INDEX
				if ($this->Post->save($dadosDoFormulario)) {
					//Exibir a mensagem
					$this->Session->setFlash("Postagem salva com sucesso");
					
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		public function edit($id = null) {
    		$this->Post->id = $id;

    		if ($this->request->is('get')) {
        		$this->request->data = $this->Post->read();
    		} else {
        		if ($this->Post->save($this->request->data)) {
            		$this->Session->setFlash('Your post has been updated.');
	            	$this->redirect(array('action' => 'index'));
    	    	}
    		}
		}

		public function  delete($id) {
    		if (!$this->request->is('post')) {
    	    	throw new MethodNotAllowedException();
		    }
    		if ($this->Post->delete($id)) {
    		    $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
 	       		$this->redirect(array('action' => 'index'));
		    }
		}
	}