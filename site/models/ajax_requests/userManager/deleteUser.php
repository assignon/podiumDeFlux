<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $currentUsername = htmlentities(htmlspecialchars($_GET['currentUsername']));
   $SUpassVal = sha1($_GET['SUpassVal']);

   $checkPass = $pdo->prepARE("SELECT password FROM signin WHERE password=?");
   $checkPass->execute(array($SUpassVal));
   $getPass = $checkPass->fetch();

   if($SUpassVal == $getPass['password'])
   {

      $username = $pdo->prepare("SELECT username FROM signin WHERE username=?");
      $username->execute(array($currentUsername));
      $getUsername = $username->fetch();

      $deleteCurrentUser = $pdo->prepare("DELETE FROM signin WHERE username=?");
      $deleteCurrentUser->execute(array($getUsername['username']));

      echo "Gebruiker met succes verwijderd";

   }else{

       echo "Wachtwoord onjuist...";

   }
 ?>
