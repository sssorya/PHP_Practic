<?php
  header("Content-type: text/html; charset=uts-8");?>
<meta http-equiv="Content-Type" content=text/html; charset=utf-8"/>
<?php require_once '/includes/temps/header.php';?>
<php foreach ($posts as $post) :?>
<h3> Сообщение №<?php echo $post['id'];?></h3>
<p><?php echo implode('', array_slice(explode('', 
    strip_tags($post['content'], 0, 10)); ?></p>
<a href="<?php echo $this->base->url."/?id=".$post['id']; ?>" class="btn-primary">Подробнее</a>
<hr/>
<?php endforeach; ?>
<?php require_once('include/temps/footer.php'); ?>
