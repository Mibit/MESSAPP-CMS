<?php

class AnredeData extends MA_Model {
	
	// SQL Fields
	public $anredeID;
	public $anrede;
	
	public function __construct($anredeID = null) {
		parent::__construct();
		
		$this->setTableName("Anrede");
		
		$this->setPrimary("anredeID");
		$this->addStringField("anrede");
        
        $this->loadFromDatabase($anredeID);
	}
    
    protected function fillObject(AnredeData $anrede) {
        if($anrede->anredeID) {
            // example for additional task
            // $anrede->canDelete = !$this->hasObjects("anredeID = $anrede->anredeID", "Kunde");
            // temporary default value
            $anrede->canDelete = true;
        }
    }
    
    public function __toString() {
        if($this->anredeID) {
            return "Anrede ".$this->anrede;
        } else {
            return "neue Anrede";
        }
    }

}