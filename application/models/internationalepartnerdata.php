<?php

include_once "staticmodel.php";

class InternationalePartnerData extends StaticModel {
	
	// SQL Fields
	public $phsID;
	public $phsLand;
	public $phsPartnerhochschulen;
	
	
	protected $timestampField = "phsTimestamp";
	
	public function __construct($phsID = null) {
		parent::__construct();
		
		$this->setTableName("partnerhochschulen");
		
		$this->setPrimary("phsID");
		$this->addStringField("phsLand");
		$this->addStringField("phsPartnerhochschulen");
        
        $this->loadFromDatabase($phsID);
	}
	
	public function deleteMode() {
		$this->dbfields = array();
		$this->types = array();
	}

}