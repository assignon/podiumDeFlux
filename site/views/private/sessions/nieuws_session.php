<?php
 session_start();

   require "../vrijwilliger/site/models/nieuws_model.php";

   $nieuws = new nieuws();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $nieuws->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/nieuws.php";
            //$nieuws->enableUniverselPass();
            //$nieuws->universelPass();
            $nieuws->display_nieuws();
            $nieuws->allArticles();
            $nieuws->comments();
            $nieuws->avatar();
            $nieuws->tabs();



          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/nieuws.php";
            $nieuws->hide_sidebar_controller();
            $nieuws->display_nieuws();
            $nieuws->allArticles();
            $nieuws->comments();
            $nieuws->avatar();
            $nieuws->tabs();


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
