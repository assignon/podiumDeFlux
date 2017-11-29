<?php

    require "../pdo_connection.php";
    $pdo = pdo();

    $month_name = ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];

    $evtDate = htmlentities(htmlspecialchars($_GET['evtDate']));
    $year = substr($evtDate, 0,4);
    $month1 = substr($evtDate, 5,6);
    $month2 = substr($month1, 1,1);
    $month = $month_name[$month2];
    $evtName = htmlentities(htmlspecialchars($_GET['evtName']));
    $evtBtime = htmlentities(htmlspecialchars($_GET['evtBtime']));
    $evtEtime = htmlentities(htmlspecialchars($_GET['evtEtime']));
    $evtInfo = htmlentities(htmlspecialchars($_GET['evtInfo']));
    $evtColor = htmlentities(htmlspecialchars($_GET['evtColor']));

    if(!empty($evtName) AND !empty($evtBtime) AND !empty($evtEtime))
    {

      $insertEvt = $pdo->prepare("INSERT INTO events(evt_date, evt_name, begin_time, end_time, evt_description, evt_color, year, month) VALUES(?,?,?,?,?,?,?,?)");
      $insertEvt->execute(array($evtDate, $evtName, $evtBtime, $evtEtime, $evtInfo, $evtColor, $year, $month));

      echo "De evenement is met succes toegevoegd.";


    }else{

      echo "Velden met een steretje erachter zijn verplicht...";

    }




 ?>
