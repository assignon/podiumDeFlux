<?php

   require "../pdo_connection.php";
   $pdo = pdo();

   $dateVal = htmlentities(htmlspecialchars($_GET['dateVal']));
   $evtName = htmlentities(htmlspecialchars($_GET['nameVal']));
   $evtCloneName = htmlentities(htmlspecialchars($_GET['evtCloneName']));
   $timeBval = htmlentities(htmlspecialchars($_GET['timeBval']));
   $timeEval = htmlentities(htmlspecialchars($_GET['timeEval']));
   $descVal = htmlentities(htmlspecialchars($_GET['descVal']));
   $colorVal = htmlentities(htmlspecialchars($_GET['colorVal']));

   $getEvtId = $pdo->prepare("SELECT id FROM events WHERE evt_name=?");
   $getEvtId->execute(array($evtCloneName));

   $getContent = $getEvtId->fetch();

   /*if($evtName != $getContent['evt_name'] AND $timeBval != $getContent['begin_time'] AND $timeEval != $getContent['end_time'] AND $descVal != $getContent['descVal'])
   {*/

      if($evtName != "" AND $timeBval != "" AND $timeEval != "" AND $descVal != "")
      {

         if($colorVal != "Kies een kleur")
         {

             $updateEvt = $pdo->prepare("UPDATE events SET evt_name=?, begin_time=?, end_time=?, evt_description=?, evt_color=? WHERE id=?");
             $updateEvt->execute(array($evtName, $timeBval, $timeEval, $descVal, $colorVal, $getContent['id']));

             echo "Evenement met succes aangepast...";

         }else if($colorVal == "Kies een kleur"){

             $updateEvt = $pdo->prepare("UPDATE events SET evt_name=?, begin_time=?, end_time=?, evt_description=? WHERE id=?");
             $updateEvt->execute(array($evtName, $timeBval, $timeEval, $descVal, $getContent['id']));

             echo "Evenement met succes aangepast...";

         }

      }else{

         echo "Een of meerder velden zijn leeg";

      }

  /* }else{

       echo "Geen van de gegevens is aangepast...";

   }*/

 ?>
