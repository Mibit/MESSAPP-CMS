<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
class Anrede extends MA_Controller {

    public function __construct() {
       parent::__construct();
       
       $this->load->model("AnredeData");
       
       //my_path muss im AC_Controller immer gesetzt werden
       $this->my_path = 'anrede';
    }
    
    public function index() {
    	
        $anrede = new AnredeData();
        
        $variables["page_title"] = "Anreden";
        
        //Listenansicht setzen (Sortierung, Filterfunktion)
        $this->setList(true);
        $this->setListItems( $anrede->loadMultipleFromDatabase() );

        //Toolbar setzen
        $toolbar[] = array("name" => "new", "caption" => "Neu", "url" => $this->getMyUrl() . "edit");
        $variables['toolbar'] = $toolbar;
        
        //AC Methode um Views anzuzeigen
        $this->loadView('anrede_list', $variables);
    }
    
    public function edit($anredeID = null, $anrede = null, $error = null, $info = null) {
        
        $anrede = new AnredeData($anredeID);
        
        $variables["page_title"] = $anrede;
        
        $variables["anrede"] = $anrede;
        
        //Toolbar setzen
        $toolbar[] = array("name" => "save", "caption" => "Speichern", "url" => "javascript: submitbutton('save')");
        $toolbar[] = array("name" => "back", "caption" => "Zurück", "url" => $this->getMyUrl() . "index");
        $variables['toolbar'] = $toolbar;
            
        //AC Methode um Views anzuzeigen
        $this->loadView("anrede_edit",$variables);
    }
    
    public function save() {
        $anrede = new AnredeData( getFormFieldValue("anredeID") );

        $this->form_validation->set_rules('anrede', 'Anrede', 'required|max_length[50]');
        
        $this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein!');
        $this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben!');

        $anrede->anrede = getFormFieldValue("anrede");

        if($this->form_validation->run()) {
            if($anrede->save()) {
                $this->addSuccess("Der Eintrag wurde erfolgreich gespeichert.");
            }else{
                $this->addError("Diese Anrede existiert bereits.");
            }
        }

        $this->edit(null,$anrede);
    }
    
    public function delete($anredeID) {
        try {
            $anrede = new AnredeData($anredeID);
            $anrede->delete();
        } catch(Exception $e) {
        	$this->addError($e->getMessage());
        }
        $this->index();
    } 

}