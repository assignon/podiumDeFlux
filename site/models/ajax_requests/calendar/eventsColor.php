<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $evtDate = htmlentities(htmlspecialchars($_GET['evtDate']));

    $selectColor = $pdo->prepare("SELECT * FROM events WHERE evt_date=?");
    $selectColor->execute(array($evtDate));
    $evtCount = $selectColor->rowCount();
    $getColor = $selectColor->fetch();


       echo $getColor['evt_color'];


  /*  if($evtCount > 1)
    {

       echo "-webkit-linear-gradient(to bottom, ".$getColor['evt_color'].");";
       echo "linear-gradient(to bottom, ".$getColor['evt_color'].");";

    }else if($evtCount == 1){

        echo $getColor['evt_color'];

    }*/


 ?>
