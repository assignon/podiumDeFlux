<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $currentTitel = htmlentities(htmlspecialchars($_GET['currentTitel']));

   $getArticleVal = $pdo->prepare("SELECT blog_content FROM blog WHERE blog_name=?");
   $getArticleVal->execute(array($currentTitel));
   $displayArtcleContent = $getArticleVal->fetch();

   ?>

      <textarea name="" class="ckeditor" rows="8" cols="80"><?php echo $displayArtcleContent['blog_content']; ?></textarea>

   <?php

 ?>
