<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $dateVal = htmlentities(htmlspecialchars($_GET['dateVal']));
   $evtName = htmlentities(htmlspecialchars($_GET['evtName']));
   $sUserPassVal = sha1($_GET['sUserPassVal']);

   $checkPass = $pdo->prepare("SELECT password FROM signin WHERE password=? AND grade=?");
   $checkPass->execute(array($sUserPassVal, "super-user"));
   $existPass = $checkPass->fetch();
   //$existPass = $checkPass->rowCount();


   $getCurrentEvtId = $pdo->prepare("SELECT id FROM events WHERE DATE_FORMAT(evt_date, '%d/%m/%Y')=? AND evt_name=?");
   $getCurrentEvtId->execute(array($dateVal, $evtName));

   $get_id = $getCurrentEvtId->fetch();

   if($existPass['password'] == $sUserPassVal)
   {

       $deleteEvt = $pdo->prepare("DELETE FROM events WHERE id=?");
       $deleteEvt->execute(array($get_id['id']));

       echo "Evenement met succes verwijderd...";

   }else{

       echo "Wachtwoord onjuist...";

   }

 ?>
