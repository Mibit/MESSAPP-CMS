<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MA_Model extends CI_Model {

	const DB_TYPE_STRING = 1;
	const DB_TYPE_NUMERIC = 2;
	const DB_TYPE_DATE = 3;
	const DB_TYPE_BOOLEAN = 4;
	
    protected $tablename;
    public $primary;
    public $dbfields;
    protected $types;

    public function __construct() {
        parent::__construct();
        
       	$this->load->database();
    }

    function setTableName($tablename) {
        $this->tablename = $tablename;
    }

    function setPrimary($primary) {
        $this->primary = $primary;
    }

    function addStringField($dbfield) {
        $this->dbfields[] = $dbfield;
        $this->types[] = self::DB_TYPE_STRING;
    }

    function addNumericField($dbfield) {
        $this->dbfields[] = $dbfield;
        $this->types[] = self::DB_TYPE_NUMERIC;
    }

    function addDateField($dbfield) {
        $this->dbfields[] = $dbfield;
        $this->types[] = self::DB_TYPE_DATE;
    }
    
    function addBooleanField($dbfield) {
        $this->dbfields[] = $dbfield;
        $this->types[] = self::DB_TYPE_BOOLEAN;
    }

    function loadFromDbObject(&$dbobject, $id) {
        for ($counter = 0; $counter < count($this->dbfields); $counter++) {
            $dbfield = $this->dbfields[$counter];
             
            if ($this->types[$counter] == self::DB_TYPE_DATE) {
            	$this->$dbfield = self::datetimeToTimestamp($dbobject->$dbfield);
         	} else {
              	$this->$dbfield = $dbobject->$dbfield;
         	}
        }
        $primary = $this->primary;
        $this->$primary = $id;
    }

    /*
     * loads attributes from database for given id
     */
    function load($id) {
        $sql = "SELECT " . implode(", ", $this->dbfields) . " FROM $this->tablename WHERE $this->primary=" . ((int)$id);
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            throw new Exception("Der ausgew&auml;hlte Eintrag mit der ID \"$id\" existiert nicht.");
        }
        $dbobject = $query->row();
        $this->loadFromDbObject($dbobject, $id);
    }

    function getObjectsBySQL($sql) {
        $getobjects = array();
        $objects = $this->db->query($sql);
        foreach ($objects->result() as $object) {
            $newObject = clone($this);
            $primary = $this->primary;
            $newObject->loadFromDbObject($object, $object->$primary);
            $getobjects[] = $newObject;
        }

        return $getobjects;
    }

    function getObjects($where = "", $order = null, $ordertype = "ASC", $limitFrom = null, $limitCount = null) {

        $sql = "SELECT " . $this->primary . ", " . implode(", ", $this->dbfields) . " FROM $this->tablename";
        if ($where != "") {
            $sql .= " WHERE $where";
        }
        if ($order != null) {
            $sql .= " ORDER BY $order $ordertype";
        }
        if ($limitFrom !== null) {
            $sql .= " LIMIT $limitFrom";
            if ($limitCount != NULL) {
                $sql .= ", $limitCount";
            }
        }
        
        return $this->getObjectsBySQL($sql);
    }

    function hasObjects($where = "", $tablename = null) {
        if(!$tablename)
            $tablename = $this->tablename;
        $sql = "SELECT * FROM $tablename";

        if ($where != "") {
            $sql .= " WHERE $where";
        }
        $sql .= " LIMIT 0,1";
        
        return (boolean)$this->db->query($sql)->result();
    }

    function __clone() {
    }

    function getValues() {
        $values = array();
        for ($counter = 0; $counter < count($this->dbfields); $counter++) {
            $dbField = $this->dbfields[$counter];
            switch($this->types[$counter]) {
                case self::DB_TYPE_STRING :
                    $values[] = "\"" . mysql_escape_string($this->$dbField) . "\"";
                    break;
                case self::DB_TYPE_NUMERIC :
                    if($this->$dbField === null) {
                        $values[] = "NULL";
                    } else
                    if (!isset($this->$dbField) || $this->$dbField == "") {
                        $values[] = 0;
                    } else {
                        $values[] = $this->$dbField;
                    }
                    break;
                case self::DB_TYPE_DATE :
                    $values[] = self::timestampToDatetime($this->$dbField);
                    break;
                case self::DB_TYPE_BOOLEAN :
                    if (!isset($this->$dbField) || $this->$dbField == "") {
                        $values[] = 0;
                    } else {
                        $values[] = $this->$dbField;
                    }
            }
        }
        return $values;
    }

    function getAsInsert() {
        $sql = "INSERT INTO $this->tablename (";
        $sql .= implode(", ", $this->dbfields);

        $values = $this->getValues();
        $sql .= ") VALUES (";
        $sql .= implode(", ", $values) . ")";
        return $sql;
    }

    function getAsUpdate() {
        $sql = "UPDATE $this->tablename SET ";
        $values = $this->getValues();
        $cvalues = array();
        for ($i = 0; $i < count($this->dbfields); $i++) {
            $cvalues[] = $this->dbfields[$i] . "=" . $values[$i];
        }
        $sql .= implode(", ", $cvalues);

        $primary = $this->primary;
        $sql .= " WHERE " . $this->primary . " = " . ((int)$this->$primary);
       
        return $sql;
    }

    function save() {
        $primary = $this->primary;
        $sql = "";

        if (!isset($this->$primary) || $this->$primary == "") {
            $sql = $this->getAsInsert();
            $status = $this->db->query($sql);
            $this->$primary = $this->db->insert_id();
            return $status;
        } else {
            $sql = $this->getAsUpdate();
            return $this->db->query($sql);
        }
    }

    function delete() {
        $primary = $this->primary;
        if (!isset($this->$primary)) {
            die("Das Objekt kann nicht gel&ouml;scht werden, da das Objekt noch nicht geladen ist");
        }
        $sql = "DELETE FROM $this->tablename WHERE $this->primary = " . ((int)$this->$primary) . ";";
        $this->db->query($sql);
    }

    public static function timestampToDatetime($timestamp) {
        return date("Y-m-d H:i:s", $timestamp);
    }

    public static function datetimeToTimestamp($datetime) {
    	return date_timestamp_get( new DateTime($datetime) );
    }

    function getDbFields() {
        array_push($this->dbfields, $this->primary);
        return $this->dbfields;
    }
    
    public function loadFromDatabase($identifier) {
        if($identifier) {
            $this->load($identifier);
        }
        $this->fillObject($this);
    }

    public function loadMultipleFromDatabase($SQLWhere = null,$order = null, $ordertype = "ASC", $limitFrom = NULL, $limitCount = NULL) {
        $objects = $this->getObjects($SQLWhere,$order,$ordertype,$limitFrom,$limitCount);
        
        if(count($objects)) {
            foreach ($objects as $object) {
                $this->fillObject($object);
            }
        } else {
            $objects = Array();
        }
        return $objects;

    }

    protected function fillObject($object) { }

    public function getAllInArray($blankValue = true, $idFieldPosition = -1, $descriptionFieldPosition = 0, $alternativeDescriptionMethod = null) {
        $objectArray = Array();
        
        if($blankValue)
            $objectArray[""] = "";
        
        if (count($this->dbfields) >= $idFieldPosition + 1 && count($this->dbfields) >= $descriptionFieldPosition + 1) {

            if ($idFieldPosition < 0) {
                $getIdentifier = $this->primary;
            } else {
                $getIdentifier = $this->dbfields[$idFieldPosition];
            }
            
            if($alternativeDescriptionMethod) {
	            foreach ($this->loadMultipleOfThisFromDatabase($filter) as $object) {
	                $objectArray[$object->$getIdentifier] = $object->$alternativeDescriptionMethod();
	            }
            } else {
                $descriptionField = $this->dbfields[$descriptionFieldPosition];
            	foreach ($this->loadMultipleOfThisFromDatabase($filter) as $object) {
	                $objectArray[$object->$getIdentifier] = $object->$descriptionField;
	            }
            }
            
        }
        return $objectArray;

    }
 
}
