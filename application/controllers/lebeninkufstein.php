<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class LebenInKufstein extends MA_Controller {

	public function __construct() {
		parent::__construct();
		 
		$this->load->model("LebenInKufsteinData");
		 
		//my_path muss im AC_Controller immer gesetzt werden
		$this->my_path = 'lebeninkufstein';
	}

	public function index($lik = null) {
		
		$lebenInKufstein = new LebenInKufsteinData();

		$variables["page_title"] = "Leben in Kufstein";

		if (!$lik){
			$variables["lebeninkufstein"] = $lebenInKufstein->loadMultipleFromDatabase();
		} else {
			$variables["lebeninkufstein"] = $lik;
		}
		
		//Thickbox für Bilder aktivieren
		$this->setUseThickbox(true);
		
		//AC Methode um Views anzuzeigen
		$this->loadView('lebeninkufstein', $variables);
	}

	public function save() {
		
		$validation = "validation";
		 
		 
		$likArray = array();
		 
		try {
			
			for($i=0; array_key_exists("likID$i", $_POST); $i++){
				$likArray[] = new LebenInKufsteinData( getFormFieldValue("likID$i") );
				$this->form_validation->set_rules('likTitel'.$i, 'Titel - Eintrag #'.($i+1), 'required|max_length[50]');
				$this->form_validation->set_rules('likText'.$i, 'Text - Eintrag #'.($i+1), 'required|max_length[50]');

				$likArray[$i]->likTitel = getFormFieldValue("likTitel$i");
				$likArray[$i]->likText = getFormFieldValue("likText$i");

				$likArray[$i]->likImage = getFormFieldImage("likImage$i");
			}
			
			$this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein.');
			$this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben.');
			
			foreach($likArray as $key=>$lik) {
				if(!$lik->likImage) {
					$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden, da das Bild im ".($key+1).". Eintrag fehlt.");
				}
			}
			if(count($likArray) && !$this->form_validation->run() || count($this->getError())) {
				throw new Exception($validation);
			}
			
			$likIDArray = array();
			foreach($likArray as $lik) {
				if(!$lik->save()) {
					$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden.");
					throw new Exception($validation);
				}
				
				if($lik->likID) {
					$likIDArray[] = $lik->likID;
				}
			}
			
			// delete Entries which are not in $likIDArray --> deleted from user			
			$oldLik = new LebenInKufsteinData();
			$oldLik->deleteMode();
			if(count($likIDArray)) {
				$oldLik = $oldLik->loadMultipleFromDatabase("likID not in (".implode(",",$likIDArray).")");
			} else {
				$oldLik = $oldLik->loadMultipleFromDatabase();
			}
			foreach($oldLik as $deleteLik) {
				$deleteLik->delete();
			}	
			
			$this->addSuccess("Die Eintr&auml;ge wurden erfolgreich gespeichert.");
			
		} catch(Exception $e) {
			if($e->getMessage()!=$validation) {
				$this->addError($e->getMessage());
			}
		}
		 
		$this->index($likArray);
	}
}
