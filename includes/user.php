<?php

require_once 'database.php';

class User {
    
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    
    protected $db;
    
    public function __construct(MySqlDatabase $db) {
        $this->db = $db;
    }
    
    public function find_all() {        
        return $this->find_by_sql("SELECT * FROM users");
    }
    
    public function find_by_id($id=0) {
        $result = $this->find_by_sql("SELECT * FROM users WHERE id={$id} ");
        return !empty($result) ? array_shift($result) : false;
    }
    
    public function find_by_sql($sql=""){
        $result = $this->db->query($sql);
        $object_array = array();
        while($row = $this->db->fetch_array($result)) {
            $object_array[] = $this->instantiate($row);
        }
        return $object_array;
    }
    
    public function get_full_name(){
        return $this->first_name." ".$this->last_name;
    }
    
    private function instantiate($record) {
        $object = new self($this->db);
        
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    
    private function has_attribute($attribute){
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute,$object_vars);
    }
    
}

?>