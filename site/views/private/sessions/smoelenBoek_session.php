<?php
 session_start();

   require "../vrijwilliger/site/models/smoelenBoek_model.php";

   $smoelenBoek = new smoelenBoek();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $smoelenBoek->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {


          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/smoelenBoek.php";
            $smoelenBoek->hide_sidebar();
            $smoelenBoek->show_sidebar_controller();
            $smoelenBoek->show_sidebar();
            $smoelenBoek->close_sidebar();
            //$smoelenBoek->enableUniverselPass();
            //$smoelenBoek->universelPass();
            $smoelenBoek->face_book();
            $smoelenBoek->avatar();
            $smoelenBoek->showImgsAction();
            $smoelenBoek->tabs();




          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/smoelenBoek.php";
            $smoelenBoek->hide_sidebar_controller();
          //  $smoelenBoek->getAllGroupName();
            $smoelenBoek->face_book();
            $smoelenBoek->avatar();
            $smoelenBoek->hideImgsAction();
            $smoelenBoek->tabs();


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
