<?php

class LandData extends MA_Model {
	
	// SQL Fields
	public $code;
	public $en;
	public $de;
	
	public function __construct($code = null) {
		parent::__construct();
		
		$this->setTableName("land");
		
		$this->setPrimary("code");
		$this->addStringField("en");
		$this->addStringField("de");
        
        $this->loadFromDatabase($code);
	}

}