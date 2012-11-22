<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserData extends MA_Model {
	
	// SQL Fields
	public $userID;
	public $username;
	public $password;
	public $onlyUpdate = true;
	
	private $users = array();
	
	public function __construct($userID = null) {
		parent::__construct();
		
		$this->loadFromDatabase($userID);
	}
	
	private function checkUsers() {
		if(!count($this->users)) {
			$adminUser = new UserData();
			$adminUser->userID = 1;
			$adminUser->username = "sa";
			$adminUser->password = md5("1.admin");
			$adminUser->onlyUpdate = false;
			
			$updateUser = new UserData();
			$updateUser->userID = 2;
			$updateUser->username = "update";
			$updateUser->password = md5("update");
			
			$this->users[] = $adminUser;
			$this->users[] = $updateUser;
		}
	}
	public function load($userID) {
		$this->checkUsers();
		foreach($this->users as $user) {
			if($user->userID == $userID) {
				return $user;
			}
		}
	}
	
	public function getObjects() {
		$this->checkUsers();
		return $this->users;
	}
	
	public function loadUserByUsername($username) {
		$this->checkUsers();
		foreach($this->users as $user) {
			if($user->username == $username) {
				return $user;
			}
		}
	}
	
    public static function checkAuthentification($username, $password, $hashPassword = true) {
    	
    	get_instance()->load->model("UserData");
    	
    	$user = new UserData();
        $thisUser = $user->loadUserByUsername($username);
    
        if (!$thisUser || $hashPassword && $thisUser->onlyUpdate) {
            throw new Exception('Die Anmeldung war nicht erfolgreich. Geben Sie g&uuml;ltige Daten ein.');
        }
        
        //Check against password
        if($hashPassword) {
        	$password = md5($password);
        }
        if($password != $thisUser->password) {
            throw new Exception('Die Anmeldung war nicht erfolgreich. Geben Sie g&uuml;ltige Daten ein.');
        }
        
        return $thisUser;
    }
    
    public function __toString() {
        if($this->username) {
            return "User ".$this->username;
        } else {
            return "neuer User";
        }
    }
    
}