<?php

include_once "staticmodel.php";

class ScreensaverData extends StaticModel {
	
	// SQL Fields
	public $scrID;
	public $scrText1;
	public $scrText2;
	public $scrImage;
	
	
	protected $timestampField = "scrTimestamp";
	
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