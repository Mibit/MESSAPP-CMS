<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class InternationalePartner extends MA_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model("InternationalePartnerData");
		$this->load->model("LandData");
		 
		//my_path muss im AC_Controller immer gesetzt werden
		$this->my_path = 'internationalepartner';
	}

	public function index($phs = null) {
		
		$internationalePartner = new InternationalePartnerData();

		$variables["page_title"] = "Internationale Partnerhochschulen";
		
		if (!$phs){
			$variables["internationalepartner"] = $internationalePartner->loadMultipleFromDatabase();
		} else {
			$variables["internationalepartner"] = $phs;
		}
		
		// HTML Editor hinzufügen
		$this->setHtmlEditor(true);
		
		// Länder der Datenbank laden (Description Feld als Key)
		$land = new LandData();
		$variables["landArray"] = $land->getAllInArray(true, 1, 1);

		//AC Methode um Views anzuzeigen
		$this->loadView('internationalepartner', $variables);
	}

	public function save() {
		
		$validation = "validation";
		 
		 
		$phsArray = array();
		 
		try {
			
			for($i=0; array_key_exists("phsID$i", $_POST); $i++){
				$phsArray[] = new InternationalePartnerData( getFormFieldValue("phsID$i") );
				$this->form_validation->set_rules('phsLand'.$i, 'Land - Eintrag #'.($i+1), 'required|max_length[50]');
				$this->form_validation->set_rules('phsPartnerhochschulen'.$i, 'Partnerhochschulen - Eintrag #'.($i+1), 'required|max_length[50]');

				$phsArray[$i]->phsLand = getFormFieldValue("phsLand$i");
				$phsArray[$i]->phsPartnerhochschulen = getFormFieldValue("phsPartnerhochschulen$i");
			}
			
			$this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein.');
			$this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben.');
			
			$phsLandArray = array();
			foreach($phsArray as $key=>$phs) {
				if(!in_array($phs->phsLand, $phsLandArray)) {
					$phsLandArray[] = $phs->phsLand;
				} else {
					$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden, da das Land im ".($key+1).". Eintrag doppelt vorhanden ist.");
				}
			}
			if(count($phsArray) && !$this->form_validation->run() || count($this->getError())) {
				throw new Exception($validation);
			}
			
			$phsIDArray = array();
			foreach($phsArray as $phs) {
				if(!$phs->save()) {
					$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden.");
					throw new Exception($validation);
				}
				
				if($phs->phsID) {
					$phsIDArray[] = $phs->phsID;
				}
			}
			
			// delete Entries which are not in $phsIDArray --> deleted from user			
			$oldPhs = new InternationalePartnerData();
			$oldPhs->deleteMode();
			if(count($phsIDArray)) {
				$oldPhs = $oldPhs->loadMultipleFromDatabase("phsID not in (".implode(",",$phsIDArray).")");
			} else {
				$oldPhs = $oldPhs->loadMultipleFromDatabase();
			}
			foreach($oldPhs as $deletePhs) {
				$deletePhs->delete();
			}	
			
			$this->addSuccess("Die Eintr&auml;ge wurden erfolgreich gespeichert.");
			
		} catch(Exception $e) {
			if($e->getMessage()!=$validation) {
				$this->addError($e->getMessage());
			}
		}
		
		$this->index($phsArray);
	}
}
