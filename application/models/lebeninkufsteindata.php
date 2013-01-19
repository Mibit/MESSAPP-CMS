<?php

include_once "staticmodel.php";

class LebenInKufsteinData extends StaticModel {
	
	// SQL Fields
	public $likID;
	public $likTitel;
	public $likText;
	public $likImage;
	
	
	protected $timestampField = "likTimestamp";
	
	public function __construct($likID = null) {
		parent::__construct();
		
		$this->setTableName("lebeninkufstein");
		
		$this->setPrimary("likID");
		$this->addStringField("likTitel");
		$this->addStringField("likText");
		$this->addStringField("likImage");
        
        $this->loadFromDatabase($likID);
	}
	
	public function deleteMode() {
		$this->dbfields = array();
		$this->types = array();
	}

}