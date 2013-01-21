<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Fh extends MA_Controller {

	public function __construct() {
		parent::__construct();
		 
		$this->load->model("FhData");
		 
		//my_path muss im AC_Controller immer gesetzt werden
		$this->my_path = 'fh';
	}

	public function index($fh = null) {
		
		// Daten werden sofort bei Instanzierung geladen, da nur ein Eintrag besteht
		$fhdata = new FhData();

		$variables["page_title"] = "Stammdaten";

		if (!$fh){
			$variables["fh"] = $fhdata;
		} else {
			$variables["fh"] = $fh;
		}
		
        //Thickbox für Bilder aktivieren
        $this->setUseThickbox(true);

		//AC Methode um Views anzuzeigen
		$this->loadView('fh', $variables);
	}

	public function save() {
		
		$validation = "validation";
		
		$fh = new FhData();
		
		try {	
			
			$fh->fhLogo = getFormFieldImage("fhLogo");
			
			if(!$fh->fhLogo) {
				$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden, da das Bild \"FH Logo\" fehlt.");
			}
			
			if(count($this->getError())) {
				throw new Exception($validation);
			}
			
			if(!$fh->save()) {
				$this->addError("Der Eintrag konnte nicht gespeichert werden.");
				throw new Exception($validation);
			}
			
			$this->addSuccess("Der Eintrag wurden erfolgreich gespeichert.");
			
		} catch(Exception $e) {
			if($e->getMessage()!=$validation) {
				$this->addError($e->getMessage());
			}
		}
		 
		$this->index($fh);
	}
}
