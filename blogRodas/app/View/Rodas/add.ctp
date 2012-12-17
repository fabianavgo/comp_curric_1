<h1>Adicionar Roda/h1>

<?php
	
	echo $this->Form->create('rodas');

	
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('rows' => 3));

	
	echo $this->Form->end("Enviar");

	?>