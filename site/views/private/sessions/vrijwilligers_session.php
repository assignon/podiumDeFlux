<?php
 session_start();

   require "../vrijwilliger/site/models/vrijwilligers_model.php";

   $vrijwilligers = new vrijwilligers();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $vrijwilligers->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/vrijwilligers.php";
            $vrijwilligers->hide_sidebar();
            $vrijwilligers->show_sidebar_controller();
            $vrijwilligers->show_sidebar();
            $vrijwilligers->close_sidebar();
          //  $vrijwilligers->enableUniverselPass();
          //  $vrijwilligers->universelPass();
            $vrijwilligers->display_agenda();
            $vrijwilligers->showCalAction();
            $vrijwilligers->getCurrentDate();
            $vrijwilligers->addEvent();
            $vrijwilligers->avatar();
            $vrijwilligers->tabs();

          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/vrijwilligers.php";
            $vrijwilligers->hide_sidebar_controller();
            $vrijwilligers->display_agenda();
            $vrijwilligers->getCurrentDate();
            $vrijwilligers->addEvent();
            $vrijwilligers->avatar();
            $vrijwilligers->tabs();

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
