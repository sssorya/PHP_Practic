<?php
public function __construct() {
  parrent::__construct();
  $this->comments = new Comments();
  if (!empty($_GET['id'])) {
  $this->viewPost(($_GET['id']));
  } else {
    $this->getPosts();
  }
}
public function getPosts() {
  $id = 0;
  $posts = $return = $array();
  $template = '';
  $query = $thios->ksdb->db->prepare("SELECT * FROM posts");
  try {
    $query->execute();
    for ($i = 0; $row = $query->fetch(); $i++){
      $return[$i] = array();
      foreach ($row as $key => $rowItem) {
        $return[$i][$key] = $rowitem;
      }
    }
   } catch (PDOException $e) {
    echo $e->getMessage();
   }
  $posts = $return;
  $template = 'list-posts.php';
  include_once './templates/'.$template;
}

public function viewPosts ($postID) {
  $id = $postID;
  $posts = $return = $array();
  $template = '';
  $query = $thios->ksdb->db->prepare("SELECT * FROM posts WHERE id = ?");
  try {
    $query->execute(array($id));
    for ($i = 0; $row = $query->fetch(); $i++){
      $return[$i] = array();
      foreach ($row as $key => $rowItem) {
        $return[$i][$key] = $rowitem;
      }
    }
  $posts = $return;
  $posts[0]['content'] = $posts[0]['content'];
  $template = 'view-posts.php';
  include_once './templates/'.$template;
  }
}
?>
