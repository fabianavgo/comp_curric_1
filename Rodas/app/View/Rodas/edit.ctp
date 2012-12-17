<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Rodas', array('action' => 'edit'));
    echo $this->Form->input('Marca');
	echo $this->Form->input('Modelo');
	echo $this->Form->input('Tamanho');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Editar');