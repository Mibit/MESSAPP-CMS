<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Update extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model("UserData");
	}
	
	/*
	 * current URL
	 * http://localhost/MessApp/index.php/update/getChangedData/1/update/3ac340832f29c11538fbe2d6f75e8bcc
	 */
	public function getChangedData($unixTimestamp, $username, $password) {
		
		UserData::checkAuthentification($username, $password, false);
		
		$studiengaenge = array();
		
		$studiengaenge[0] = new stdClass();
		$studiengaenge[0]->stgID = 1;
		$studiengaenge[0]->stgName = "Web Business & Technology VZ";
		$studiengaenge[0]->stgArt = "B";
		$studiengaenge[0]->highlights = "sample Highlights";
		$studiengaenge[0]->titelbild = $this->getImageCoded("testdata/test.jpg");
		
		$studiengaenge[1] = new stdClass();
		$studiengaenge[1]->stgID = 1;
		$studiengaenge[1]->stgName = "Facility Management & Immobilienwirtschaft VZ";
		$studiengaenge[1]->stgArt = "B";
		$studiengaenge[1]->highlights = "sample Highlights";
		$studiengaenge[1]->titelbild = $this->getImageCoded("testdata/test2.jpg");
		
		$json = array("studiengaenge" => $studiengaenge /*, fh_kufstein ...*/);
		
		print json_encode($json);
	}
	
	private function getImageCoded($path) {
		$tmpName = ($path);
		$fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);
        
        return base64_encode($data);
	}
}

