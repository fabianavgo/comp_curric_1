<?php
	/**
	* classe Controlador alunos
	*/
	class FonesController extends AppController{
		public $helpers = array ('Html','Form');
		public $components = array("Session");
		public $name = 'Fones';


	public function index() {
        $this->set('fones', $this->Fone->find('all'));
    }

   public function view($id = null){
		$this->Fone->id = $id;
		//procurar no banco o item com id == 
		//enviando para a view os campos do item
		$this->set('fones', $this->Fone->read()); 
	}

	public function add() {
        if ($this->request->is('fones')) {
            if ($this->Fone->save($this->request->data)) {
                $this->Session->setFlash('Novo fone cadastrado com sucesso.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
    	$this->Fone->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->Fone->read();
    	} else {
        	if ($this->Fone->save($this->request->data)) {
            	$this->Session->setFlash('Fone alterado.');
            	$this->redirect(array('action' => 'index'));
        	}
    	}
	}
	public function delete($id) {
    	if (!$this->request->is('fones')) {
        	throw new MethodNotAllowedException();
    	}
    	if ($this->Fone->delete($id)) {
        	$this->Session->setFlash('O Fone: ' . $id . ' foi removido.');
        	$this->redirect(array('action' => 'index'));
    	}
	}	

}