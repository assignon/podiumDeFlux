<?php
 session_start();

   require "../vrijwilliger/site/models/userManager_model.php";

   $userManager = new userManager();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $userManager->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/userManager.php";
            $userManager->hide_sidebar();
            $userManager->show_sidebar_controller();
            $userManager->show_sidebar();
            $userManager->close_sidebar();
          //  $userManager->enableUniverselPass();
            //$userManager->universelPass();
            $userManager->avatar();
            $userManager->getAllUsers();
            $userManager->getUsersData();
            $userManager->updateUsersData();
            $userManager->deleteUsersData();
            $userManager->addUsers();
            $userManager->tabs();



          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/userManager.php";
            $userManager->hide_sidebar_controller();
            $userManager->tabs();

            $userManager->avatar();


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
