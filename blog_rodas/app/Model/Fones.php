<?php

	class Fones extends AppModel {
	
	public $name = 'Fones';

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
		
	}