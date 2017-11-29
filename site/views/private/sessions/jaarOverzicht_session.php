<?php
 session_start();

   require "../vrijwilliger/site/models/jaarOverzicht_model.php";

   $jaarOverzicht = new jaarOverzicht();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $jaarOverzicht->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/jaarOverzicht.php";
            $jaarOverzicht->hide_sidebar();
            $jaarOverzicht->show_sidebar_controller();
            $jaarOverzicht->show_sidebar();
            $jaarOverzicht->close_sidebar();
            $jaarOverzicht->tabs();
            $jaarOverzicht->agendas();
            $jaarOverzicht->display_agendas();
            $jaarOverzicht->getEvtInfo();
            $jaarOverzicht->avatar();
            //$jaarOverzicht->getAllEvents();

          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/jaarOverzicht.php";
            $jaarOverzicht->hide_sidebar_controller();
            $jaarOverzicht->tabs();
            $jaarOverzicht->agendas();
            $jaarOverzicht->display_agendas();
            $jaarOverzicht->getEvtInfo();
            $jaarOverzicht->avatar();
          //  $jaarOverzicht->getAllEvents();

          }


      }else{

        header("Location: index.php?page=login");
      }

   }else{

       echo "Deze id bestaat niet. Klick op de onderstaan link om naar de login pagina te gaan";
       ?>

             <a href="index.php?page=login">Naar Login Pagina</a>

       <?php

   }

 ?>
