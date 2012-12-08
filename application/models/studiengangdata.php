<?php

class StudiengangData extends MA_Model {
	
	// SQL Fields
	public $stgID;
	public $stgKBez;
	public $stgBez;
	public $stgArt;
	public $stgStgL;
	public $stgStgLImage;
	public $stgStgA;
	public $stgStgAImage;
	public $stgQuote;
	public $stgHighlights;
	public $stgStgLInfo;
	public $stgStgAInfo;
	public $stgHImage1;
	public $stgHImage2;
	public $stgBigH;
	public $stgCurriculumImage;
	public $stgFOrganisationsform;
	public $stgFStudienplaetze;
	public $stgFBewerbungsmodus;
	public $stgFDauer;
	public $stgFAkadGrad;
	public $stgFUnterrichtssprache;
	public $stgFBesonderheit;
	public $stgFAuslandsaufenthalt;
	public $stgFKosten;
	public $stgFZugangsvoraussetzungen;
	public $stgFImage;
	public $stgBFelder;
	public $stgBImage1;
	public $stgBImage2;
	public $stgKBeschreibung;
	public $stgKImage1;
	public $stgKImage2;
	public $stgImage;
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
	
	private function switchToNormalMode($imagesIncluded = true) {
		$this->setTableName("studiengaenge");
		$this->dbfields = array();
		
		$this->setPrimary("stgID");
		$this->addStringField("stgKBez");
		$this->addStringField("stgBez");
		$this->addStringField("stgArt");
		$this->addStringField("stgStgL");
		$this->addStringField("stgStgA");
		$this->addStringField("stgQuote");
		$this->addStringField("stgHighlights");
		$this->addStringField("stgStgLInfo");
		$this->addStringField("stgStgAInfo");
		$this->addStringField("stgBigH");
		$this->addStringField("stgFOrganisationsform");
		$this->addStringField("stgFStudienplaetze");
		$this->addStringField("stgFBewerbungsmodus");
		$this->addStringField("stgFDauer");
		$this->addStringField("stgFAkadGrad");
		$this->addStringField("stgFUnterrichtssprache");
		$this->addStringField("stgFBesonderheit");
		$this->addStringField("stgFAuslandsaufenthalt");
		$this->addStringField("stgFKosten");
		$this->addStringField("stgFZugangsvoraussetzungen");
		$this->addStringField("stgBFelder");
		$this->addStringField("stgKBeschreibung");
		$this->addBooleanField("freigabe");
		
		if($imagesIncluded) {
			$this->addStringField("stgStgLImage");
			$this->addStringField("stgStgAImage");
			$this->addStringField("stgHImage1");
			$this->addStringField("stgHImage2");
			$this->addStringField("stgCurriculumImage");
			$this->addStringField("stgFImage");
			$this->addStringField("stgBImage1");
			$this->addStringField("stgBImage2");
			$this->addStringField("stgKImage1");
			$this->addStringField("stgKImage2");
			$this->addStringField("stgImage");
		}
	}
	
	public function save($dbfield = null) {
		if($dbfield) {
			$this->dbfields = array();
			$this->setPrimary("stgID");
			$this->addStringField($dbfield);
			
			$save = parent::save();
			$this->switchToNormalMode();
			
			return $save;
		} else {
			$this->switchToNormalMode(false);
			$save = parent::save();
			$this->switchToNormalMode();
			
			return $save;
		}
	}
	
	public function delete() {
		$this->switchToDeletedMode();
		$this->save();
		$this->switchToNormalMode();
		
		parent::delete();
	}
    
    public function __toString() {
        if($this->stgID) {
            return "Studiengang ".$this->stgKBez;
        } else {
            return "neuer Studiengang";
        }
    }

}