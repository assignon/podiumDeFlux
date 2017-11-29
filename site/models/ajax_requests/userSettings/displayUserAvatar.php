<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $userId = intval($_GET['userId']);

   $selectAvatar = $pdo->prepare("SELECT avatar FROM signin WHERE id=?");
   $selectAvatar->execute(array($userId));
   $displayAvatar = $selectAvatar->fetch();

   echo "../vrijwilliger/public/media/users_avatar/".$displayAvatar['avatar'];


 ?>
