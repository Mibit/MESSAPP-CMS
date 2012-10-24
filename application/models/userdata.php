<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserData extends MA_Model {
	
	// SQL Fields
	public $userID;
	public $username;
	public $password;
	
	public function __construct($userID = null) {
		parent::__construct();
		
		$this->setTableName("User");
		
		$this->setPrimary("userID");
		$this->addStringField("username");
		$this->addStringField("password");
        
        $this->loadFromDatabase($userID);
	}
    
    public function __toString() {
        if($this->username) {
            return "User ".$this->username;
        } else {
            return "neuer User";
        }
    }
    
}