<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Fones', array('action' => 'edit'));
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('rows' => '4'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Editar');