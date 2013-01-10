<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Update extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model("UserData");
		$this->load->model("StudiengangData");
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
		
		$stg = new StudiengangData();
		$fields = array_merge(Array($stg->primary), $stg->dbfields);
		array_splice($fields, count($fields)-1); // last field will be removed --> freigabe
		
		$studiengaenge = array();		
		
		foreach($stg->getValidStudiengaenge($unixTimestamp) as $stg) {
			
			$studiengang = new stdClass();
			foreach($fields as $field) {
				if(strpos($field, "Image")!==false) {
					$studiengang->$field = base64_encode($stg->$field);
				} else {
					$studiengang->$field = str_replace("\"", "\u0022", $stg->$field);
				}
			}		
				
			$studiengaenge[] = $studiengang;
		}
		
		$entfernteStudiengaenge = array();
		foreach($stg->getInvalidStudiengaenge($unixTimestamp) as $stg) {
			$entfernteStudiengaenge[] = $stg->{$stg->primary};
		}
		
		$json = array(
						"timestamp" => $current_timestamp, 
						"studiengaenge" => $studiengaenge,
						"entfernte_studiengaenge" => $entfernteStudiengaenge
						 /*, fh_kufstein ...*/
		);
		
		print json_encode($json);
	}
	
	
}

