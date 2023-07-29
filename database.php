<?php
class Database {
  public $dbserver = '';
  public $username = '';
  public $password = '';
  public $db = '';
  public function __construct() {
    $this->dbserver = 'localhost';
    $this->username = 'Tbot';
    $this->password = 'NEiekq_oweQu';
    $this->db = new PDO("mysql:host=".$this->dbserver.");
  }
  public function dbselect($table, $select, $where=NULL) {
  
  }
  public function dbadd($tablename, $insert, $format){
  
  }

  public function dbupdate($tablename, $insert, $where) {
  
  }
}
