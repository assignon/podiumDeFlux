<?php
 session_start();

   require "../vrijwilliger/site/models/blog_model.php";

   $blog = new blog();

   if(isset($_GET['id']) AND !empty($_GET['id']) AND $_GET['id'] > 0)
   {

      $getID = intval($_GET['id']);
      $userData = $blog->getUser_data($getID);

      if(isset($_SESSION['id']) AND isset($userData['id']) AND $_SESSION['id'] == $userData['id'])
      {

          if($userData['grade'] == "super-user")
          {

            require "../vrijwilliger/site/views/private/blog.php";
            $blog->hide_sidebar();
            $blog->show_sidebar_controller();
            $blog->show_sidebar();
            $blog->close_sidebar();
            $blog->blog();
            $blog->avatar();
            $blog->tabs();
            $blog->avatar();


          }else if($userData['grade'] == "guest-user")
          {

            require "../vrijwilliger/site/views/private/blog.php";
            $blog->hide_sidebar_controller();
            $blog->blog();
            $blog->avatar();
            $blog->tabs();


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
