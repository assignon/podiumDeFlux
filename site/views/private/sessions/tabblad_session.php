<?php
 session_start();

   require "../vrijwilliger/site/models/tabblad_model.php";

   $tabblad = new tabblad();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $tabblad->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/tabblad.php";
            $tabblad->hide_sidebar();
            $tabblad->show_sidebar_controller();
            $tabblad->show_sidebar();
            $tabblad->close_sidebar();
            //$tabblad->enableUniverselPass();
            //$tabblad->universelPass();
            $tabblad->avatar();
            $tabblad->tab();
            $tabblad->tabs();
            $tabblad->displayTabs();



          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/tabblad.php";
            $tabblad->hide_sidebar_controller();
            $tabblad->avatar();
            $tabblad->tab();
            $tabblad->tabs();

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
