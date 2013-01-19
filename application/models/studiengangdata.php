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
	public $stgStudent1Quote;
	public $stgStudent1Image;
	public $stgStudent2Quote;
	public $stgStudent2Image;
	public $stgQuote;
	public $stgHighlights;
	public $stgStgLInfo;
	public $stgStgAInfo;
	public $stgHImage;
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
	public $stgFImage;
	public $stgBFelder;
	public $stgBImage;
	public $stgKBeschreibung;
	public $stgKImage;
	public $stgGridViewImage;
	public $freigabe;
	public $timestamp;
	
	public function __construct($stgID = null) {
		parent::__construct();
		
		$this->switchToNormalMode();
        
        $this->loadFromDatabase($stgID);
	}
	
	public function getValidStudiengaenge($timestamp) {
		return parent::loadMultipleFromDatabase("timestamp > FROM_UNIXTIME(".$timestamp.") and freigabe = true");
	}
	
	public function getInvalidStudiengaenge($timestamp) {
		$this->switchToNormalMode(false);
		$studiengaenge = $this->getObjects("timestamp > FROM_UNIXTIME(".$timestamp.") and freigabe = false");
		
		$this->switchToDeletedMode(true);
		
		$studiengaenge = array_merge($studiengaenge, $this->getObjects("timestamp > FROM_UNIXTIME(".$timestamp.")"));
		
		$this->switchToNormalMode();
		
		return $studiengaenge;
	}

	private function switchToDeletedMode($getDeleted = false) {
		$this->setTableName("geloeschte_studiengaenge");
		$this->dbfields = array();
		$this->types = array();
		
		if(!$getDeleted) {
			$this->setPrimary("temp");
			$this->addNumericField("stgID");
		}
	}
	
	public function loadMultipleFromDatabase($SQLWhere = null,$order = '', $ordertype = "ASC", $limitFrom = NULL, $limitCount = NULL) {
		$this->switchToNormalMode(false, true);
		
		return parent::loadMultipleFromDatabase($SQLWhere,$order, $ordertype, $limitFrom, $limitCount);
	}
	
	protected function fillObject(StudiengangData $stg) {
		
		switch(strtolower($stg->stgArt)) {
			case "b":
				$stg->stgArtLong = "Bachelor";
				break;
			case "m":
				$stg->stgArtLong = "Master";
				break;
			case "p";
				$stg->stgArtLong = "Post Graduate";
				break;
			default:
				$stg->stgArtLong = "";
		}
		switch(strtolower($stg->stgFOrganisationsform)) {
			case "vz":
				$stg->stgFOrganisationsformLong = "Vollzeit";
				break;
			case "bb":
				$stg->stgFOrganisationsformLong = "Berufsbegleitend";
				break;
			default:
				$stg->stgFOrganisationsform = "";			
		}
	}
	
	public function getArtKurz() {
		switch(strtolower($this->stgArt)) {
			case "b":
				return "BA";
				break;
			case "m":
				return "MA";
				break;
			case "p";
				return "PG";
				break;
			default:
				return "";
		}
	}
	
	public function getOrganisationformKurz() {
		return strtolower($this->stgFOrganisationsform);
	}
	
	private function switchToNormalMode($imagesIncluded = true, $timestampIncluded = false) {
		$this->setTableName("studiengaenge");
		$this->dbfields = array();
		$this->types = array();
		
		$this->setPrimary("stgID");
		$this->addStringField("stgKBez");
		$this->addStringField("stgBez");
		$this->addStringField("stgArt");
		$this->addStringField("stgStgL");
		$this->addStringField("stgStgA");
		$this->addStringField("stgStudent1Quote");
		$this->addStringField("stgStudent1Image");
		$this->addStringField("stgStudent2Quote");
		$this->addStringField("stgStudent2Image");
		$this->addStringField("stgQuote");
		$this->addStringField("stgHighlights");
		$this->addStringField("stgStgLInfo");
		$this->addStringField("stgStgAInfo");
		$this->addStringField("stgFOrganisationsform");
		$this->addStringField("stgFStudienplaetze");
		$this->addStringField("stgFBewerbungsmodus");
		$this->addStringField("stgFDauer");
		$this->addStringField("stgFAkadGrad");
		$this->addStringField("stgFUnterrichtssprache");
		$this->addStringField("stgFBesonderheit");
		$this->addStringField("stgFAuslandsaufenthalt");
		$this->addStringField("stgFKosten");
		$this->addStringField("stgBFelder");
		$this->addStringField("stgKBeschreibung");
		$this->addBooleanField("freigabe");
		
		if($imagesIncluded) {
			$this->addStringField("stgStgLImage");
			$this->addStringField("stgStgAImage");
			$this->addStringField("stgHImage");
			$this->addStringField("stgCurriculumImage");
			$this->addStringField("stgFImage");
			$this->addStringField("stgBImage");
			$this->addStringField("stgKImage");
			$this->addStringField("stgGridViewImage");
		}
		
		if($timestampIncluded) {
			$this->addDateField("timestamp");
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
    
    public function checkFreigabe() {
    	try {
    	$this->switchToNormalMode(true, false);
    	foreach($this->dbfields as $key=>$dbfield) {
    		if($this->types[$key] != self::DB_TYPE_BOOLEAN && !$this->$dbfield) {
    			throw new Exception();
    		}
    	}
    	return true;
    	} catch(Exception $e) {
    		return false;
    	}
    }

    public function getTimestampFormatted() { return MA_Model::timestampToDatetime($this->timestamp, false); }
}