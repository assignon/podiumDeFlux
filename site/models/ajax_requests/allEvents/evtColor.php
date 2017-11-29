<?php

require "../pdo_connection.php";

$pdo = pdo();
$dates = htmlentities(htmlspecialchars($_GET['dates']));

$selectEventsColor = $pdo->prepare("SELECT evt_color FROM events WHERE evt_date=?");
$selectEventsColor->execute(array($dates));

$getEvtColor = $selectEventsColor->fetch();
echo $getEvtColor['evt_color'];


 ?>
