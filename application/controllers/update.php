<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Update extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model("UserData");
		$this->load->model("StudiengangData");
		$this->load->model("ScreensaverData");
		$this->load->model("LebenInKufsteinData");
		$this->load->model("InternationalePartnerData");
		$this->load->model("FhData");
	}
	
	/*
	 * current URL
	 * local: http://localhost/MessApp/index.php/update/getChangedData/1/update/3ac340832f29c11538fbe2d6f75e8bcc
	 * server: http://www.wi.fh-kufstein.ac.at:60880/messapp/index.php/update/getChangedData/1/update/3ac340832f29c11538fbe2d6f75e8bcc
	 * Updatefunktion (JSON String) für Synchronisation mit App
	 */
	public function getChangedData($unixTimestamp, $username, $password) {
		
		UserData::checkAuthentification($username, $password, false);
		
		$current_timestamp = $this->db->query("select UNIX_TIMESTAMP() as timestamp")->row()->timestamp;
		
		/*
		 * Studiengänge
		 */
		$stg = new StudiengangData();
		$fields = array_merge(Array($stg->primary), $stg->dbfields);
		
		$studiengaenge = $this->formatDataForJSON($stg->getValidStudiengaenge($unixTimestamp), $fields);		
		
		
		$entfernteStudiengaenge = array();
		foreach($stg->getInvalidStudiengaenge($unixTimestamp) as $stg) {
			$entfernteStudiengaenge[] = $stg->{$stg->primary};
		}
		
		/*
		 * Static Data
		 */
		$fh = new FhData();
		$screensaver = array();
		$lebeninkufstein = array();
		$internationalepartner = array();
		if($this->staticDataChanged($unixTimestamp, $fh->scrTimestamp)) {
			$scr = new ScreensaverData();
			$fields = array_merge(Array($scr->primary), $scr->dbfields);
			$screensaver = $this->formatDataForJSON($scr->loadMultipleFromDatabase(), $fields);
		} 
		if($this->staticDataChanged($unixTimestamp, $fh->likTimestamp)) {
			$lik = new LebenInKufsteinData();
			$fields = array_merge(Array($lik->primary), $lik->dbfields);
			$lebeninkufstein = $this->formatDataForJSON($lik->loadMultipleFromDatabase(), $fields);
		}
		if($this->staticDataChanged($unixTimestamp, $fh->phsTimestamp)) {
			$phs = new InternationalePartnerData();
			$fields = array_merge(Array($phs->primary), $phs->dbfields);
			$internationalepartner = $this->formatDataForJSON($phs->loadMultipleFromDatabase(), $fields);
		}
		$stammdaten = new stdClass();
		if($this->staticDataChanged($unixTimestamp, $fh->fhTimestamp)) {
			$stammdaten->fhLogo = base64_encode($fh->fhLogo);
		}
		
		/*
		 * collect Data for JSON
		 */
		$json = array(
						"timestamp" => $current_timestamp, 
						"studiengaenge" => $studiengaenge,
						"entfernte_studiengaenge" => $entfernteStudiengaenge,
						"screensaver" => $screensaver,
						"leben_in_kufstein" => $lebeninkufstein,
						"internationale_partnerhochschulen" => $internationalepartner,
						"fh" => $stammdaten
		);
		
		print json_encode($json);
	}
	
	private function formatDataForJSON($objects, $fields) {
		
		$objectArray = array();
		foreach($objects as $object) {
				
			$stdObject = new stdClass();
			foreach($fields as $field) {
				if(strpos($field, "Image")!==false) {
					$stdObject->$field = base64_encode($object->$field);
				} else {
					$stdObject->$field = str_replace("\"", "\u0022", $object->$field);
				}
			}
		
			$objectArray[] = $stdObject;
		}
		
		return $objectArray;
	}
	
	private function staticDataChanged($appTimestamp, $lastTimestamp) {
		return $this->db->query("select case when \"$lastTimestamp\" > FROM_UNIXTIME($appTimestamp) then 1 else 0 end as changed")->row()->changed;
	}
	
	
}

