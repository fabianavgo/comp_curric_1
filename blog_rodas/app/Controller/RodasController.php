<?php
	/**
	* classe Controlador alunos
	*/
	class AlunosController extends AppController{
		public $helpers = array ('Html','Form');
		public $components = array("Session");
		public $name = 'Alunos';


	public function index() {
        $this->set('alunos', $this->Aluno->find('all'));
    }

    function view($id = null){
		$this->Aluno->id = $id;
		//procurar no banco o item com id == 
		//enviando para a view os campos do item
		$this->set('aluno', $this->Aluno->read()); 
	}

	public function add() {
        if ($this->request->is('post')) {
            if ($this->Aluno->save($this->request->data)) {
                $this->Session->setFlash('Aluno cadastrado com sucesso.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
    	$this->Aluno->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->Aluno->read();
    	} else {
        	if ($this->Aluno->save($this->request->data)) {
            	$this->Session->setFlash('Cadastro atualizado.');
            	$this->redirect(array('action' => 'index'));
        	}
    	}
	}
	public function delete($id) {
    	if (!$this->request->is('post')) {
        	throw new MethodNotAllowedException();
    	}
    	if ($this->Aluno->delete($id)) {
        	$this->Session->setFlash('O aluno: ' . $id . ' foi removido.');
        	$this->redirect(array('action' => 'index'));
    	}
	}	

}