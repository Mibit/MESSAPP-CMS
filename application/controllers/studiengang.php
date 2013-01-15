<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
class Studiengang extends MA_Controller {

    public function __construct() {
       parent::__construct();
       
       $this->load->model("StudiengangData");
       
       //my_path muss im AC_Controller immer gesetzt werden
       $this->my_path = 'studiengang';
    }
    
    public function index() {
    	// 
        $stg = new StudiengangData();
        
        $variables["page_title"] = "Studieng&auml;nge";
        
        //Listenansicht setzen (Sortierung, Filterfunktion)
        $this->setList(true);
        $this->setListItems( $stg->loadMultipleFromDatabase() );
        
        //AC Methode um Views anzuzeigen
        $this->loadView('studiengang_list', $variables);
    }
    
    public function edit($stgID = null, $stg = null) {
        
    	if(!$stg) {
        	$stg = new StudiengangData($stgID);
    	}
        $variables["page_title"] = $stg;
        
        $variables["stg"] = $stg;
        
        // HTML Editor hinzufügen
        $this->setHtmlEditor(true);
       
        //Sidebar aktivieren
        $this->setIsSidebar(true);
        $this->setSidebar(null,$stg->loadMultipleFromDatabase("", "stgKBez", "asc"), $stg->stgID, "studiengang_sidebar");
       
        //Thickbox für Bilder aktivieren
        $this->setUseThickbox(true);

        $this->setStudiengangDetail($this->getMyUrl() . "edit");
        
        /*
        //Toolbar setzen
        $toolbar[] = array("name" => "save", "caption" => "Speichern", "url" => "javascript: submitbutton('save')");
        $toolbar[] = array("name" => "back", "caption" => "Zur�ck", "url" => $this->getMyUrl() . "index");
        $variables['toolbar'] = $toolbar;
        */
        
        //AC Methode um Views anzuzeigen
        $this->loadView("studiengang",$variables);
    }
    
