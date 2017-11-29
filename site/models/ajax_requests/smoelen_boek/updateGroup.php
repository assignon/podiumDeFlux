<?php

   require "../pdo_connection.php";


   $pdo = pdo();

   $groupName = htmlentities(htmlspecialchars($_GET['groupName']));
   $newGroupName = htmlentities(htmlspecialchars($_GET['newGroupName']));

   $checkGroupName = $pdo->prepare("SELECT group_name FROM  img_group_name WHERE group_name=?");
   $checkGroupName->execute(array($newGroupName));
   $countGrpoupName = $checkGroupName->rowCount();

   if($countGrpoupName == 0)
   {

      $updateGroupName = $pdo->prepare("UPDATE img_group_name SET group_name=? WHERE group_name=? ");
      $updateGroupName->execute(array($newGroupName, $groupName));

      $face_bookGroupName = $pdo->prepare("UPDATE face_book SET group_name=? WHERE group_name=? ");
      $face_bookGroupName->execute(array($newGroupName, $groupName));

      echo "Huidige smoelen groepsnaam met succes aangepast...";

   }else if($countGrpoupName > 0){

     echo "Deze groepsnaam bestaat al...";

   }

 ?>
