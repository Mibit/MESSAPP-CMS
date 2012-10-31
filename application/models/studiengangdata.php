<?php

class StudiengangData extends MA_Model {
	
	// SQL Fields
	public $stgID;
	public $stgName;
	public $stgArt;
	public $highlights;
	public $titelbild;
	public $freigabe;
	
	public function __construct($stgID = null) {
		parent::__construct();
		
		$this->setTableName("studiengaenge");
		
		$this->setPrimary("stgID");
		$this->addStringField("stgName");
		$this->addStringField("stgArt");
		$this->addStringField("highlights");
		$this->addNumericField("titelbild");
		$this->addBooleanField("freigabe");
        
        $this->loadFromDatabase($stgID);
	}

    
    public function __toString() {
        if($this->stgID) {
            return "Studiengang ".$this->stgID;
        } else {
            return "neuer Studiengang";
        }
    }

}