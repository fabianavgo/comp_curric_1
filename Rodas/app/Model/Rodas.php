<?php

	class Rodas extends AppModel {
	
	public $name = 'Rodas';

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
		
	}