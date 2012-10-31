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

        //Toolbar setzen
        $toolbar[] = array("name" => "new", "caption" => "Neu", "url" => $this->getMyUrl() . "edit");
        $variables['toolbar'] = $toolbar;
        
        //AC Methode um Views anzuzeigen
        $this->loadView('studiengang', $variables);
    }
    
    public function edit($stgID = null, $stg = null) {
        
        $stg = new StudiengangData($stgID);
        
        $variables["page_title"] = $stg;
        
        $variables["stg"] = $stg;
        
        //Toolbar setzen
        $toolbar[] = array("name" => "save", "caption" => "Speichern", "url" => "javascript: submitbutton('save')");
        $toolbar[] = array("name" => "back", "caption" => "Zurück", "url" => $this->getMyUrl() . "index");
        $variables['toolbar'] = $toolbar;
            
        //AC Methode um Views anzuzeigen
        $this->loadView("studiengang",$variables);
    }
    
    public function save() {
        $stg = new StudiengangData( getFormFieldValue("stgID") );

        $this->form_validation->set_rules('stgName', 'Studiengangsname', 'required|max_length[30]');
        $this->form_validation->set_rules('stgArt', 'Studiengangsart', 'required|max_length[1]');
        $this->form_validation->set_rules('highlights', 'Highlights', 'max_length[300]');
        
        $this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein!');
        $this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben!');

        $stg->stgName = getFormFieldValue("stgName");
        $stg->stgArt = getFormFieldValue("stgArt");
        $stg->highlights = getFormFieldValue("highlights");
        $stg->titelbild = getFormFieldImage("titelbild");
        $stg->freigabe = getFormFieldValue("freigabe");

        if($this->form_validation->run()) {
            if($stg->save()) {
                $this->addSuccess("Der Eintrag wurde erfolgreich gespeichert.");
            }else{
                $this->addError("Diese Anrede existiert bereits.");
            }
        }
        
        $this->edit(null,$stg);
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

}