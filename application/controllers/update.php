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
	
		$studiengaenge = array();
		foreach($stg->getValidStudiengaenge($unixTimestamp) as $stg) {
			$studiengang = new stdClass();
			$studiengang->stgID = $stg->stgID;
			$studiengang->stgName = $stg->stgName;
			$studiengang->stgArt = $stg->stgArt;
			$studiengang->highlights = $stg->highlights;
			$studiengang->titelbild = base64_encode($stg->titelbild);
			
			$studiengaenge[] = $studiengang;
		}
		
		$entfernteStudiengaenge = array();
		foreach($stg->getInvalidStudiengaenge($unixTimestamp) as $stg) {
			$entfernteStudiengaenge[] = $stg->stgID;
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

