<?php
 session_start();

   require "../vrijwilliger/site/models/settings_model.php";

   $settings = new settings();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $settings->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/templates/users_data.php";
            $settings->enableUniverselPass();
            $settings->universelPass();
            $settings->user_settings();
            $settings->tabs();



          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/templates/users_data.php";
            $settings->hide_sidebar_controller();
            $settings->user_settings();
            $settings->tabs();


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
