<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $email = htmlentities(htmlspecialchars($_GET['email']));
   $userId = intval($_GET['userId']);
   $newPass = htmlentities(htmlspecialchars($_GET['newPass']));
   $currentPass = sha1($_GET['currentPass']);




          $checkPass = $pdo->prepare("SELECT password, username FROM signin WHERE password=? AND id=?");
          $checkPass->execute(array($currentPass, $userId));
          $existPass = $checkPass->fetch();

          if(isset($_FILES['profilFoto']))
          {

               $img_file = $_FILES['profilFoto'];

                if(!empty($currentPass))
                {

                      if($currentPass == $existPass['password'])
                      {

                            $img_name = $img_file['name'];
                            $img_tmp = $img_file['tmp_name'];
                            $img_new_path = '../../../../public/media/users_avatar/'.$img_name;

                            $valide_extentions = array(".png",".jpeg",".jpg");
                            $upload_extention = strrchr($img_name,".");

                          if(in_array($upload_extention, $valide_extentions))
                          {

                                if(move_uploaded_file($img_tmp, $img_new_path))
                                {

                                  $updateAvatar = $pdo->prepare("UPDATE signin SET avatar=? WHERE id=?");
                                  $updateAvatar->execute(array($img_name, $userId));

                                  $updateCommentAvatar = $pdo->prepare("UPDATE blog_comments SET avatar=? WHERE username=?");
                                  $updateCommentAvatar->execute(array($img_name, $existPass['username']));

                                  echo "Profiel foto bijgewerkt...";

                                }else{

                                  echo "Afbeelding niet geupload, probeer nogmaals...";

                                }


                          }else{

                            echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

                          }

                      }else{

                         echo "Wachtwoord onjuist...";

                      }

                   }else{

                     echo "Wachtwoord invoeren...";

                   }

            }

        /************************UPDATE USER EMAIL*********************************/





             if(!empty($email) AND !empty($currentPass))
             {

                 if($currentPass == $existPass['password'])
                 {

                   $updateEmail = $pdo->prepare("UPDATE signin SET email=? WHERE id=?");
                   $updateEmail->execute(array($email, $userId));

                   echo "Email met succes aangepast...";

                 }else{

                    echo 'Wachtwoord onjuist';

                 }

            }

       /*************************update user password****************************************/

              if(!empty($newPass) AND !empty($currentPass))

              {

                 if($currentPass == $existPass['password'])
                 {

                   $updatePass = $pdo->prepare("UPDATE signin SET password=? WHERE id=?");
                   $updatePass->execute(array(sha1($newPass), $userId));

                   echo "Wachtwoord met succes aangepast...";

                 }else{

                    echo "Wachtwoord onjuist...";

                 }

             }

             /***************************UPDATE ALLE GEGEVENS***************************************************/
            /* else if(!empty($img_name) AND !empty($email) AND !empty($newPass))
             {

               $updateDatas = $pdo->prepare("UPDATE signin SET password=?, email=?, avatar=?");
               $updateDatas->execute(array($newPass, $email, $img_name));

             }*/


 ?>
