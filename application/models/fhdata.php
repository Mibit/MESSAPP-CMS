<?php

include_once "staticmodel.php";

class FhData extends StaticModel {
	
	// SQL Fields
	public $fhID;
	public $fhLogo;
	
	// Timestamp Fields for Static Data
	public $fhTimestamp;
	public $likTimestamp;
	public $phsTimestamp;
	public $scrTimestamp;
	
	
	protected $timestampField = "fhTimestamp";
	
	// statische Daten --> nur ein Datensatz
	public function __construct() {
		parent::__construct();
		
		$this->setTableName("fh");
		
		$this->setPrimary("fhID");
		$this->addStringField("fhLogo");
		$this->addStringField("fhTimestamp");
		$this->addStringField("likTimestamp");
		$this->addStringField("phsTimestamp");
		$this->addStringField("scrTimestamp");
		
		$this->loadData();		
	}
	
	private function loadData() {
		
		$entries = $this->loadMultipleFromDatabase();
		if(count($entries) == 1) {
			$thisEntry = array_shift($entries);
				
			foreach(array_merge(array($this->primary), $this->dbfields) as $field) {
				$this->$field = $thisEntry->$field;
			}			
		} elseif(count($entries) == 0) {
			// create an entry if no one exists
			$this->fhLogo = null;
			$timestamp = $this->db->query("select CURRENT_TIMESTAMP() as timestamp")->row()->timestamp;
			$this->fhTimestamp = $this->likTimestamp = $this->phsTimestamp = $this->scrTimestamp = $timestamp;
			$this->save();
		}
	}

}