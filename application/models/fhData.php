<?php

class FhData extends MA_Model {
	
	// SQL Fields
	public $fhLogo;
	
	// statische Daten --> nur ein Datensatz
	public function __construct() {
		parent::__construct();
		
		$this->setTableName("fh");
		
		$this->addStringField("fhLogo");
		
		loadData();		
	}
	
	private function loadData() {
		
		$result = $this->db->query("select " . implode(", ", $this->dbfields) . " from $this->tablename")->result();
        
		if(count($result)) {
			$row = array_shift($result);
			
			foreach($this->dbfields as $field) {
				$this->$field = $row->$field;
			}
		}
	}

}