<?php 
class AdminPanel {
  public function __construct{
    $this->ksdb = new Database;
    $this->base = (object) '';
    $this->base->url = "http://".$_SERVER['SERVER_NAME'];
  }
}
?>
