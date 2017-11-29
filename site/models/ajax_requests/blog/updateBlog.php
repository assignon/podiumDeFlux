<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $blogTitel = htmlentities(htmlspecialchars($_GET['blogTitel']));
   $blogTitelUpdated = htmlentities(htmlspecialchars($_GET['blogTitelUpdated']));
   $blogContent = $_GET['blogContent'];

   $getId = $pdo->prepare('SELECT id FROM blog WHERE blog_name=?');
   $getId->execute(array($blogTitel));
   $blogId = $getId->fetch();

   $getName = $pdo->prepare('SELECT * FROM blog WHERE blog_name=?');
   $getName->execute(array($blogTitelUpdated));
   $blogName_count = $getName->rowCount();




       if(isset($_FILES['featuredImg']) AND !empty($_FILES['featuredImg']) AND $blogTitel != $blogTitelUpdated)
       {
             $img_file = $_FILES['featuredImg'];

             $img_name = $img_file['name'];
             $img_tmp = $img_file['tmp_name'];
             $img_new_path = '../../../../public/media/blog_images/'.$img_name;

             $valide_extentions = array(".png",".jpeg",".jpg");
             $upload_extention = strrchr($img_name,".");

              if(in_array($upload_extention, $valide_extentions))
              {

                  if(move_uploaded_file($img_tmp, $img_new_path))
                  {

                    if($blogName_count == 0)
                    {

                      $insertBlog = $pdo->prepare("UPDATE blog SET blog_name=?, blog_image=?, blog_content=? WHERE id=?");
                      $insertBlog->execute(array($blogTitelUpdated, $img_name, $blogContent, $blogId['id']));

                      echo "Artikel met succes aangepast...";

                    }else{

                       echo "Deze naam bestaat al...";

                    }

                  }else{

                      echo "Afbeelding niet geupload, probeer nogmaals...";

                  }


              }else{

                  echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

              }


       }else if(isset($_FILES['featuredImg']) AND !empty($_FILES['featuredImg']) AND $blogTitel == $blogTitelUpdated)
       {

             $img_file = $_FILES['featuredImg'];

             $img_name = $img_file['name'];
             $img_tmp = $img_file['tmp_name'];
             $img_new_path = '../../../../public/media/blog_images/'.$img_name;

             $valide_extentions = array(".png",".jpeg",".jpg");
             $upload_extention = strrchr($img_name,".");

              if(in_array($upload_extention, $valide_extentions))
              {

                  if(move_uploaded_file($img_tmp, $img_new_path))
                  {


                      $insertBlog = $pdo->prepare("UPDATE blog SET blog_name=?, blog_image=?, blog_content=? WHERE id=?");
                      $insertBlog->execute(array($blogTitelUpdated, $img_name, $blogContent, $blogId['id']));

                      echo "Artikel met succes aangepast...";



                  }else{

                      echo "Afbeelding niet geupload, probeer nogmaals...";

                  }


              }else{

                  echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

              }



       }else if(empty($_FILES['featuredImg']) AND $blogTitel != $blogTitelUpdated){

         if($blogName_count == 0)
         {

           $insertBlog = $pdo->prepare("UPDATE blog SET blog_name=?, blog_content=? WHERE id=?");
           $insertBlog->execute(array($blogTitelUpdated, $blogContent, $blogId['id']));

           echo "Artikel met succes aangepast...";

         }else{

            echo "Deze naam bestaat al...";

         }

       }else if(empty($_FILES['featuredImg']) AND $blogTitel == $blogTitelUpdated)
       {

           $insertBlog = $pdo->prepare("UPDATE blog SET blog_name=?, blog_content=? WHERE id=?");
           $insertBlog->execute(array($blogTitelUpdated, $blogContent, $blogId['id']));

           echo "Artikel met succes aangepast...";

       }else{

         $insertBlog = $pdo->prepare("UPDATE blog SET blog_name=?, blog_content=? WHERE id=?");
         $insertBlog->execute(array($blogTitelUpdated, $blogContent, $blogId['id']));

         echo "Artikel met succes aangepast...";

       }



 ?>
