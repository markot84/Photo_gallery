<?php

require_once 'configuration.php';

class MySqlDatabase {
    
    private $connection;
    
    function __construct() {                                                        # __construct constructor
        $this->open_connection();
    }
    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if(mysqli_connect_errno()){
            die('Database connection failed: ' .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
            );
        }
    }
    
    public function close_connection(){
        if(isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    
    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }
    
    private function confirm_query($result) {
        if (!$result) {
            die('Database query failed!');
        }
    }
    
    public function mysql_prep($string) {                                           # prepares string as a query        
        $escaped_string = mysqli_real_escape_string($this->connection,$string);     # mysqli_real_escape_string -> Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
        return $escaped_string;
    }
    
    public function fetch_array($result) {
        return mysqli_fetch_array($result);
    }
    
    public function num_rows($result) {
        return mysqli_num_rows($result);
    }
    
    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }
    
    public function affected_rows() {
        return mysqli_affected_rows($this->connection);
    }
    
}

$db = new MySqlDatabase();