    public function save() {
    	$validation = "validation";
    	$noInput = "noInput";
    	$noChange = "noChange";
    	
    	/* Deklarierung der Bildervariablen */
    	$stgStgLImage;
    	$stgStgAImage;
    	$stgStudent1Image;
    	$stgStudent2Image;
    	$stgHImage;
    	$stgCurriculumImage;
    	$stgFImage;
    	$stgBImage;
    	$stgKImage;
    	$stgGridViewImage;
    	/* */
    	
    	try {
	        $stg = new StudiengangData( getFormFieldValue("stgID") );
	
	        $this->form_validation->set_rules('stgKBez', 'Kurzbezeichnung des Studiengangs', 'required|max_length[5]');
	        $this->form_validation->set_rules('stgFOrganisationsform', 'Organisationsform', 'required|max_length[2]');
	        
	        $this->form_validation->set_rules('stgBez', 'Voller Studiengangsname', 'max_length[60]');
	        $this->form_validation->set_rules('stgArt', 'Studiengangsart', 'max_length[1]');
	        $this->form_validation->set_rules('stgStgL', 'Name der Studiengangsleitung', 'max_length[75]');
	        // stgStgLImage
	        $this->form_validation->set_rules('stgStgA', 'Name der Studiengangsassistenz', 'max_length[75]');
	        // stgStgAImage
	        $this->form_validation->set_rules('stgStudent1Quote', 'Zitat Student 1', 'max_length[500]');
	        $this->form_validation->set_rules('stgStudent2Quote', 'Zitat Student 2', 'max_length[500]');
	        $this->form_validation->set_rules('stgQuote', 'Zitat', 'max_length[500]');
	        $this->form_validation->set_rules('stgHighlights', 'Highlights', 'max_length[1000]');
	        $this->form_validation->set_rules('stgStgLInfo', 'Info zum Studiengangsleiter', 'max_length[150]');
	        $this->form_validation->set_rules('stgStgAInfo', 'Info zur Studiengangsassistenz', 'max_length[150]');
	        // stgHImage1
	        // stgHImage2
	        // stgCurriculumImage
	        $this->form_validation->set_rules('stgFStudienplaetze', 'Anzahl der Studienpl&auml;tze', 'max_length[3]');
	        $this->form_validation->set_rules('stgFBewerbungsmodus', 'Bewerbungsmodus', 'max_length[100]');
	        $this->form_validation->set_rules('stgFDauer', 'Dauer', 'max_length[15]');
	        $this->form_validation->set_rules('stgFAkadGrad', 'Akademischer Grad', 'max_length[45]');
	        $this->form_validation->set_rules('stgFUnterrichtssprache', 'Unterrichtssprache', 'max_length[75]');
	        $this->form_validation->set_rules('stgFBesonderheit', 'Besonderheit', 'max_length[150]');
	        $this->form_validation->set_rules('stgFAuslandsaufenthalt', 'Auslandsaufenthalt', 'max_length[150]');
	        $this->form_validation->set_rules('stgFKosten', 'Kosten', 'max_length[75]');
	        // stgFImage
	        $this->form_validation->set_rules('stgBFelder', 'Berufsfelder', 'max_length[750]');
	        // stgBImage1
	        // stgBImage2
	        $this->form_validation->set_rules('stgKBeschreibung', 'Kurzbeschreibung', 'max_length[1000]');
	        // stgKImage1
	        // stgKImage2
	        // stgImage
	        // freigabe
	        
	        $this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein!');
	        $this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben!');
	
	        $stg->stgKBez = getFormFieldValue("stgKBez");
	        $stg->stgBez = getFormFieldValue("stgBez");
	        $stg->stgArt = getFormFieldValue("stgArt");
	        $stg->stgStgL = getFormFieldValue("stgStgL");
	        $stg->stgQuote = getFormFieldValue("stgQuote");
	        $stg->stgStudent1Quote = getFormFieldValue("stgStudent1Quote");
	        $stg->stgStudent2Quote = getFormFieldValue("stgStudent2Quote");
	        $stg->stgHighlights = getFormFieldValue("stgHighlights");
	        $stg->stgStgLInfo = getFormFieldValue("stgStgLInfo");
	        $stg->stgStgAInfo = getFormFieldValue("stgStgAInfo");
	    
	        $stg->stgFOrganisationsform = getFormFieldValue("stgFOrganisationsform");
	        $stg->stgFStudienplaetze = getFormFieldValue("stgFStudienplaetze");
	        $stg->stgFBewerbungsmodus = getFormFieldValue("stgFBewerbungsmodus");
	        $stg->stgFDauer = getFormFieldValue("stgFDauer");
	        $stg->stgFAkadGrad = getFormFieldValue("stgFAkadGrad");
	        $stg->stgFUnterrichtssprache = getFormFieldValue("stgFUnterrichtssprache");
	        $stg->stgFBesonderheit = getFormFieldValue("stgFBesonderheit");
	        $stg->stgFAuslandsaufenthalt = getFormFieldValue("stgFAuslandsaufenthalt");
	        $stg->stgFKosten = getFormFieldValue("stgFKosten");
	        $stg->stgBFelder = getFormFieldValue("stgBFelder");
	        $stg->stgStgA = getFormFieldValue("stgStgA");
	    	$stg->stgKBeschreibung = getFormFieldValue("stgKBeschreibung");
	    	
	    	$stgStgLImage = getFormFieldImage("stgStgLImage");
	    	$stgStgAImage = getFormFieldImage("stgStgAImage");
	    	$stgStudent1Image = getFormFieldImage("stgStudent1Image");
	    	$stgStudent2Image = getFormFieldImage("stgStudent2Image");
	    	$stgHImage = getFormFieldImage("stgHImage");
	    	$stgCurriculumImage = getFormFieldImage("stgCurriculumImage");
	    	$stgFImage = getFormFieldImage("stgFImage");
	    	$stgBImage = getFormFieldImage("stgBImage");
	    	$stgKImage = getFormFieldImage("stgKImage");
	    	$stgGridViewImage = getFormFieldImage("stgGridViewImage");
	    	
	    	if($stg == new StudiengangData() && getFormFieldValue("target")) {
	    		throw new Exception($noInput);	
	    	}
	    	
	    	$changedStudiengang = clone $stg;
	    	$changedStudiengang->stgStgLImage = $stgStgLImage;
	    	$changedStudiengang->stgStgAImage = $stgStgAImage;
	    	$changedStudiengang->stgHImage = $stgHImage;
	    	$changedStudiengang->stgCurriculumImage = $stgCurriculumImage;
	    	$changedStudiengang->stgFImage = $stgFImage;
	    	$changedStudiengang->stgBImage = $stgBImage;
	    	$changedStudiengang->stgKImage = $stgKImage;
	    	$changedStudiengang->stgGridViewImage = $stgGridViewImage;
	        $changedStudiengang->freigabe = getFormFieldBoolean("freigabe");
	        
	        // if no changes, then do not save the Studiengang -> timestamp will not be changed
	        if($changedStudiengang == new StudiengangData($changedStudiengang->stgID)) {
	        	$this->addSuccess("Der Eintrag wurde erfolgreich gespeichert.");
	        	throw new Exception($noChange);
	        }
	        
	        if(!$this->checkDuplicate($stg->stgID, $stg->stgKBez, $stg->stgFOrganisationsform)) {
	        	throw new Exception("Dieser Studiengang existiert bereits in dieser Organisationsform.");
	        }
	        
	    	if(!$this->form_validation->run() || !$stg->save()) {
				throw new Exception($validation);
	    	}
	    	
	        if($stgStgLImage) {
	        	$stg->stgStgLImage = $stgStgLImage;
		    	if(!$stg->save("stgStgLImage")) {
					throw new Exception($validation);
		    	}
	        }
	    	
	        if($stgStgAImage) {
	        	$stg->stgStgAImage = $stgStgAImage;
		    	if(!$stg->save("stgStgAImage")) {
					throw new Exception($validation);
		    	}
	        }
	        
	        if($stgStudent1Image) {
	        	$stg->stgStudent1Image = $stgStudent1Image;
	        	if(!$stg->save("stgStudent1Image")) {
	        		throw new Exception($validation);
	        	}
	        }
	        
	        if($stgStudent2Image) {
	        	$stg->stgStudent2Image = $stgStudent2Image;
	        	if(!$stg->save("stgStudent2Image")) {
	        		throw new Exception($validation);
	        	}
	        }
	    	
	        if($stgHImage) {
	        	$stg->stgHImage = $stgHImage;
		    	if(!$stg->save("stgHImage")) {
					throw new Exception($validation);
		    	}
	        }
	    	
	        if($stgCurriculumImage) {
	        	$stg->stgCurriculumImage = $stgCurriculumImage;
		    	if(!$stg->save("stgCurriculumImage")) {
					throw new Exception($validation);
		    	}
	        }
	    	
	        if($stgFImage) {
	        	$stg->stgFImage = $stgFImage;
		    	if(!$stg->save("stgFImage")) {
					throw new Exception($validation);
		    	}
	        }
	    	
	        if($stgBImage) {
	        	$stg->stgBImage = $stgBImage;
		    	if(!$stg->save("stgBImage")) {
					throw new Exception($validation);
		    	}
	        }
	    	
	        if($stgKImage) {
	        	$stg->stgKImage = $stgKImage;
		    	if(!$stg->save("stgKImage")) {
					throw new Exception($validation);
		    	}
	        }
	    	
	        if($stgGridViewImage) {
	        	$stg->stgGridViewImage = $stgGridViewImage;
	        	if(!$stg->save("stgGridViewImage")) {
	        		throw new Exception($validation);
	        	}
	        }
	        
	        $stg->freigabe = getFormFieldBoolean("freigabe");
	        
	        if($stg->freigabe) {
	        	
	        	// Freigabe nur wenn alle Felder ausgefüllt sind 
	        	if(!$stg->checkFreigabe()) {
	        		$stg->freigabe = false;
	        		$this->addAlert("Der Studiengang kann nicht freigegeben werden, da nicht alle Felder ausgef&uuml;llt wurden.");
	        	}
	        }
	        
	        if($stg->save()) {
	            if($target = getFormFieldValue("target")) {
	            	redirect($target);
	            } else {
	                $this->addSuccess("Der Eintrag wurde erfolgreich gespeichert.");
	            }
	       	}else{
				$this->addError("Der Studiengang konnte nicht gespeichert werden.");
	       	}
	        
    	} catch(Exception $ex) {
    		if(($ex->getMessage()==$noInput || $ex->getMessage()==$noChange) && ($target = getFormFieldValue("target"))) {
    			redirect($target);
    		} elseif($ex->getMessage()!=$validation && $ex->getMessage()!=$noInput && $ex->getMessage()!=$noChange) {
    			$this->addError($ex->getMessage());
    		}
    	}
    	
    	
    	$stg->stgStgLImage = $stgStgLImage;
    	$stg->stgStgAImage = $stgStgAImage;
    	$stg->stgStudent1Image = $stgStudent1Image;
    	$stg->stgStudent2Image = $stgStudent2Image;
    	$stg->stgHImage = $stgHImage;
    	$stg->stgCurriculumImage = $stgCurriculumImage;
    	$stg->stgFImage = $stgFImage;
    	$stg->stgBImage = $stgBImage;
    	$stg->stgKImage = $stgKImage;
    	$stg->stgGridViewImage = $stgGridViewImage;
    	
        $this->edit(null,$stg);
    }
    
    private function checkDuplicate($id, $kBez, $organisationsform) {
    	
    	$stg = new StudiengangData();
    	$studiengaenge = $stg->getObjects(($id ? "stgID <> $id and " : "")." stgKBez = \"$kBez\" and stgFOrganisationsform = \"$organisationsform\"");
    	
    	if(count($studiengaenge)) {
    		return false;
    	}
    	
    	return true;
    }
    
    public function delete($stgID) {
        try {
            $stg = new StudiengangData($stgID);
            $stg->delete();
        } catch(Exception $e) {
        	$this->addError($e->getMessage());
        }
        $this->index();
    } 
    
    public function freigabe($stgID, $freigabe) {
    	try {
    		$stg = new StudiengangData($stgID);
    		if($freigabe) { 
    			// Freigabe nur wenn alle Felder ausgefüllt sind
    			if(!$stg->checkFreigabe()) {
    				throw new Exception("Der Studiengang kann nicht freigegeben werden, da nicht alle Felder ausgef&uuml;llt wurden.");
    			}
    		}
    		$stg->freigabe = $freigabe;
    		$stg->save();
    	} catch(Exception $e) {
    		$this->addError($e->getMessage());
    	}
    	$this->index();
    }
    
    

}