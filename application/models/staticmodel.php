<?php

class StaticModel extends MA_Model {
	
	protected $timestampField;
	
	public function deleteMode() {
		$this->dbfields = array();
		$this->types = array();
	}
	
	public function save($parentOnly = false) {
		
		$save = parent::save();
		if(!$parentOnly && $save) {
			$this->load->model("FhData");
			$timestampField = $this->timestampField;
			$fh = new FhData();
			
			$fh->$timestampField = $this->db->query("select CURRENT_TIMESTAMP() as timestamp")->row()->timestamp;
			$save = $fh->save(true);
		}
		// returns true if usual save and timestamp save was successful
		return $save;
	}
}