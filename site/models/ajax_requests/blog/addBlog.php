<?php

   require "../pdo_connection.php";
   require "../sendEmail.php";

   $pdo = pdo();



      $blogTitle = htmlentities(htmlspecialchars($_GET['blogTitle']));
      //$subHeading = htmlentities(htmlspecialchars($_GET['subHeading']));
      $article = $_GET['article'];


      $getName = $pdo->prepare('SELECT * FROM blog WHERE blog_name=?');
      $getName->execute(array($blogTitle));
      $blogName_count = $getName->rowCount();

      $getUserEmails = $pdo->query('SELECT email FROM signin');


      $getSuperUserEmail = $pdo->prepare('SELECT email FROM signin WHERE grade=?');
      $getSuperUserEmail->execute(array('super-user'));
      $getSU_Email = $getSuperUserEmail->fetch();
      $superUser_email = $getSU_Email['email'];


     if($blogName_count == 0)
     {

       if(isset($_FILES['featuredImg']) AND !empty($_FILES['featuredImg']))
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

                        $insertBlog = $pdo->prepare("INSERT INTO blog(blog_name, blog_image, blog_content, date_added) VALUES(?,?,?,NOW())");
                        $insertBlog->execute(array($blogTitle, $img_name, $article));

                        while($getEmails = $getUserEmails->fetch())
                        {

                            $emails = $getEmails['email'];


                            $emails_array = array();
                            array_push($emails_array, $emails);

                            foreach ($emails_array as $email)
                            {

                                send_mail(

                                    "Nieuw blog toegevoegd aan de site",
                                    "

                                    een nieuwe blog is net op de website geplaatst"."<br/>
                                    Blog naam: ".$blogTitle."<br/>

                                    ",
                                    "vrijwilliger Vrijwilligers",
                                    $superUser_email,
                                    $email

                                );

                            }

                        }

                        echo "Artikel met succes toegevoegd...";

                    }else{

                      echo "Afbeelding niet geupload, probeer nogmaals...";

                    }


              }else{

                echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

              }

         }else
           {

             $insertBlog = $pdo->prepare("INSERT INTO blog(blog_name, blog_image, blog_content) VALUES(?,?,?)");
             $insertBlog->execute(array($blogTitle, "defaultBlogImg.svg", $article));

             while($getEmails = $getUserEmails->fetch())
             {

                 $emails = $getEmails['email'];


                 $emails_array = array();
                 array_push($emails_array, $emails);

                 foreach ($emails_array as $email)
                 {

                     send_mail(

                         "Nieuw blog toegevoegd aan de site",
                         "

                         een nieuwe blog is net op de website geplaatst"."<br/>
                         Blog naam: ".$blogTitle."<br/>
                         Podium de flux Vrijwilligerscoördinator

                         ",
                         "vrijwilliger Vrijwilligers",
                         $superUser_email,
                         $email

                     );

                 }

             }

             echo "Artikel met succes toegevoegd...";

           }

     }else{

       echo "Deze naam bestaat al...";

     }



 ?>
