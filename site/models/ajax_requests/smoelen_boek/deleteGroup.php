<?php

  require "../pdo_connection.php";


  $pdo = pdo();

  $SUpass = sha1($_GET['sUserPassword']);
  $groupName = htmlentities(htmlspecialchars($_GET['groupName']));

  $checkPass  =$pdo->prepare("SELECT password FROM signin WHERE password=?");
  $checkPass->execute(array($SUpass));
  $getSUpass = $checkPass->fetch();


  if($SUpass == $getSUpass['password'])
  {

     $deleteCurrentGroup = $pdo->prepare("DELETE FROM img_group_name WHERE group_name=?");
     $deleteCurrentGroup->execute(array($groupName));

     $deleteCurrentFaceGroup = $pdo->prepare("DELETE FROM face_book WHERE group_name=?");
     $deleteCurrentFaceGroup->execute(array($groupName));

     echo "Huidige groep met succes verwijderd...";

  }else{

     echo "Wachtwoord onjuist...";

  }

 ?>
