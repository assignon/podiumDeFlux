<?php

    function pdo()
    {

       $pdo = new PDO("mysql:host=localhost;dbname=podiumdeflux",'root','');//localhost
      // $pdo = new PDO("mysql:host=localhost;dbname=deb33439n4_vrijwilligers",'deb33439n4_vrijwilligers','podiumwilligers');//podium.nl
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $pdo;

    }

 ?>
