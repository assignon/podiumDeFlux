<?php

  require "../pdo_connection.php";

  $pdo = pdo();
  $article_id = intval($_GET['article_id']);

  $selectComment_id = $pdo->prepare("SELECT id FROM blog_comments WHERE blog_id=?");
  $selectComment_id->execute(array($article_id));
  $count_id = $selectComment_id->rowCount();

  if($count_id > 1)
  {

      echo $count_id.' '."Reacties";

  }else{

     echo $count_id.' '."Reactie";

  }

 ?>
