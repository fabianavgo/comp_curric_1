<h1>Adicionando Fone</h1>

<?php
	//criando o formulario atraves do AJUDANTE Form
	echo $this->Form->create('fones');

	//gerando os inputs atraves do AJUDANTE Fomr
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('rows' => 3));

	//fechando o formulario e gerando o botão Submit
	echo $this->Form->end("Enviar");