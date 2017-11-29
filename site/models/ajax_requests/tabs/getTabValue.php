<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $allTabsVal = htmlentities(htmlspecialchars($_GET['allTabsVal']));

   $getCurrentTab_content = $pdo->prepare("SELECT tab_Content FROM tabs WHERE tab_name=?");
   $getCurrentTab_content->execute(array($allTabsVal));
   $postContent = $getCurrentTab_content->fetch();

   ?>

      <textarea name="name" rows="8" cols="80" class="ckeditor">

         <?php

           echo $postContent['tab_Content'];

          ?>

      </textarea>

   <?php

?>
