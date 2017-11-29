<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $reactionTextVal = htmlentities(htmlspecialchars($_GET['reactionTextVal']));
   $article_id = intval($_GET['article_id']);
   $user_id = intval($_GET['user_id']);

   $getUsername = $pdo->prepare("SELECT username, avatar FROM signin WHERE id=?");
   $getUsername->execute(array($user_id));
   $displayUsername = $getUsername->fetch();

   $insertComment = $pdo->prepare("INSERT INTO blog_comments(username, avatar, comments, comment_date, blog_id) VALUES(?,?,?,NOW(),?)");
   $insertComment->execute(array($displayUsername['username'], $displayUsername['avatar'], $reactionTextVal, $article_id));

   echo "Reactie toegevoegd...";

 ?>
