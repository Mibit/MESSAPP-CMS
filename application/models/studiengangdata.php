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
		
		$this->switchToNormalMode();
        
        $this->loadFromDatabase($stgID);
	}
	
	public function getValidStudiengaenge($timestamp) {
		return $this->loadMultipleFromDatabase("timestamp > \"".MA_Model::timestampToDatetime($timestamp)."\" and freigabe = true");
	}
	
	public function getInvalidStudiengaenge($timestamp) {
		$studiengaenge = $this->getObjects("timestamp > \"".MA_Model::timestampToDatetime($timestamp)."\" and freigabe = false");
		
		$this->switchToDeletedMode(true);
		
		$studiengaenge = array_merge($studiengaenge, $this->getObjects("timestamp > \"".MA_Model::timestampToDatetime($timestamp)."\""));
		
		$this->switchToNormalMode();
		
		return $studiengaenge;
	}

	private function switchToDeletedMode($getDeleted = false) {
		$this->setTableName("geloeschte_studiengaenge");
		$this->dbfields = array();
		
		if(!$getDeleted) {
			$this->setPrimary("temp");
			$this->addNumericField("stgID");
		}
	}
	
	private function switchToNormalMode() {
		$this->setTableName("studiengaenge");
		$this->dbfields = array();
		
		$this->setPrimary("stgID");
		$this->addStringField("stgName");
		$this->addStringField("stgArt");
		$this->addStringField("highlights");
		$this->addStringField("titelbild");
		$this->addBooleanField("freigabe");
	}
	
	public function delete() {
		$this->switchToDeletedMode();
		$this->save();
		$this->switchToNormalMode();
		
		parent::delete();
	}
    
    public function __toString() {
        if($this->stgID) {
            return "Studiengang ".$this->stgID;
        } else {
            return "neuer Studiengang";
        }
    }

}