<?php
	
	class RodasController extends AppController{
		public $helpers = array ('Html','Form');
		public $components = array("Session");
		public $name = 'Rodas';


	public function index() {
        $this->set('rodas', $this->Roda->find('all'));
    }

    function view($id = null){
		$this->Roda->id = $id;
		//busca pelo id
		$this->set('roda', $this->Roda->read()); 
	}

	public function add() {
        if ($this->request->is('post')) {
            if ($this->Roda->save($this->request->data)) {
                $this->Session->setFlash('A roda foi cadastrada com sucesso.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
    	$this->Roda->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->Roda->read();
    	} else {
        	if ($this->Roda->save($this->request->data)) {
            	$this->Session->setFlash('Atualizado.');
            	$this->redirect(array('action' => 'index'));
        	}
    	}
	}
	public function delete($id) {
    	if (!$this->request->is('posMat')) {
        	throw new MethodNotAllowedException();
    	}
    	if ($this->Roda->delete($id)) {
        	$this->Session->setFlash('A roda: ' . $id . ' foi removido.');
        	$this->redirect(array('action' => 'index'));
    	}
	}	

}