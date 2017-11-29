<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $currentBlog_name = htmlentities(htmlspecialchars($_GET['currentBlog_name']));
   $sUserPassVal = sha1($_GET['sUserPassVal']);


   $checkPass = $pdo->prepare("SELECT password FROM signin WHERE password=? AND grade=?");
   $checkPass->execute(array($sUserPassVal, "super-user"));
   $existPass = $checkPass->fetch();
   //$existPass = $checkPass->rowCount();


   $getCurrentBlogId = $pdo->prepare("SELECT id FROM blog WHERE blog_name=?");
   $getCurrentBlogId->execute(array($currentBlog_name));

   $get_id = $getCurrentBlogId->fetch();

   if($existPass['password'] == $sUserPassVal)
   {

       $deleteBlog = $pdo->prepare("DELETE FROM blog WHERE id=?");
       $deleteBlog->execute(array($get_id['id']));

       echo "Artikel met succes verwijderd...";

   }else{

       echo "Wachtwoord onjuist...";

   }

?>
