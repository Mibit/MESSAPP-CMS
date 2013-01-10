<?php

class ScreensaverData extends MA_Model {
	
	// SQL Fields
	public $scrID;
	public $scrText1;
	public $scrText2;
	public $scrImage;
	
	public function __construct($scrID = null) {
		parent::__construct();
		
		$this->setTableName("screensaver");
		
		$this->setPrimary("scrID");
		$this->addStringField("scrText1");
		$this->addStringField("scrText2");
		$this->addStringField("scrImage");
        
        $this->loadFromDatabase($scrID);
	}
	
	public function deleteMode() {
		$this->dbfields = array();
		$this->types = array();
	}

}